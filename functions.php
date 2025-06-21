<?php

declare(strict_types=1);

function render_template (string $template, array $data1=[]) {
    //!this temeplate isnt able to consume external o global $data ($data['title']), beacuse in into a funcion, 
    //!thats why we pass the $data as a param, and we extract it.
    extract($data1); //extract the data array into variables, so we can use them directly in the template
    require_once "templates/$template.php"; //just completing the URL with the param.
    //*into the template use $title or $data['title'], because we extract the data array.

}
function get_data(string $url) : array {

//starting a new session of cURL; ch = cURL handle
$ch = curl_init($url);

//getting the response, without show it.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//! Causes the execution to fail by HTTP >=400 Erros
curl_setopt($ch, CURLOPT_FAILONERROR, true); 

//ejecute request 
$result = curl_exec($ch);

//! get HTTP code
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);


$errorMsg = "";

if (curl_errno($ch)) {
    $errorMsg = "Error en cURL: " . curl_error($ch);
    $data = null;
} elseif ($http_code >= 400) {
    $errorMsg = "Error HTTP $http_code al obtener datos de la API.";
    $data = null;
} else {
    $data = json_decode($result, true);
    if (json_last_error() !== JSON_ERROR_NONE) { //Errors can occured decoding JSON-data. 
        $errorMsg = "Error al decodificar JSON: " . json_last_error_msg();
        $data = null;
    }
}
//close de conection
curl_close($ch);
return [
    'data' => $data,
    'errorMsg' => $errorMsg
];
}
//watchig the data response
//var_dump($data);

function get_until_msg(int $days) : string {
$message = "";
 $message = match(true){
    $days == 0              => "The premier is today!🥳",
    $days == 1              => "The premier is tomorrow! 💃🏽",
    $days > 2 && $days < 30 => "The premier is in $days 💃🏽 days",
    $days > 2 && $days < 30 => "The premier is in $days 💃🏽 days",
    $days > 30              => "The premier is in ". round(($days/30), 2) ." 💃🏽 days",
    // default => "The premier is in $days days", //*innecesary, because the match is exhaustive
 } ;
     return $message;
}


?>