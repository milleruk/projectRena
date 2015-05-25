<?php


namespace ProjectRena\Controller;


class IndexController {
	public static function hello($app)
	{
		$app->render("index.html");
	}

	public static function helloName($app, $name)
	{
		$app->render("index.html", array("name" => $name));
	}
}