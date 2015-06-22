<?php

use Sami\Sami;
use Sami\RemoteRepository\GitHubRemoteRepository;
use Sami\Version\GitVersionCollection;
use Symfony\Component\Finder\Finder;

$iterator = Finder::create()
    ->files()
    ->name('*.php')
    ->exclude('vendor')
    ->exclude('logs')
    ->exclude('migrations')
    ->exclude('cache')
    ->exclude('tests')
    ->exclude('composer.phar')

    ->in($dir = __DIR__ . "/../projectRena/");

$versions = GitVersionCollection::create($dir)
	->add("master", "master branch");

return new Sami($iterator, array(
	"theme" => "default",
	"title" => "projectRena",
	"versions" => $versions,
	"build_dir" => __DIR__ . "/api/",
	"cache_dir" => __DIR__ . "/cache/sami/",
	"default_opened_level" => 2,
));
