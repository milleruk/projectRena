<?php
namespace ProjectRena\Model;

use ProjectRena\RenaApp;

/**
 * Class Paste
 *
 * @package ProjectRena\Model
 */
class Paste
{
    /**
     * @var RenaApp
     */
    private $app;
    /**
     * @var \ProjectRena\Lib\Database
     */
    private $db;

    /**
     * @param RenaApp $app
     */
    function __construct(RenaApp $app)
    {
        $this->app = $app;
        $this->db = $app->Db;
    }

    /**
     * @param $hash
     * @param $userID
     * @param $data
     * @param int $timeout
     */
    public function createPaste($hash, $userID, $data, $timeout = 0)
    {
        $timeoutDate = date("Y-m-d H:i:s", strtotime(time() + $timeout));
        $this->db->execute("INSERT INTO paste (hash, userID, data, timeout) VALUES (:hash, :userID, :data, :timeout)", array(":hash" => $hash, ":userID" => $userID, ":data" => $data, ":timeout" => $timeoutDate));
    }

    /**
     * @param $hash
     *
     * @return null
     */
    public function getPasteData($hash)
    {
        return $this->db->queryRow("SELECT * FROM paste WHERE hash = :hash", array(":hash" => $hash));
    }

    /**
     * @param $hash
     *
     * @return bool|int|string
     */
    public function deletePaste($hash)
    {
        return $this->db->execute("DELETE FROM paste WHERE hash = :hash", array(":hash" => $hash));
    }
}