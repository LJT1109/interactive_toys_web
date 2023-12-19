<?php
header('Content-Type: application/json; charset=utf-8');
#get files in ./Story and format as json , json format is age name link
$dir = "./Story";
$dh  = opendir($dir);
while (false !== ($filename = readdir($dh))) {
    $files[] = $filename;
}
sort($files);

#format as json
foreach ($files as $filename) {
    if($filename == "." || $filename == ".." || $filename == "getmenu.php")
        continue;

    $file = fopen("./Story/$filename", "r");
    #split filename to age and name and ignore file extension
    $filename = explode(".", $filename);
    $filename = $filename[0];
    $filename = explode("_", $filename);
    $name = $filename[0];
    $age = $filename[1];
    $json[] = array("age" => $age, "name" => $name);
    fclose($file);
}
echo json_encode($json, JSON_UNESCAPED_UNICODE);

?>
