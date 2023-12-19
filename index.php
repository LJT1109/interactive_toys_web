#php show all file in this folder
<?php
$dir = "./";
$dh  = opendir($dir);
while (false !== ($filename = readdir($dh))) {
    $files[] = $filename;
}
sort($files);
#print file with link
foreach ($files as $filename) {
    echo "<a href='$filename'>$filename</a><br>";
}

?>
