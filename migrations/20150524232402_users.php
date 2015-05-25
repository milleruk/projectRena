<?php

use Phinx\Migration\AbstractMigration;

class Users extends AbstractMigration
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
        $users = $this->table("users");
        $users
            ->addColumn("username", "string", array("limit" => 128))
            ->addColumn("password", "string", array("limit" => 64))
            ->addColumn("email", "string", array("limit" => 100))
            ->addColumn("characterID", "integer", array("limit" => 11))
            ->addColumn("created", "datetime")
            ->addColumn("updated", "datetime", array("null" => true))
            ->addIndex(array("username", "email"), array("unique" => true))
            ->save();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {

    }
}