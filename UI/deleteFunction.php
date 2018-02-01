<?php
require("../Handlers/AccountHandler.php");
require("../Handlers/EventHandler.php");
require("../config/config.php");
if(isset($_POST['id'])){
	$id = $_POST['id'];
	$handler = new AccountHandler();
	$handler->delete($id);
}
else if(isset($_POST['idEvents'])){
	$idEvents = $_POST['idEvents'];
	$handler = new EventHandler();
	echo $handler->deleteEvent($idEvents);
}
?>