<?php
namespace ProjectRena\Model\EVE;

use ProjectRena\RenaApp;

/**
 * Class invTypes
 *
 * @package ProjectRena\Model\EVE
 */
class dgmEffects
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

	public function getAllByID($effectID)
	{
		return $this->db->queryRow("SELECT * FROM dgmEffects WHERE effectID = :id", array(":id" => $effectID));
	}

	public function getAllByName($effectName)
	{
		return $this->db->queryRow("SELECT * FROM dgmEffects WHERE effectName = :name", array(":name" => $effectName));
	}
}