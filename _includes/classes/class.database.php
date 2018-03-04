<?php


class database {
    private $hostname = '';
    private $dbName = '';
    private $username = '';
    private $password = '';
    private static $conn = NULL;
    
    function __construct () {
        $this->hostname = 'localhost';
        $this->dbName = 'leagueinfo_co_uk_www';
        $this->username = 'lolinfo';
        $this->password = 'hD?DL>#~2k-^N>9D';
        // Create connection
        $this::$conn = new mysqli($this->hostname, $this->username, $this->password, $this->dbName);

        // Check connection
        if ($this::$conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
    }

    public function getConnection(){
        return $this::$conn;
    }

    public function query($strSQL){
        $result = mysqli_query($this::$conn, $strSQL);
        echo mysqli_error($this::$conn);
        if (mysqli_num_rows($result) > 0) {
            return $result;
        } else {
            return NULL;
        }
    }

    public function returnInsertVal($table,$array) {
        $strSQL = "INSERT INTO " . $table . " (";
        $intRowCount = count($array);
        $intIdx = 0;
        foreach($array as $key => $val){ 
            $strSQL .=  mysqli_real_escape_string($this::$conn, $key) ;
            if ($intIdx < $intRowCount -1) {
                $strSQL .= ',';
            }
            $intIdx += 1;
        }
        $strSQL .= ") VALUES ( ";
        $intIdx = 0;
        foreach($array as $key => $val){
            if (!is_numeric($val)){
                $strSQL .= "'" . mysqli_real_escape_string($this::$conn, $val) ."'";
            } else {
                $strSQL .= mysqli_real_escape_string($this::$conn, $val);
            }

            if ($intIdx < $intRowCount -1) {
                $strSQL .= ',';
            }
            $intIdx += 1;
        }
        $strSQL .= ") ON DUPLICATE KEY UPDATE ";
        //assume ID is first value
        $intIdx = 0;
        foreach($array as $key => $val){
            if ($intIdx > 0){
                $strSQL .= mysqli_real_escape_string($this::$conn, $key) . '=';
                if (!is_numeric($val)){
                    $strSQL .= "'" . mysqli_real_escape_string($this::$conn, $val) ."'";
                } else {
                    $strSQL .= mysqli_real_escape_string($this::$conn, $val);
                }
                if ($intIdx < $intRowCount -1) {
                    $strSQL .= ',';
                }
            }
            
            $intIdx += 1;
        }
        $strSQL .= ";";
        if (!$this::$conn->query($strSQL)) {
            return ("Error description: " . mysqli_error($this::$conn));
        } else {
            return true;
        }
    }

    public function insertUpdate($strSQL) {
        if (!$this::$conn->query($strSQL)) {
            return ("Error description: " . mysqli_error($this::$conn));
        } else {
            return true;
        }
    }
    
}
?>