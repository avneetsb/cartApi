<?php

/**
 * Load our base project using autoloader.php provided via composer
 */

require_once __DIR__ . '/vendor/autoload.php';

/**
 * Generate an updated package document in docs folder
 * Assumes PHP 5.4+ and GraphViz installed
 * GenerateNewDocs Flag
 * = TRUE to generate docs
 * = FALSE to run API
 */

$generateNewDocs = false;

if ($generateNewDocs) {
    exec("php vendor/bin/phpdoc -d ./ -t ./docs -i 'vendor/,index.php' --title='cartApi Document' --sourcecode", $docOutput);

    echo PHP_EOL . "\033[32mGenerating PHP Docs for Package :: \033[0m" . PHP_EOL . PHP_EOL;

    foreach ($docOutput as $val) {
        echo "\033[34m" . $val . "\033[0m" . PHP_EOL;
    }

    echo PHP_EOL . 'To view PHP Documentation for Package open the following location in your browser :: ' . PHP_EOL;
    echo "\033[32mfile://" . __DIR__ . "/docs/index.html \033[0m" . PHP_EOL . PHP_EOL;

    echo PHP_EOL . 'Alternatively make an entry in httpd-vhosts.conf for domain (http://cartApiDocs.local/) as follows :: ' . PHP_EOL;

    $currentDir = __DIR__;

    echo <<< EOT
    \033[34m
    # Virtual host for cartApiDocs
    <VirtualHost *:80>
        ServerAdmin avneetbindra180691@gmail.com
        DocumentRoot "{$currentDir}/docs"
        ServerName cartApiDocs.local
        ServerAlias cartApiDocs.local
        <Directory "{$currentDir}/docs">
            DirectoryIndex index.html
            Options Indexes FollowSymLinks MultiViews
            AllowOverride All
            Order allow,deny
            Allow from all
            Require  all granted
        </Directory>
    </VirtualHost>
    \033[0m
EOT;

    echo PHP_EOL . PHP_EOL;
    die;
}
/**
 * Start running our App
 */

$app = new \App\App();
$app->run();
