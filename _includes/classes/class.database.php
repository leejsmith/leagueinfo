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
    public function query($strSQL){
        $result = $this::$conn->query(mysqli_real_escape_string($this::$conn, $strSQL));
        print_r( $result);
        if ($result->num_rows > 0) {
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
        $this::$conn->query($strSQL);
    }
    
}
?>