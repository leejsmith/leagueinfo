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
    public function insertKeyVal($table, $jsonArr) {
        $sql = '';
        $insertSQL = '';
        $keysSQL = '';
        $updateSQL = '';
        $sql = 'INSERT INTO ' . $table . ' (';
        foreach (json_decode($jsonArr,false) as $key => $val) {
            $keysSQL .= $key;
            $keysSQL .= ',';
        }
        $sql .= substr($keysSQL,0,strlen($keysSQL) - 1);
        $sql .= $keysSQL . ') VALUES (';
        foreach (json_decode($jsonArr,false) as $key => $val) {
            $insertSQL .= $jsonArr->$key;
            $insertSQL .= ',';
        }
        $sql .= substr($insertSQL,0,strlen($insertSQL) - 1);
        $sql .= ')' . $arr . ') ON DUPLICATE KEY UPDATE (';
        foreach($keys as $key) {
            $updateSQL .= $key . '=' . $jsonArr->$key . ',';
        }
        $sql .= substr($updateSQL,0,strlen($updateSQL) - 1);
        return $sql;
        // if (mysqli_query($this::conn, $sql)) {
        //     $last_id = mysqli_insert_id($this::conn);
        //     return $last_id;
        // } else {
        //     echo "Error: " . $sql . "<br>" . mysqli_error($this::conn);
        // }
    }
}
?>