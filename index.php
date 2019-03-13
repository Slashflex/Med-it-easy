<?php

namespace Projet;

session_start();

require "vendor\autoload.php";

use \Projet\App;

$app = new App();
$app->run();