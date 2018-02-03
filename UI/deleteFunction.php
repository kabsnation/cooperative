<?php
session_start();
if(isset($_SESSION['idAccountAdmin']))
	$idAdmin = $_SESSION['idAccountAdmin'];
else if(isset($_SESSION['idSuperAdmin']))
	$idAdmin = $_SESSION['idSuperAdmin'];
else if(isset($_SESSION['idEvent']))
	$idAdmin = $_SESSION['idEvent'];
require("../Handlers/AccountHandler.php");
require("../Handlers/EventHandler.php");
require("../Handlers/AuditTrail.php");
require("../config/config.php");
$audit = new AuditTrail();
if(isset($_POST['id'])){
	$id = $_POST['id'];
	$handler = new AccountHandler();
	$result = $handler->delete($id);
	if($result)
		$audit->trail('DELETE ACCCOUNT; ID: '.$id,'SUCCESSFUL',$idAdmin);
	else
		$audit->trail('DELETE ACCCOUNT; ID: '.$id,'FAILED',$idAdmin);
}
else if(isset($_POST['idEvents'])){
	$idEvents = $_POST['idEvents'];
	$handler = new EventHandler();
	$result = $handler->deleteEvent($idEvents);
	if($result)
		$audit->trail('DELETE EVENT; ID: '.$idEvents,'SUCCESSFUL',$idAdmin);
	else

		$audit->trail('DELETE EVENT; ID: '.$idEvents,'FAILED',$idAdmin);
}
?>