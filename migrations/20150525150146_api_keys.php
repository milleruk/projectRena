<?php

use Phinx\Migration\AbstractMigration;

class ApiKeys extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     *
     * Uncomment this method if you would like to use it.
     */

    /**
     * Migrate Up.
     */
    public function up()
    {
        $apiKeys = $this->table('apiKeys');
        $apiKeys
            ->addColumn('keyID', 'string', array('limit' => 250))
            ->addColumn('vCode', 'string', array('limit' => 250))
            ->addColumn('userID', 'integer', array('limit' => 11))
            ->addColumn('errorCode', 'integer', array('limit' => 4))
            ->addColumn('accessMask', 'integer', array('limit' => 11))
            ->addColumn('dateAdded', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
            ->addColumn('lastValidation', 'datetime', array('default' => '0000-00-00 00:00:00'))
            ->addIndex(array('keyID'))
            ->addIndex(array('keyID', 'vCode'))
            ->addIndex(array('keyID', 'dateAdded'))
            ->save();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
    }
}