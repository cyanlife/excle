<?php
header("Content-Type: text/html; charset=UTF-8");

class con{
    private static $instance=null;
    private $conn=null;
private $dbhost;
		private $dbuser;
		private $dbpwd;
		private $dbname;
		private function __construct($config=array()) {
			
 			$this->conn = mysqli_connect($config['db_host'],$config['db_user'],$config['db_pass']);
// 		    $dsn = sprintf('mysql:host=%s;dbname=%s', $config['db_host'], $config['db_name']);
// 		    $this->conn = new PDO($dsn, $config['db_user'], $config['db_pass']);
			mysqli_set_charset($this->conn, "utf8");
			mysqli_select_db($this->conn, $config['db_name']);
		}
		public  static function connectMysql($config=array()) {
			if(self::$instance==null){
			    self::$instance=new self($config);
			}
			return self::$instance;			    
			
		}
		
		
		// 获取数据库句柄方法
		public function db()
		{
		    return $this->conn;
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
    public function query($table,$requirename,$requirevalue){
        $sql="select * from ".$table." where ".$requirename."='".$requirevalue."'";
        $query_result=mysqli_query($this->conn, $sql);
        //$query_rows=mysqli_fetch_array($result, MYSQLI_ASSOC);
        return  $query_result;
    }
    public function insert(){
        
    }
    
    
    
    
}