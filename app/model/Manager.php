<?php
// --- CLASS LOADING
    namespace Projet\app\model;

    use \PDO;
// --- CLASS MANAGING DATABASE
    class Manager
    {
// --- DATABASE CONNEXION
        protected function dbConnect()
        { 
            $db = new PDO('mysql:host=localhost;dbname=v2;charset=utf8', 'root', '');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;
        }
}