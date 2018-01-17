<?php
if(isset($_POST['link'])&&isset($_POST['trackingId']))
{
    $var_1 = $_POST['link'];
    $file = $var_1;
    echo $_POST['link'];

if (file_exists($file))
    {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.basename($file));
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    ob_clean();
    flush();
    readfile($file);
    exit;
    }
else{
    echo "<script>window.location='ViewTracking.php?trackingId=".$_POST['trackingId']."';alert('No uploaded file')</script>";
}
} //- the missing closing brace
?>