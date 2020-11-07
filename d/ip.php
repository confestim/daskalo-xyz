<?php
$file = fopen ('ip.log', 'a+');
fwrite($file, $_SERVER['REMOTE_ADDR']."\r\n")
?>
<meta http-equiv="refresh" content="0;url=index.html">
