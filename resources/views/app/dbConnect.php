<?php
class dbConnect {
    
    public $connection;

    // Create the data conexion.
    public static function connection() {
        
        // We create an instance of msqli with the params :'server','user','password','database';
        // $connection = new mysqli('localhost', 'root', 'root', 'dwes');
        $connection = new mysqli(configuration::host,configuration::user,configuration::password,configuration::database);
        //'localhost', 'root', 'P@$$w0rd', 'sugarcare'
        
        // Call the instance and do a query to set default enconding
        if ( $connection->errno ) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        } else {
            //$connection->query("SET NAMES 'utf8'");
            return $connection;
        }

        ////$db = new PDO('mysql:host=localhost;dbname=sugarcare', 'root', 'P@$$w0rd', array(PDO::ATTR_PERSISTENT => true));
        //$db = new PDO('mysql:host=localhost;dbname=sugarcare', 'root', 'P@$$w0rd', array(PDO::ATTR_PERSISTENT => true));
        //return $db;
    }

    public function close(){
        //$this->$connection->close();
    }

}