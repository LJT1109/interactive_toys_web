<?php
    header("Access-Control-Allow-Origin: *");
    #console.log($_POST);

    if(isset($_POST['content']))
        $content = $_POST['content'];
    else
        exit();

    if(isset($_POST['server']))
        $server = $_POST['server'];
    else
        //$server = "http://api.jingtw.tk/liver_voice";
        $server = "https://adt109119-liver-chinese.hf.space";

    if(isset($_POST['noise_scale']))
        $noise_scale = $_POST['noise_scale'];
    else
        $noise_scale = 0.6;
    
    if(isset($_POST['noise_scale_w']))
        $noise_scale_w = $_POST['noise_scale_w'];
    else
        $noise_scale_w = 0.668;

    if(isset($_POST['speed']))
        $speed = $_POST['speed'];
    else
        $speed = 1.0;

    if(isset($_POST['model']))
        $model = $_POST['model'];
    else
        $model = "LiverFix";
    
    
        $curl = curl_init();

    $json = '{ "data": [ "'.$content.'", "'.$model.'", "中文", '.$noise_scale.', '.$noise_scale_w.', '.$speed.', null ] }';
    
    

    
    curl_setopt_array($curl, array(
        CURLOPT_URL => $server.'/api/addition',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>$json,
        CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
        ),
    ));
    
    $response = curl_exec($curl);
    
    curl_close($curl);

    
    
    //parse $response to json
    $response = json_decode($response, true);
    
    $file_name = $response['data'][1]['name'];
    $file_url = $server."/file=".$file_name;

    // echo $server."<br>";
    // echo $json."<br>";
    // echo $response."<br>";
    // echo $file_url;
    // exit();
    
    #echo file content directly


    header('Content-Type: audio/wav');
    header('Content-Disposition: attachment; filename="audio.wav"');
    // 讀取並返回文件
    readfile($file_url);

?>