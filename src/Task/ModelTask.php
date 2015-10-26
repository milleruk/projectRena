<?php

namespace ProjectRena\Task;

use Cilex\Command\Command;
use gossi\codegen\generator\CodeFileGenerator;
use gossi\codegen\model\PhpClass;
use gossi\codegen\model\PhpMethod;
use gossi\codegen\model\PhpParameter;
use gossi\codegen\model\PhpProperty;
use gossi\formatter\Formatter;
use ProjectRena\Lib;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class BorisTask
 *
 * @package ProjectRena\Task
 */
class ModelTask extends Command
{
    private $description = "";

    /**
     *
     */
    protected function configure()
    {
        $this->setName('models')->setDescription('Creates a model from a database table');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $table = prompt("Table to create model for");
        $this->description["description"] = prompt("Description");

        if (!$table) {
            $output->writeln("Error, table name is not supplied.");
            exit();
        }

        // Setup the path and make sure it doesn't already exist
        $path = __DIR__ . "/../Model/Database/{$table}.php";
        if (file_exists($path))
            return $output->writeln("Error, file already exists");

        // Load app
        $app = \ProjectRena\RenaApp::getInstance();

        // Load the table, if it exists in the first place
        $tableColums = $app->Db->query("SHOW COLUMNS FROM {$table}");

        // Generate the start of the model code
        $class = new PhpClass();
        $class->setQualifiedName("ProjectRena\\Model\\Database\\{$table}")
            ->setProperty(PhpProperty::create("app")
                ->setVisibility("private")
                ->setDescription("The Slim Application"))
            ->setProperty(PhpProperty::create("db")
                ->setVisibility("private")
                ->setDescription("The database connection"))
            ->setMethod(PhpMethod::create("__construct")
                ->addParameter(PhpParameter::create("app")
                    ->setType("RenaApp"))
                ->setBody("\$this->app = \$app;\n
                \$this->db = \$app->Db;\n"))
            ->setDescription($this->description)
            ->declareUse("ProjectRena\\RenaApp");

        $nameFields = array();
        $idFields = array();
        foreach ($tableColums as $get) {
            // This is for the getByName selector(s)
            if (stristr($get["Field"], "name"))
                $nameFields[] = $get["Field"];

            // This is for the getByID selector(s)
            if (strstr($get["Field"], "ID"))
                $idFields[] = $get["Field"];
        }

        // Get generator
        foreach ($nameFields as $name) {
            // get * by Name
            $class->setMethod(PhpMethod::create("getAllBy" . ucfirst($name))
                ->addParameter(PhpParameter::create($name))
                ->setVisibility("public")
                ->setBody("return \$this->db->query(\"SELECT * FROM {$table} WHERE {$name} = :{$name}\", array(\":{$name}\" => \${$name}));")
            );
        }

        foreach ($idFields as $id) {
            // get * by ID,
            $class->setMethod(PhpMethod::create("getAllBy" . ucfirst($id))
                ->addParameter(PhpParameter::create($id)
                    ->setType("int"))
                ->setVisibility("public")
                ->setBody("return \$this->db->query(\"SELECT * FROM {$table} WHERE {$id} = :{$id}\", array(\":{$id}\" => \${$id}));")
            );
        }

        foreach ($nameFields as $name) {
            foreach ($tableColums as $get) {
                // If the fields match, skip it.. no reason to get/set allianceID where allianceID = allianceID
                if ($get["Field"] == $name)
                    continue;

                // Skip the id field
                if ($get["Field"] == "id")
                    continue;

                $class->setMethod(PhpMethod::create("get" . ucfirst($get["Field"]) . "By" . ucfirst($name))
                    ->addParameter(PhpParameter::create($name))
                    ->setVisibility("public")
                    ->setBody("return \$this->db->queryField(\"SELECT {$get["Field"]} FROM {$table} WHERE {$name} = :{$name}\", \"{$get["Field"]}\", array(\":{$name}\" => \${$name}));")
                );
            }
        }

        foreach ($idFields as $id) {
            foreach ($tableColums as $get) {
                // If the fields match, skip it.. no reason to get/set allianceID where allianceID = allianceID
                if ($get["Field"] == $id)
                    continue;

                // Skip the id field
                if ($get["Field"] == "id")
                    continue;

                $class->setMethod(PhpMethod::create("get" . ucfirst($get["Field"]) . "By" . ucfirst($id))
                    ->addParameter(PhpParameter::create($id))
                    ->setVisibility("public")
                    ->setBody("return \$this->db->queryField(\"SELECT {$get["Field"]} FROM {$table} WHERE {$id} = :{$id}\", \"{$get["Field"]}\", array(\":{$id}\" => \${$id}));")
                );
            }
        }

        // Update generator
        foreach ($nameFields as $name) {
            foreach ($tableColums as $get) {
                // If the fields match, skip it.. no reason to get/set allianceID where allianceID = allianceID
                if ($get["Field"] == $name)
                    continue;

                // Skip the id field
                if ($get["Field"] == "id")
                    continue;

                $class->setMethod(PhpMethod::create("update" . ucfirst($get["Field"]) . "By" . ucfirst($name))
                    ->addParameter(PhpParameter::create($get["Field"]))
                    ->addParameter(PhpParameter::create($name))
                    ->setVisibility("public")
                    ->setBody("\$exists = \$this->db->queryField(\"SELECT {$get["Field"]} FROM {$table} WHERE {$name} = :{$name}\", \"{$get["Field"]}\", array(\":{$name}\" => \${$name}));
                     if(!empty(\$exists)){
                        \$this->db->execute(\"UPDATE {$table} SET {$get["Field"]} = :{$get["Field"]} WHERE {$name} = :{$name}\", array(\":{$name}\" => \${$name}, \":{$get["Field"]}\" => \${$get["Field"]}));}
                    ")
                );
            }
        }

        foreach ($idFields as $id) {
            foreach ($tableColums as $get) {
                // If the fields match, skip it.. no reason to get/set allianceID where allianceID = allianceID
                if ($get["Field"] == $id)
                    continue;

                // Skip the id field
                if ($get["Field"] == "id")
                    continue;

                $class->setMethod(PhpMethod::create("update" . ucfirst($get["Field"]) . "By" . ucfirst($id))
                    ->addParameter(PhpParameter::create($get["Field"]))
                    ->addParameter(PhpParameter::create($id))
                    ->setVisibility("public")
                    ->setBody("\$exists = \$this->db->queryField(\"SELECT {$get["Field"]} FROM {$table} WHERE {$id} = :{$id}\", \"{$get["Field"]}\", array(\":{$id}\" => \${$id}));
                     if(!empty(\$exists))
                     {
                        \$this->db->execute(\"UPDATE {$table} SET {$get["Field"]} = :{$get["Field"]} WHERE {$id} = :{$id}\", array(\":{$id}\" => \${$id}, \":{$get["Field"]}\" => \${$get["Field"]}));}
                    ")
                );
            }
        }

        // Global insert generator (Yes it's ugly as shit..)
        $inserter = "public function insertInto" . ucfirst($table) . "(";
        foreach ($tableColums as $field) {
            // Skip the ID field
            if ($field["Field"] == "id")
                continue;

            $inserter .= "\${$field["Field"]}, ";
        }
        $inserter = rtrim(trim($inserter), ",") . ")";
        $inserter .= "{";
        $inserter .= "\$this->db->execute(\"INSERT INTO {$table} (";
        foreach ($tableColums as $field) {
            if ($field["Field"] == "id")
                continue;

            $inserter .= $field["Field"] . ", ";
        }

        $inserter = rtrim(trim($inserter), ",") . ") ";
        $inserter .= "VALUES (";
        foreach ($tableColums as $field) {
            if ($field["Field"] == "id")
                continue;

            $inserter .= ":" . $field["Field"] . ", ";
        }

        $inserter = rtrim(trim($inserter), ",") . ")\", ";

        $inserter .= "array(";
        foreach ($tableColums as $field) {
            if ($field["Field"] == "id")
                continue;

            $inserter .= "\":" . $field["Field"] . "\" => \${$field["Field"]}, ";
        }

        $inserter = rtrim(trim($inserter), ",") . "));";
        $inserter .= "}}";

        $generator = new CodeFileGenerator();
        $code = $generator->generate($class);

        $code = rtrim(trim($code), "}");
        $code .= $inserter;
        $formatter = new Formatter();
        $code = $formatter->format($code);

        file_put_contents($path, $code);
        chmod($path, 0777);
        $output->writeln("Model created: {$path}");
    }

}