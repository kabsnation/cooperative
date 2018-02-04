<?php
class AuditTrail{
	public function trail($action,$remarks,$id){
		$con = new Connect();
		$ip_address = $_SERVER['REMOTE_ADDR'];
		$query = "INSERT INTO audit_trails(Actions,remarks,IP_Address,username) VALUES ('".$action."','".$remarks."','".$ip_address."','".$id."')";
		$audit_trail = $con->insert($query);
		return $audit_trail;
	}
}
?>