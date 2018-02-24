<?php


class database {
    private $hostname = '';
    private $username = '';
    private $password = '';
    private static $conn = NULL;
    
    function __construct () {
        $this->hostname = 'localhost';
        $this->username = 'lolinfo';
        $this->password = 'hD?DL>#~2k-^N>9D';
        // Create connection
        $this::$conn = new mysqli($this->hostname, $this->username, $this->password);

        // Check connection
        if ($this::$conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
    }
    public function query($strSQL){
        return $strSQL;
    }
    public function returnInsertID($table, $arr) {
        if (mysqli_query($this::conn, $sql)) {
            $last_id = mysqli_insert_id($this::conn);
            return $last_id;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($this::conn);
        }
    }
}
?>