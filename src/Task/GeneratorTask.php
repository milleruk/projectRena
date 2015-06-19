<?php

namespace ProjectRena\Task;

use ProjectRena\Lib;
use Cilex\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class GeneratorTask
 *
 * @package ProjectRena\Task
 */
class GeneratorTask extends Command
{
	/**
	 *
	 */
	protected function configure()
	{
		$this
			->setName('generator')
			->setDescription('Generates Controllers / Models / Libs / Tasks / Cronjobs / Resque Queues')
			->addArgument("name", InputOption::VALUE_REQUIRED, "Name of the Controller/Model/Lib ...")
			->addOption("controller", "c", InputOption::VALUE_NONE, "Create Controller")
			->addOption("model", "m", InputOption::VALUE_NONE, "Create Model")
			->addOption("libs", "l", InputOption::VALUE_NONE, "Create Lib")
			->addOption("task", "t", InputOption::VALUE_NONE, "Create Task")
			->addOption("cronjob", "j", InputOption::VALUE_NONE, "Create Cronjob")
			->addOption("resque", "r", InputOption::VALUE_NONE, "Create Resque Queue");
	}

	/**
	 * @param InputInterface $input
	 * @param OutputInterface $output
	 *
	 * @return int|null|void
	 */
	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$name = $input->getArgument("name");

		if(!$name)
		{
			$output->writeln("Error, name is not supplied.");
			exit();
		}

		if($input->getOption("controller")) {
					$this->controller($name, $output);
		}

		if($input->getOption("model")) {
					$this->model($name, $output);
		}

		if($input->getOption("libs")) {
					$this->libs($name, $output);
		}

		if($input->getOption("task")) {
					$this->task($name, $output);
		}

		if($input->getOption("cronjob")) {
					$this->cronjob($name, $output);
		}

		if($input->getOption("resque")) {
					$this->resque($name, $output);
		}

		$output->writeln("Please run update to update RenaApp and Composer");
	}

	/**
	 * @param $name
	 * @param OutputInterface $output
	 *
	 * @return mixed
	 */
	private function controller($name, $output)
	{
		$path = __DIR__ . "/../Controller/{$name}Controller.php";
		if(file_exists($path)) {
					return $output->writeln("Error, file already exists");
		}

		// Create controller
		$controllerFile = <<<EOF
<?php

namespace ProjectRena\Controller;

use ProjectRena\RenaApp;

class {$name}Controller
{

    protected \$app;
    function __construct(RenaApp \$app)
    {
        \$this->app = \$app;
    }

    public function index()
    {
        \$this->app->render('{$name}.twig');
    }
}
EOF;

		// Create twig file
		$twigFile = <<<EOF
{% set pageTitle = "{$name}" %}
{% extends 'base.twig' %}

{% block content %}
{% endblock %}
EOF;

		// Create files
		file_put_contents($path, $controllerFile);
		file_put_contents(__DIR__ . "/../../view/{$name}.twig", $twigFile);

		$output->writeln("Controller and twig file created: {$path}");
	}

	/**
	 * @param $name
	 * @param OutputInterface $output
	 *
	 * @return mixed
	 */
	private function model($name, $output)
	{
		$path = __DIR__ . "/../Model/{$name}.php";
		if(file_exists($path)) {
					return $output->writeln("Error, file already exists");
		}

		// Create model
		$modelFile = <<<EOF
<?php
namespace ProjectRena\Model;

use ProjectRena\RenaApp;

class {$name}
{
    private \$app;
    private \$db;
    private \$config;

    function __construct(RenaApp \$app)
    {
        \$this->app = \$app;
        \$this->db = \$this->app->Db;
        \$this->config = \$this->app->baseConfig;
    }
}
EOF;
		file_put_contents($path, $modelFile);

		$output->writeln("Model created: {$path}");
	}

	/**
	 * @param $name
	 * @param OutputInterface $output
	 *
	 * @return mixed
	 */
	private function libs($name, $output)
	{
		$path = __DIR__ . "/../Lib/{$name}.php";
		if(file_exists($path)) {
					return $output->writeln("Error, file already exists");
		}

		// Create lib
		$libFile = <<<EOF
namespace ProjectRena\Lib;

class {$name}
{
    public function {$name}()
    {
    }
}
EOF;
		file_put_contents($path, $libFile);

		$output->writeln("Lib created: {$path}");
	}

	/**
	 * @param $name
	 * @param OutputInterface $output
	 *
	 * @return mixed
	 */
	private function task($name, $output)
	{
		$path = __DIR__ . "/../Task/{$name}Task.php";
		if(file_exists($path)) {
					return $output->writeln("Error, file already exists");
		}

		$taskFile = <<<EOF
<?php

namespace ProjectRena\Task;

use ProjectRena\Lib;
use ProjectRena\RenaApp;
use Cilex\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class {$name}Task extends Command
{
    protected function configure()
    {
        \$this
            ->setName('{$name}')
            ->setDescription('Starts {$name}');
    }

    protected function execute(InputInterface \$input, OutputInterface \$output)
    {
    	\$app = RenaApp::getInstance();
    }
}
EOF;
		file_put_contents($path, $taskFile);

		$output->writeln("Task created: {$path}");
	}

	/**
	 * @param $name
	 * @param OutputInterface $output
	 *
	 * @return mixed
	 */
	private function cronjob($name, $output)
	{
		$path = __DIR__ . "/../Task/Cronjobs/{$name}Cronjob.php";
		if(file_exists($path)) {
					return $output->writeln("Error, file already exists");
		}

		$cronFile = <<<EOF
<?php

namespace ProjectRena\Task\Cronjobs;

use ProjectRena\RenaApp;

class {$name}Cronjob
{
    public static function getRunTimes()
    {
        return 1; // Runs every five seconds
    }

    public static function execute($pid, $md5, $db, RenaApp $app)
    {
    }
}
EOF;
		file_put_contents($path, $cronFile);

		$output->writeln("Cronjob created: {$path}");
	}

	/**
	 * @param $name
	 * @param OutputInterface $output
	 *
	 * @return mixed
	 */
	private function resque($name, $output)
	{
		$path = __DIR__ . "/../Task/Resque/{$name}Resque.php";
		if(file_exists($path)) {
					return $output->writeln("Error, file already exists");
		}

		$resqueFile = <<<EOF
<?php

namespace ProjectRena\Task\Resque;

use ProjectRena\RenaApp;

class {$name}Resque
{
    public function setUp()
    {
    	\$app = RenaApp::getInstance();
    }

    public function perform()
    {
    	\$app = RenaApp::getInstance();
    }

    public function tearDown()
    {
    	\$app = RenaApp::getInstance();
    }
}

EOF;
		file_put_contents($path, $resqueFile);

		$output->writeln("Resque Queue created: {$path}");
	}
}
