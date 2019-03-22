<?php
// --- CLASS LOADING
    namespace Projet\app\model;
    use \Exception;
    use \PDO;
// --- CLASS MANAGING DATABASE
    class Manager
    {
// --- DATABASE CONNEXION

        // --- LOCAL environment
        protected function dbConnect()
        { 
            $db = new PDO('mysql:host=localhost;dbname=v2;charset=utf8', 'root', '');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;
        }

        // --- LIVE environment
        // protected function dbConnect()
        // { 
        //     $db = new PDO('mysql:host=db777810316.hosting-data.io;dbname=db777810316;charset=utf8', 'dbo777810316', 'SupralePGM2019.');
        //     $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //     return $db;
        // }
}