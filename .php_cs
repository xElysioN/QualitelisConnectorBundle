#!/usr/bin/env php

<?php

$fileHeaderComment = <<<COMMENT
This file is part of the Qualitelis Connector Bundle

(c) Maxime Cornet <https://github.com/xelysion/qualitelis-connector-bundle/>

For the full copyright and license information, please view the LICENSE
file that was distributed with this source code.
COMMENT;

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->exclude('vendor');

return PhpCsFixer\Config::create()
    ->setRules([
        '@Symfony' => true,
        'ordered_imports' => true,
        'phpdoc_order' => true,
        'array_syntax' => array('syntax' => 'short'),
        'header_comment' => ['header' => $fileHeaderComment, 'separate' => 'both'],
        'no_useless_else' => true,
        'no_useless_return' => true,
    ])
    ->setFinder($finder)
    ->setCacheFile(__DIR__.'/.php_cs.cache');
