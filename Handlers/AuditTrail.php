<?php
class AuditTrail{
	public function trail($action,$remarks,$id){
		$con = new Connect();
		$ip_address = $_SERVER['REMOTE_ADDR'];
		$query = "INSERT INTO audit_trail(actions,remarks,ip_address,username) VALUES ('".$action."','".$remarks."','".$ip_address."','".$id."')";
		$audit_trail = $con->insert($query);
	}
}
?>