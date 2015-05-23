<?php

class Config
{
	public static function get($key)
	{
		return Database::queryField("SELECT value FROM config WHERE key = :key", "value", array(":key" => $key));
	}

	public static function set($key, $value)
	{
		return Database::execute("INSERT INTO config (key, value) VALUES (:key, :value)", array(":key" => $key, ":value" => $value));
	}
}