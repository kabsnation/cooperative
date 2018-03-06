<?php
class SMSHandler{
	public function itexmo($number,$message,$apicode){
		$url = 'https://www.itexmo.com/php_api/api.php';
		$itexmo = array('1' => $number, '2' => $message, '3' => $apicode);
		$param = array(
		    'http' => array(
		        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
		        'method'  => 'POST',
		        'content' => http_build_query($itexmo),
		    ),
		);
		$context  = stream_context_create($param);
		return file_get_contents($url, false, $context);
	}

	public function sendSMS($contactNumber,$eventName,$eventLocation,$startDateTime,$endDateTime){
		$message = $eventName.' '.$eventLocation.' '.$startDateTime.' '.$endDateTime;
		echo $message;
		$result = $this->itexmo($contactNumber,$message,"TR-COOPE230127_4LPZ6");
		if ($result == ""){
			echo "iTexMo: No response from server!!!";	
		}

		else if ($result == 0){
			echo "<script>window.location='COOP_AddEvent.php';alert('Success!');</script>";
		}

		else{	
			echo "Error Num ". $result . " was encountered!".' '.$message;
		}
	}	
	public function sendSMS2($contactNumber,$message){
		$result = $this->itexmo($contactNumber,$message,"TR-COOPE230127_4LPZ6");
		if ($result == ""){
			echo "iTexMo: No response from server!!!";	
		}

		else if ($result == 0){
			echo "<script>window.location='COOP_AddEvent.php';alert('Success!');</script>";
		}

		else{	
			echo "Error Num ". $result . " was encountered!".' '.$message;
		}
	}
}

?>