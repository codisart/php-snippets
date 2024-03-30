#!/usr/bin/env php
<?php

require __DIR__.'/../vendor/autoload.php';

use \SebastianBergmann\CodeCoverage\CodeCoverage;
use \SebastianBergmann\CodeCoverage\Report\Html\CustomCssFile;
use \SebastianBergmann\CodeCoverage\Report\Html\Facade as HtmlReport;
use \PHPUnit\Runner\Version;

$unit = include('reports/unit.php');
$integration = include('reports/integration.php');

$unit->merge($integration);

$reference = sprintf(' and <a href="https://phpunit.de/">PHPUnit %s</a>', Version::id());

(new HtmlReport($reference))->process($unit, 'coverage');
    



