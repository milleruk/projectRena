<?php
/**
 * Created by PhpStorm.
 * User: micha
 * Date: 25-05-2015
 * Time: 03:04
 */

namespace ProjectRena\Tasks;

use ProjectRena;
use ProjectRena\Controller;
use ProjectRena\Lib;
use ProjectRena\Model;
use ProjectRena\Tasks;
use ProjectRena\Tasks\Cronjobs;
use ProjectRena\Tasks\Resque;
use Cilex\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
class BorisTask extends Command {
    protected function configure()
    {
        $this
            ->setName("boris")
            ->setDescription("Starts boris");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $boris = new \Boris\Boris("Rena> ");
        $boris->start();
    }
}