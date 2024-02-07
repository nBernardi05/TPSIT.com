<?php
class Database 
{
    private static $connection;
    
    private function __construct() 
    {
    }
   
    public static function getConnection() 
    {
        if (!isset(self::$connection)) 
        {
            try{
                $ini = parse_ini_file('connessione.ini');   // ./
                self::$connection = new PDO("mysql:host=".$ini["servername"].";dbname=".$ini["dbname"].";port=".$ini["port"], $ini["username"], $ini["password"]);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
            }catch(Exception $e){
                die($e);
            }
        }
        return self::$connection;
    }
}
?>