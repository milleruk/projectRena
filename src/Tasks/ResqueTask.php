<?php
/**
 * Created by PhpStorm.
 * User: micha
 * Date: 25-05-2015
 * Time: 02:35
 */

namespace ProjectRena\Tasks;


use Cilex\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ResqueCron
 * @package ProjectRena\Tasks
 */
class ResqueTask extends Command {
    /**
     *
     */
    protected function configure()
    {
        $this
            ->setName("resque:run")
            ->setDescription("Fires up resque");
    }

	/**
	 * @param InputInterface $input
	 * @param OutputInterface $output
	 *
	 * @return int|null|void
	 */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        putenv("VERBOSE=0");
        putenv("QUEUE=*");

        include(__DIR__ . "/../../vendor/chrisboulton/php-resque/resque.php");
    }
}