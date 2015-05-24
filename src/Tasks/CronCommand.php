<?php
// Tick once a second..
declare(ticks=1);

namespace ProjectRena\Tasks;

use Cilex\Command\Command;
use ProjectRena\Lib\Cache;
use ProjectRena\Lib\Database;
use ProjectRena\Lib\Logging;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CronCommand
 * @package ProjectRena\Tasks
 */
class CronCommand extends Command
{
    /**
     *
     */
    protected function configure()
    {
        $this
            ->setName("cron:run")
            ->setDescription("Runs cronjobs");
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $run = true;
        $cnt = 0;
        $cronjobs = scandir(__DIR__ . "/Cronjobs/");
        do {
            $cnt++;
            if($cnt > 50)
            {
                gc_collect_cycles();
                $cnt = 0;
            }

            foreach ($cronjobs as $key => $cron)
            {
                // Unset anything that isn't .php!
                if (!preg_match("/^(.+)\\.php$/", $cron, $match))
                {
                    unset($cronjobs[$key]);
                    continue;
                }

                if (isset($match[1]))
                {
                    $name = $match[1];
                    $md5 = md5($name);

                    // If the script is currently running, skip to the next script
                    if(Cache::get($md5 . "_pid") != false)
                    {
                        $pid = Cache::get($md5 . "_pid");
                        $status = pcntl_waitpid($pid, $status, WNOHANG);
                        if($status == -1)
                            Cache::delete($md5 . "_pid");
                        usleep(500000);
                        continue;
                    }

                    // Get last time this cronjob ran
                    $lastRan = Cache::get($md5) > 0 ? Cache::get($md5) : 0;

                    // Current Time
                    $currentTime = time();

                    // Load the cronjobs class and get the information needed
                    $import = "\\ProjectRena\\Tasks\\Cronjobs\\" . $name;
                    $class = new $import();
                    $interval = $class->getRunTimes();

                    // If the current time is larger than the lastRunTime and Interval, then we run it again!
                    if($currentTime > ($lastRan + $interval))
                    {
                        $time = time();
                        echo "Time: {$time}: Running {$name} (Interval: {$interval})\n";

                        // Time to fork it all!
                        $pid = pcntl_fork();
                        if($pid === 0)
                        {
                            // Get the PID
                            $pid = getmypid();
                            // Tell the cache that we're running the cronjobs will automatically remove it from the cache once they're done
                            Cache::set($md5 . "_pid", $pid);

                            // Init all the stuff needed inside the Cronjob
                            $cache = new Cache();
                            $db = new Database();
                            $log = new Logging();
                            // Execute the cronjob
                            $class->execute($pid, $md5, $cache, $db, $log);
                            exit();
                        }

                        // Tell the cache when we ran last!
                        Cache::set($md5, time());
                    }
                }

                // Sleep for 500 milliseconds, so we don't go nuts with CPU
                usleep(500000);
            }
        } while($run == true); //$run == true);
    }
}