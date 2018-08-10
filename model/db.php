<?php

class Database
{   
    private $host = "localhost";
    private $db_name = "project";
    private $username = "root";
    private $password = "";
//    private $host = "127.0.0.1:49175";
//    private $db_name = "localdb";
//    private $username = "azure";
//    private $password = "6#vWHD_$";
    public $conn;
     
    public function dbConnection()
	{
      
	    $this->conn = null;    
        //try to connect, set exception mode
        //if not connect echo error message
        try
		{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
        }
		catch(PDOException $exception)
		{
            echo "Connection error: " . $exception->getMessage();
        }
         
        return $this->conn;
    }
}

?>