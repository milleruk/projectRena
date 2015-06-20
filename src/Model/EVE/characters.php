<?php
namespace ProjectRena\Model\EVE;

use ProjectRena\RenaApp;

/**
 * Class invTypes
 *
 * @package ProjectRena\Model\EVE
 */
class characters
{
    /**
     * @var RenaApp
     */
    private $app;
    /**
     * @var \ProjectRena\Lib\Db
     */
    private $db;

    /**
     * @param RenaApp $app
     */
    function __construct(RenaApp $app)
    {
        $this->app = $app;
        $this->db = $this->app->Db;
    }

    /**
     * @param $characterID
     */
    public function getAllByID($characterID)
    {
        $this->db->queryRow("SELECT * FROM characters WHERE characterID = :id", array(":id" => $characterID), 3600);
    }

    /**
     * @param $characterName
     */
    public function getAllByName($characterName)
    {
        $this->db->queryRow("SELECT * FROM characters WHERE characterName = :name", array(":name" => $characterName), 3600);
    }

    /**
     * @param $corporationID
     */
    public function getAllByCorporationID($corporationID)
    {
        $this->db->queryRow("SELECT * FROM characters WHERE corporationID = :id", array(":id" => $corporationID), 3600);
    }

    /**
     * @param $allianceID
     */
    public function getAllByAllianceID($allianceID)
    {
        $this->db->queryRow("SELECT * FROM characters WHERE allianceID = :id", array(":id" => $allianceID), 3600);
    }

    /**
     * @param $characterID
     */
    public function getHistoryByID($characterID)
    {
        $this->db->queryField("SELECT history FROM characters WHERE characterID = :id", "history", array(":id" => $characterID), 3600);
    }

    /**
     * @param $characterName
     */
    public function getHistoryByName($characterName)
    {
        $this->db->queryField("SELECT history FROM characters WHERE characterName = :name", "history", array(":name" => $characterName), 3600);
    }
}