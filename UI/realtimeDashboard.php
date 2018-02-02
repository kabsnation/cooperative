<?php
require("../Handlers/DocumentHandler.php");
require("../config/config.php");
$doc = new DocumentHandler();
$pendingCount = $doc->getCountPendingDoc($_POST['date']);
$doneCount = $doc->getCountDoneDoc($_POST['date']);
$accCount = $doc->getCountAccounts();
$doneCountDate= $doc->getCountPendingDocDate($_POST['date']);
$pendingCountDate=$doc->getCountPendingDoc($_POST['date']);
$total = $doc->getTotalDoc($_POST['date']);
$event = $doc->getUpcomingEvent();
$ongoing = $doc->getOngoingTracking($_POST['date']);
$finished = $doc->getFinishedTracking($_POST['date']);
$eventDetails = $doc->getEventDetails();
$arrs = array();
$arrs[0]=$pendingCount;
$arrs[1]=$doneCount;
$arrs[2] = $total;
if($event == 0){
	$arrs[3] = "None";
}
else{
	$arrs[3]=$event[0];
}
$arrs[4] ='<tr class="active border-double">
			<td colspan="5">Ongoing Documents</td>
			<td class="text-right">
				<label id="badge" class="badge bg-blue-400">'.$pendingCount.'</label>
			</td></tr>';
$arrs[5]='';
$arrs[6]=$event[1];
if($ongoing){
	foreach($ongoing as $ong){
	$datetime1 = new DateTime(date("m/d/Y h:i:s a"));// to
	$datetime2 = new DateTime($ong['dateadded'].' '.$ong['timeadded']);// from
	$interval = $datetime1->diff($datetime2);
	if($interval->format('%a')==0){
		if($interval->format('%h')==0)
			$time= $interval->format('%i')."<small class='display-block text-size-small no-margin'> Minutes ";
		else
			$time= $interval->format('%h')." Hours ".$interval->format('%i')." Minutes </small>";
	}
	else{
		if($interval->format('%h')==0)
			$time= $interval->format('%a')."<small class='display-block text-size-small no-margin'> Days ".$interval->format('%i')." Minutes ";
		else
			$time= $interval->format('%a')."<small class='display-block text-size-small no-margin'> Days ".$interval->format('%h')." Hours ".$interval->format('%i')." Minutes </small>";
	}
	$arrs[4].='<tr>
				<td><h6 style="font-size: 11px;">'.$time.'</h6></td>
				<td>'.$ong['trackingNumber'].'</td>
				<td>'.$ong['title'].'</td>
				<td>'.$ong['username'].'</td>
				<td>'.$ong['DateTime'].'</td>
				<td><a href="ViewTracking.php?trackingId='.$ong['trackingNumber'].'&dash=true">View</a></td>
			</tr>';
	}
}

$arrs[4].= '<tr class="active border-double">
			<td colspan="5">Finished Documents</td>
			<td class="text-right">
				<label id="badge1" class="badge bg-success">'.$doneCount.'</label>
			</td></tr>';
if($finished){
	foreach ($finished as $done) {
		$datetime1 = new DateTime(date("m/d/y h:i:s a"));// to
		$datetime2 = new DateTime($done['dateadded'].' '.$done['timeadded']);// from
		$interval = $datetime1->diff($datetime2);
		if($interval->format('%a')==0){
			if($interval->format('%h')==0)
				$time= $interval->format('%i')."<small class='display-block text-size-small no-margin'> Minutes ";
			else
				$time= $interval->format('%h')." Hours ".$interval->format('%i')." Minutes </small>";
		}
		else{
			if($interval->format('%h')==0)
				$time= $interval->format('%a')."<small class='display-block text-size-small no-margin'> Days ".$interval->format('%i')." Minutes ";
			else
				$time= $interval->format('%a')."<small class='display-block text-size-small no-margin'> Days ".$interval->format('%h')." Hours ".$interval->format('%i')." Minutes </small>";
		}
		$arrs[4].='<tr>
					<td><h6 style="font-size: 11px;">'.$time.'</h6></td>
					<td>'.$done['trackingNumber'].'</td>
					<td>'.$done['title'].'</td>
					<td>'.$done['username'].'</td>
					<td>'.$done['DateTime'].'</td>
					<td><a href="ViewTracking.php?trackingId='.$done['trackingNumber'].'&dash=true">View</a></td>
				</tr>';
	}
}
if($eventDetails){
	foreach ($eventDetails as $details) {
		$arrs[5] = '<h5 class="text-semibold">'.$details['eventName'].' <small class="display-block"></small></h5>
				        <p class="content-group">'.$details['eventLocation'].'</p>
				            <ul class="list content-group">
				             	<li><span class="text-semibold">Administered by:</span><br/>'.$details['name'].' </li>
				            	<li><span class="text-semibold">Start Date and Time: '.$details['startDateTime'].'</span></li>
				           		<li><span class="text-semibold">Start Date and Time: '.$details['endDateTime'].'</span> </li>
				            </ul>';
	}
}
else
	$arrs[5]='<h5 class="text-semibold"> <small class="display-block"></small></h5>
				        <p class="content-group"> </p>
				            <ul class="list content-group">
				             	<li><span class="text-semibold">Administered by: -----</span> </li>
				            	<li><span class="text-semibold">Start Date and Time: -----</span></li>
				           		<li><span class="text-semibold">Start Date and Time: -----</span> </li>
				            </ul>';

echo json_encode($arrs);
?>