<?php

use PhpCsFixer\Config;

$finder = PhpCsFixer\Finder
    ::create()
    ->in(
        [
            __DIR__ . '/app',
            __DIR__ . '/tests',
        ]
    )
    ->path(
        [
            __DIR__ . '/.php-cs-fixer.dist.php',
        ]
    );

$config = new Config();

return $config
    ->setRules(['@PSR12' => true])
    ->setFinder($finder);
