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

class EVEApiGeneratorTask extends Command {
    protected function configure()
    {
        $this
            ->setName("EVEApiGenerator")
            ->setDescription("Generates the EVEApi.php model");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
		// Beginning of the model
		$model = "<?php

namespace ProjectRena\Model\EVEApi;

/**
 * Class EVEApi
 *
 * @package ProjectRena\Model\EVEApi
 */
class EVEApi {
";

		// Load all the files and create calls
		$dirPath = __DIR__ . "/../Model/EVEApi/*/*.php";
		$phpFiles = glob($dirPath);

		foreach($phpFiles as $file)
		{
			$elements = explode("/", $file);
			$className = str_replace(".php", "", $elements[10]);
			$modelPath = "\ProjectRena\\$elements[7]\\$elements[8]\\$elements[9]\\$className";

			$type = "";
			if($elements[9] == "Character")
				$type = "char";
			elseif($elements[9] == "Corporation")
				$type = "corp";

			$fileData = file($file);

			foreach($fileData as $key => $line)
				if(stristr($line, "public function getData("))
					$functionLine = trim($line);

			$vars = explode("(", $functionLine);
			$vars = str_replace(")", "", $vars[1]);
			$vars = str_replace("array", "array()", $vars);
			$functionLine = str_replace("getData", $className, $functionLine);
			$functionLine = str_replace("public ", "public static ", $functionLine);

			if(!empty($type))
				$functionLine = str_replace($className, $type . ucfirst($className), $functionLine);

			$model .= '	' . $functionLine . ' {
		$return = new ' . $modelPath . '();
		return $return->getData(' . $vars . ');
	}
';
		}

		// End of the model
		$model .= "
};";
		$modelPath = __DIR__ . "/../Model/EVEApi.php";
		file_put_contents($modelPath, $model);
    }
}