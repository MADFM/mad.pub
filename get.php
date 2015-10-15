<?php
$s = file_get_contents("http://mad.pub:8000/info.xsl");

//$autodjsong = split('",', split('" : "', split('title', $s)[2])[1])[0];
if (stripos($s, "RJ Cyber") > 0) {
	echo($s);
	exit;
}

echo(($s));


?>
