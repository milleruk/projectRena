<?php

use Phinx\Migration\AbstractMigration;

class InvPrices extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     */
    public function change()
    {
        $invPrices = $this->table("invPrices", array("engine" => "TokuDB"));
        $invPrices
            ->addColumn("typeID", "integer", array("limit" => 11))
            ->addColumn("avgSell", "float", array("limit" => 255))
            ->addColumn("avgBuy", "float", array("limit" => 255))
            ->addColumn("lowSell", "float", array("limit" => 255))
            ->addColumn("lowBuy", "float", array("limit" => 255))
            ->addColumn("highSell", "float", array("limit" => 255))
            ->addColumn("highBuy", "float", array("limit" => 255))
            ->addColumn("created", "datetime", array("default" => "CURRENT_TIMESTAMP"))
            ->addIndex(array("typeID"), array())
            ->save();
    }
}
