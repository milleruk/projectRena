<?php
namespace ProjectRena\Model\EVE;

use ProjectRena\RenaApp;

/**
 * Class invTypes
 *
 * @package ProjectRena\Model\EVE
 */
class invTypes
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
	 * @param $id
	 *
	 * @return null
	 */
	public function getNameByID($id)
	{
		return $this->db->queryField("SELECT typeName FROM invTypes WHERE typeID = :id", "typeName", array(":id" => $id));
	}

	/**
	 * @param $name
	 *
	 * @return null
	 */
	public function getIDByName($name)
	{
		return $this->db->queryField("SELECT typeID FROM invTypes WHERE typeName = :name", "typeID", array(":name" => $name));
	}

	/**
	 * @param $id
	 *
	 * @return array
	 */
	public function getAllByID($id)
	{
		return $this->db->queryRow("SELECT * FROM invTypes WHERE typeID = :id", array(":id" => $id));
	}

	/**
	 * @param $name
	 *
	 * @return array
	 */
	public function getAllByName($name)
	{
		return $this->db->queryRow("SELECT * FROM invTypes WHERE typeName = :name", array(":name" => $name));
	}

	/**
	 * @param $id
	 *
	 * @return null
	 */
	public function getTypeIDByID($id)
	{
		return $this->db->queryField("SELECT typeID FROM invTypes WHERE typeID = :id", "typeID", array(":id" => $id));
	}

	/**
	 * @param $name
	 *
	 * @return null
	 */
	public function getTypeIDByName($name)
	{
		return $this->db->queryField("SELECT typeID FROM invTypes WHERE typeName = :name", "typeID", array(":name" => $name));
	}

	/**
	 * @param $id
	 *
	 * @return null
	 */
	public function getGroupIDByID($id)
	{
		return $this->db->queryField("SELECT groupID FROM invTypes WHERE typeID = :id", "groupID", array(":id" => $id));
	}

	/**
	 * @param $name
	 *
	 * @return null
	 */
	public function getGroupIDByName($name)
	{
		return $this->db->queryField("SELECT groupID FROM invTypes WHERE typeName = :name", "groupID", array(":name" => $name));
	}

	/**
	 * @param $id
	 *
	 * @return null
	 */
	public function getTypeNameByID($id)
	{
		return $this->db->queryField("SELECT typeName FROM invTypes WHERE typeID = :id", "typeName", array(":id" => $id));
	}

	/**
	 * @param $name
	 *
	 * @return null
	 */
	public function getTypeNameByName($name)
	{
		return $this->db->queryField("SELECT typeName FROM invTypes WHERE typeName = :name", "typeName", array(":name" => $name));
	}

	/**
	 * @param $id
	 *
	 * @return null
	 */
	public function getDescriptionByID($id)
	{
		return $this->db->queryField("SELECT description FROM invTypes WHERE typeID = :id", "description", array(":id" => $id));
	}

	/**
	 * @param $name
	 *
	 * @return null
	 */
	public function getDescriptionByName($name)
	{
		return $this->db->queryField("SELECT description FROM invTypes WHERE typeName = :name", "description", array(":name" => $name));
	}

	/**
	 * @param $id
	 *
	 * @return null
	 */
	public function getMassByID($id)
	{
		return $this->db->queryField("SELECT mass FROM invTypes WHERE typeID = :id", "mass", array(":id" => $id));
	}

	/**
	 * @param $name
	 *
	 * @return null
	 */
	public function getMassByName($name)
	{
		return $this->db->queryField("SELECT mass FROM invTypes WHERE typeName = :name", "mass", array(":name" => $name));
	}

	/**
	 * @param $id
	 *
	 * @return null
	 */
	public function getVolumeByID($id)
	{
		return $this->db->queryField("SELECT volume FROM invTypes WHERE typeID = :id", "volume", array(":id" => $id));
	}

	/**
	 * @param $name
	 *
	 * @return null
	 */
	public function getVolumeByName($name)
	{
		return $this->db->queryField("SELECT volume FROM invTypes WHERE typeName = :name", "volume", array(":name" => $name));
	}

	/**
	 * @param $id
	 *
	 * @return null
	 */
	public function getCapacityByID($id)
	{
		return $this->db->queryField("SELECT capacity FROM invTypes WHERE typeID = :id", "capacity", array(":id" => $id));
	}

	/**
	 * @param $name
	 *
	 * @return null
	 */
	public function getCapacityByName($name)
	{
		return $this->db->queryField("SELECT capacity FROM invTypes WHERE typeName = :name", "capacity", array(":name" => $name));
	}

	/**
	 * @param $id
	 *
	 * @return null
	 */
	public function getPortionSizeByID($id)
	{
		return $this->db->queryField("SELECT portionSize FROM invTypes WHERE typeID = :id", "portionSize", array(":id" => $id));
	}

	/**
	 * @param $name
	 *
	 * @return null
	 */
	public function getPortionSizeByName($name)
	{
		return $this->db->queryField("SELECT portionSize FROM invTypes WHERE typeName = :name", "portionSize", array(":name" => $name));
	}

	/**
	 * @param $id
	 *
	 * @return null
	 */
	public function getRaceIDByID($id)
	{
		return $this->db->queryField("SELECT raceID FROM invTypes WHERE typeID = :id", "raceID", array(":id" => $id));
	}

	/**
	 * @param $name
	 *
	 * @return null
	 */
	public function getRaceIDByName($name)
	{
		return $this->db->queryField("SELECT raceID FROM invTypes WHERE typeName = :name", "raceID", array(":name" => $name));
	}

	/**
	 * @param $id
	 *
	 * @return null
	 */
	public function getBasePriceByID($id)
	{
		return $this->db->queryField("SELECT basePrice FROM invTypes WHERE typeID = :id", "basePrice", array(":id" => $id));
	}

	/**
	 * @param $name
	 *
	 * @return null
	 */
	public function getBasePriceByName($name)
	{
		return $this->db->queryField("SELECT basePrice FROM invTypes WHERE typeName = :name", "basePrice", array(":name" => $name));
	}

	/**
	 * @param $id
	 *
	 * @return null
	 */
	public function getPublishedByID($id)
	{
		return $this->db->queryField("SELECT published FROM invTypes WHERE typeID = :id", "published", array(":id" => $id));
	}

	/**
	 * @param $name
	 *
	 * @return null
	 */
	public function getPublishedByName($name)
	{
		return $this->db->queryField("SELECT published FROM invTypes WHERE typeName = :name", "published", array(":name" => $name));
	}

	/**
	 * @param $id
	 *
	 * @return null
	 */
	public function getMarketGroupIDByID($id)
	{
		return $this->db->queryField("SELECT marketGroupID FROM invTypes WHERE typeID = :id", "marketGroupID", array(":id" => $id));
	}

	/**
	 * @param $name
	 *
	 * @return null
	 */
	public function getMarketGroupIDByName($name)
	{
		return $this->db->queryField("SELECT marketGroupID FROM invTypes WHERE typeName = :name", "marketGroupID", array(":name" => $name));
	}

	/**
	 * @param $id
	 *
	 * @return null
	 */
	public function getChanceOfDuplicatingByID($id)
	{
		return $this->db->queryField("SELECT chanceOfDuplicating FROM invTypes WHERE typeID = :id", "chanceOfDuplicating", array(":id" => $id));
	}

	/**
	 * @param $name
	 *
	 * @return null
	 */
	public function getChanceOfDuplicatingByName($name)
	{
		return $this->db->queryField("SELECT chanceOfDuplicating FROM invTypes WHERE typeName = :name", "chanceOfDuplicating", array(":name" => $name));
	}
}