<?php
// Klass för databasen
class database{

    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'svalan';
    
    public $connection;
    
    public function __construct(){
        $this->connectDB();
    }
    // Ansluta till databasen
    private function connectDB() {
        if (!isset($this->connection)) {
            
            $this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);
            
            if (!$this->connection) {
                echo 'FEL: Det gick inte att ansluta till mysql';
                exit;
            }            
        }    
        
        return $this->connection;
    }

    // Läs/Välj från databasen
    public function select($query) {
        $result = $this->connection->query($query) or die ($this->connection->error.__LINE__);
        if($result->num_rows > 0) {
            return $result;
        }else {
            return false;
        }
        }

    // Lägg till data i databasen
    public function insert($query) {
        $insert_row = $this->connection->query($query) or die ($this->connection->error.__LINE__);
        if($insert_row) {
            header('location: adminpanel.php');
            exit();
        } else {
            die('Error: Det uppstod ett fel');
        }
    }

     // Uppdatera data i databasen
    public function update($query) {
        $update_row = $this->connection->query($query) or die ($this->connection->error.__LINE__);
        if($update_row) {
            header('location: adminpanel.php');
            exit();
        } else {
            die('Error: Det uppstod ett fel');
        }
    }

     // Ta bort data från databasen
    public function delete($query) {
        $delete_row = $this->connection->query($query) or die ($this->connection->error.__LINE__);
        if($delete_row) {
            header('location: adminpanel.php');
            exit();
        } else {
            die('Error: Det uppstod ett fel');
        }
    }


}
?>