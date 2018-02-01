<?php
require("../Handlers/DocumentHandler.php");
require("../config/config.php");
$doc = new DocumentHandler();
$pendingCount = $doc->getCountPendingDoc();
$doneCount = $doc->getCountDoneDoc();
$accCount = $doc->getCountAccounts();
$total = $doc->getTotalDoc();
$event = $doc->getUpcomingEvent();
$ongoing = $doc->getOngoingTracking();
$finished = $doc->getFinishedTracking();
$eventDetails = $doc->getEventDetails();
$arrs = array();
$arrs[0]=$pendingCount;
$arrs[1]=$doneCount;
$arrs[2] = $total;
$arrs[3]=$event[0];
$arrs[4] ='<tr class="active border-double">
			<td colspan="5">Ongoing Documents</td>
			<td class="text-right">
				<label id="badge" class="badge bg-blue-400">'.$pendingCount.'</label>
			</td></tr>';
$arrs[5]='';
$arrs[6]=$event[1];
if($ongoing){
	foreach($ongoing as $ong){
	$datetime1 = new DateTime(date("h:i:s a"));// to
	$datetime2 = new DateTime($ong['timeadded']);// from
	$interval = $datetime1->diff($datetime2);
	if($interval->format('%h')==0)
		$time= $interval->format('%i')."<small class='display-block text-size-small no-margin'> Minutes ";
	else
		$time= $interval->format('%h')."<small class='display-block text-size-small no-margin'> Hours ".$interval->format('%i')." Minutes </small>";
	$arrs[4].='<tr>
				<td><h6 class="no-margin">'.$time.'</h6></td>
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
		$datetime1 = new DateTime(date("h:i:s a"));// to
		$datetime2 = new DateTime($done['timeadded']);// from
		$interval = $datetime1->diff($datetime2);
		if($interval->format('%h')==0)
			$time= $interval->format('%i')."<small class='display-block text-size-small no-margin'> Minutes ";
		else
			$time= $interval->format('%h')."<small class='display-block text-size-small no-margin'> Hours ".$interval->format('%i')." Minutes </small>";
		$arrs[4].='<tr>
					<td><h6 class="no-margin">'.$time.'</h6></td>
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

echo json_encode($arrs);
?>