<?php


use Sami\Sami;
use Sami\RemoteRepository\GitHubRemoteRepository;
use Symfony\Component\Finder\Finder;

$iterator = Finder::create()
    ->files()
    ->name('*.php')
    ->exclude('vendor')
    ->exclude('logs')
    ->exclude('migrations')
    ->exclude('cache')
    ->exclude('composer.phar')

    ->in(__DIR__ . "/")
;

return new Sami($iterator, array(
	"theme" => "default",
	"title" => "projectRena",
	"build_dir" => __DIR__ . "/docs/",
	"cache_dir" => __DIR__ . "/cache/sami/"
));
