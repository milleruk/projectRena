<?php

/**
 * Created by PhpStorm.
 * User: micha
 * Date: 25-05-2015
 * Time: 03:04.
 */
namespace ProjectRena\Tasks;

use ProjectRena;
use ProjectRena\Model; use Cilex\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class EVEApiGeneratorTask extends Command
{
    protected function configure()
    {
        $this
            ->setName('EVEApiGenerator')
            ->setDescription('Generates the EVEApi.php model');
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
        $dirPath = __DIR__.'/../Model/EVEApi/*/*.php';
        $phpFiles = glob($dirPath);

        foreach ($phpFiles as $file) {
            $elements = explode('/', $file);
            $className = str_replace('.php', '', $elements[10]);
            $modelPath = "\ProjectRena\\$elements[7]\\$elements[8]\\$elements[9]\\$className";

            $type = $elements[9];

            switch ($type) {
                case 'Account':
                    $functionType = 'account';
                    break;
                case 'API':
                    $functionType = 'api';
                    break;
                case 'Character':
                    $functionType = 'char';
                    break;
                case 'Corporation':
                    $functionType = 'corp';
                    break;
                case 'EVE':
                    $functionType = 'eve';
                    break;
                case 'Map':
                    $functionType = 'map';
                    break;
                case 'Server':
                    $functionType = 'server';
                    break;
            }
            $fileData = file($file);

            foreach ($fileData as $key => $line) {
                if (stristr($line, 'public function getData(')) {
                    $functionLine = trim($line);
                }
            }

            $vars = explode('(', $functionLine);
            $vars = str_replace(')', '', $vars[1]);
            $vars = str_replace('array', 'array()', $vars);
            $functionLine = str_replace('getData', $className, $functionLine);
            $functionLine = str_replace('public ', 'public static ', $functionLine);
            $functionLine = str_replace($className, $functionType.ucfirst($className), $functionLine);

            $model .= '	'.$functionLine.' {
		$return = new '.$modelPath.'();
		return $return->getData('.$vars.');
	}
';
        }

        // End of the model
        $model .= '
};';
        $modelPath = __DIR__.'/../Model/EVEApi.php';
        file_put_contents($modelPath, $model);
    }
}
