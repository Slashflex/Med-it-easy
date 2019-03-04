<?php

namespace Projet\app\model;

use \PDO;

class Manager
{
    // Database connexion
    protected function dbConnect()
    { 
        $db = new PDO('mysql:host=localhost;dbname=v2;charset=utf8', 'root', '');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    }
}
