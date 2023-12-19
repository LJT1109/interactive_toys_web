<?php
    $name = $_GET['name'];
    $filePath = './Story/'.$name;
    
    if (file_exists($filePath)) {
        $file = fopen($filePath, "r");
        $content = fread($file, filesize($filePath));
        fclose($file);

        $response = array(
            'success' => true,
            'name' => $name,
            'content' => $content
        );
    } else {
        $response = array(
            'success' => false,
            'message' => 'File not found.'
        );
    }

    echo json_encode($response);
?>
