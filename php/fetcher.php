<?php

require 'class/Parser.php';
require 'class/Fetcher.php';

use stange\swampapp\Parser;
use stange\swampapp\Fetcher;

$fetcher = new Fetcher();
$a = new Parser($fetcher->fetch());

echo json_encode($a->parse());
