<?php


namespace ProjectRena\Controller;


class IndexController {
	public static function hello(\Slim\Slim $app)
	{
		$app->render("index.html");
	}

	public static function helloName(\Slim\Slim $app, $name)
	{
		$app->render("index.html", array("name" => $name));
	}
}