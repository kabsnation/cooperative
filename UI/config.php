<?php
class Connect 
{
	private $db_host = 'den1.mysql4.gear.host';
	private $db_user ='coop';
	private $db_pass='Vt0l!cS-wglq';
	private $db_database ='coop';
	private $conn = '';

	public function __construct(){
		$this->conn = $this -> connectDB();
	}

	public function connectDB(){
		$conn = mysqli_connect($this->db_host,$this->db_user,$this->db_pass,$this->db_database) or die("Unable to connect to server");
		return $conn;
	}

	public function insert($query){
		$result = mysqli_query($this->conn, $query);
		return $result;
	}
	public function insertReturnLastId($query){
		if(mysqli_query($this->conn, $query)){
			return mysqli_insert_id($this->conn);
		}
		else{
			return "";
		}
	}

	public function select($query){
		$result = mysqli_query($this->conn, $query);
		if(mysqli_num_rows($result)>0){
			return $result;
		}
		else
			return null;
	}
	public function update($query){
		$result = mysqli_query($this->conn, $query);
		return $result;
	}
}
?>