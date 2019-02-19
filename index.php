<?php

namespace Projet;

session_start();

require "vendor\autoload.php";

use \Projet\App;

//require('App.php');
$app = new App();
$app->run();