<?php
date_default_timezone_set('Asia/Manila');
require("../Handlers/DocumentHandler.php");
require("../config/config.php");
$doc = new DocumentHandler();
$connect = new Connect();
$con = $connect->connectDB();
$target_dir = "files/";
$target_file="";
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
if(isset($_POST['checkbox'])&& isset($_POST['documentType'])&& isset($_POST['title'])){
	$trackingNumber = $_POST['trackingNumber'];
	$documentType = $_POST['documentType'];
	$title = mysqli_real_escape_string($con,stripcslashes(trim($_POST['title'])));
	$message =$_POST['message'];
	$reply = $_POST['reply'];
	$file = "";
	$uploadOk=0;
	$doneUpload=0;
	if($_FILES['file']['size']!=0){
		$temp = explode(".", $_FILES["file"]["name"]);
		$newfilename = round(microtime(true)) . '.' . end($temp);
		$target_file = $target_dir . $newfilename;

	 	$check = getimagesize($_FILES["file"]["tmp_name"]);
	    if($check !== false) {
	        $uploadOk = 1;
	    } else {
	        $uploadOk = 0;
	    }
	    if ($_FILES["file"]["size"] > 500000) {
	    	$uploadOk = 0;
		}
		if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
	   		$doneUpload=1;
	    } 
	    else {
	       	$doneUpload=0;
	    }
	}
	$id = $_POST['accountId'];
	$result = "";
	//ADD TO TRACKING
	//upload img
	
	$trackingId = $doc->addDocument($title,$trackingNumber,$documentType,$id,$reply,$target_file,$message);
	if($trackingId != ""){
		foreach($_POST['checkbox'] as $recipient){
			$result = $doc->addDocumentLocation($recipient,$trackingId);
		} 
	}
	if($result){
		echo "<script>window.location='COOP_AddDocument.php';alert('Success!');</script>";
	}
}
else{
	//echo "<script>window.location='COOP_AddDocument.php';alert('Please provide the information for all the required fields!');</script>";
}
?>