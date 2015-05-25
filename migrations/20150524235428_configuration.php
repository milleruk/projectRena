<?php

use Phinx\Migration\AbstractMigration;

class Configuration extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     *
     * Uncomment this method if you would like to use it.
     *
    public function change()
    {
    }
    */
    
    /**
     * Migrate Up.
     */
    public function up()
    {
        $configuration = $this->table("configuration");
        $configuration
            ->addColumn("key", "string", array("limit" => 250))
            ->addColumn("value", "string", array("limit" => 250))
            ->save();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {

    }
}