#!/usr/bin/env php
<?php

require __DIR__.'/../vendor/autoload.php';

use \SebastianBergmann\CodeCoverage\Report\Html\Facade as HtmlReport;
use \PHPUnit\Runner\Version;

$reference = sprintf(' and <a href="https://phpunit.de/">PHPUnit %s</a>', Version::id());
$report = new HtmlReport($reference);

$unit = include('reports/unit.php');
$integration = include('reports/integration.php');

$unit->merge($integration);

$report->process($unit, 'coverage');
    



