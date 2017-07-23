<?php
header("Content-Type: text/html; charset=UTF-8");

class con{
    
private $dbhost;
		private $dbuser;
		private $dbpwd;
		private $dbname;
		public  $conn;
		function __construct($dbhost, $dbuser, $dbpwd, $dbname) {
			$this->dbhost = $dbhost;
			$this->dbuser = $dbuser;
			$this->dbpwd  = $dbpwd;
			$this->dbname = $dbname;
		}
		public function connectMysql() {
			$this->conn = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpwd);
			mysqli_set_charset($this->conn, "utf8");
			mysqli_select_db($this->conn, $this->dbname);
		}
   public function add(){
        
        
    }
    public function update($table,$changename,$changevalue,$requirename,$requirevalue){
        $sql="update ".$table." set ".$changename."='".$changevalue."'  where ".$requirename."='".$requirevalue."'";
        $result=mysqli_query($this->conn, $sql);
        if(mysqli_affected_rows){
            echo "success";
        }else{
            exit();
        }
        
    }
    public function query($table){
        $sql="select * from ".$table."";
        $query_result=mysqli_query($this->conn, $sql);
        //$query_rows=mysqli_fetch_array($result, MYSQLI_ASSOC);
        return  $query_result;
    }
    public function insert(){
        
    }
    
    
    
    
}