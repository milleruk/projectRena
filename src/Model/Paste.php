<?php
namespace ProjectRena\Model;

use ProjectRena\Lib\Service\Database;

/**
 * Class Paste
 *
 * @package ProjectRena\Model
 */
class Paste
{
    /**
     * @param $hash
     * @param $userID
     * @param $data
     * @param int $timeout
     */
    public function createPaste($hash, $userID, $data, $timeout = 0)
    {
        $timeoutDate = date("Y-m-d H:i:s", strtotime(time() + $timeout));
        Database::execute("INSERT INTO paste (hash, userID, data, timeout) VALUES (:hash, :userID, :data, :timeout)", array(":hash" => $hash, ":userID" => $userID, ":data" => $data, ":timeout" => $timeoutDate));
    }

    /**
     * @param $hash
     *
     * @return null
     */
    public function getPasteData($hash)
    {
        return Database::queryRow("SELECT * FROM paste WHERE hash = :hash", array(":hash" => $hash));
    }

    /**
     * @param $hash
     *
     * @return bool|int|string
     */
    public function deletePaste($hash)
    {
        return Database::execute("DELETE FROM paste WHERE hash = :hash", array(":hash" => $hash));
    }
}