<?php
// Tick once a second..
declare(ticks=1);

namespace ProjectRena\Tasks;

use Cilex\Command\Command;
use ProjectRena\Lib\Cache;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CronCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName("cron:run")
            ->setDescription("Runs cronjobs");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $run = true;
        do {
            $cronjobs = scandir(__DIR__ . "/Cronjobs/");
            foreach ($cronjobs as $cron)
            {
                if (!preg_match("/^(.+)\\.php$/", $cron, $match))
                    continue;

                if (isset($match[1]))
                {
                    $name = $match[1];
                    $md5 = md5($name);

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
                        // Fire up spork and fork the process, and continue on!
                        $manager = new \Spork\ProcessManager();
                        $manager->fork(function($msg) {
                            \ProjectRena\Tasks\Cronjobs\TestCronjob::execute();
                        });

                        // Tell the cache when we ran last!
                        Cache::set($md5, time());
                    }
                }

                // Sleep for a second, so we don't go nuts with CPU
                sleep(1);
            }
        } while($run == true);
    }
}