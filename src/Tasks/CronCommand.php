<?php

namespace ProjectRena\Tasks;

use Cilex\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CronCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName("Cron:run")
            ->setDescription("Runs cronjobs");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $text = "test";
        $output->writeln($text);
    }
}