<?php 
const API_URL = "https://whenisthenextmcufilm.com/api";

//starting a new session of cURL; ch = cURL handle
$ch = curl_init(API_URL);

//getting the response, without show it.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//! Hace que curl_exec falle en códigos HTTP >=400
curl_setopt($ch, CURLOPT_FAILONERROR, true); 

//ejecute request 
$result = curl_exec($ch);

//! get HTTP code
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);



//!Se captura cualquier error de cURL con curl_errno y curl_error.
// if(curl_errno($ch)){
//     $errorMsg = curl_error($ch);
//     echo "<p> Error in cURL: $errorMsg </p>";
//     $data = null;
// } elseif($http_code >= 400){
//     echo "<p> Error HTTP $http_code getting data from API. </p>";
//     $data = null;
// }else{
//     //save the response as Asociative Array (JSON)
//     $data = json_decode($result, true);
//     if(json_last_error() !== JSON_ERROR_NONE){
//         echo "<p> Error decoding JSON-data.". json_last_error_msg() ."</p>";
//         $data = null;
//     }
// }

$errorMsg = "";

if (curl_errno($ch)) {
    $errorMsg = "Error en cURL: " . curl_error($ch);
    $data = null;
} elseif ($http_code >= 400) {
    $errorMsg = "Error HTTP $http_code al obtener datos de la API.";
    $data = null;
} else {
    $data = json_decode($result, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        $errorMsg = "Error al decodificar JSON: " . json_last_error_msg();
        $data = null;
    }
}

//close de conection
curl_close($ch);

//watchig the data response
//var_dump($data);

?>


<head>
    <meta charset="UTF-8" />
    <meta name="description" content="next marvel movie" />
    <title>Next Marvel</title>
    <!-- Centered viewport -->
    <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.classless.min.css"
    >
    <style>
        body{
            background-color: black;
            color: #fff;
        }
        img{
            border-radius:"100px";
        }
        h3{
            padding-top: 20px;
        }

        div{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: justify;
        }
    </style>
</head>


<?php if ($data): ?>
   <main>
    <div>

        <h1> The Next Marvel Movie </h1>
        <h2> <?= $data["title"]; ?> </h2>
        <img src="<?= $data["poster_url"]; ?>" width="300" alt="<?= $data["title"]?>" />
        <h3> Premier on <?= $data["days_until"]; ?> days!! </h3>
        <p>Premier date: <?= $data['release_date'] ?> </p>
        <p>
            <?= $data["overview"]?>
        </p>
        
        <br>
        
        <h2> Next movie: <?= $data["following_production"]["title"] ?> </h2>
        <img src="<?= $data["following_production"]["poster_url"]; ?>" width="300" alt="<?= $data["title"]?>" />
        <h3> Premier on <?= $data["following_production"]["days_until"]; ?> days!! </h3>
        <p>Premier date: <?= $data['release_date'] ?> </p>
    </div>
</main>

<?php else: ?>
    <section style="text-align:center; padding:2rem; display:flex; flex-direction:column; justify-content:center; align-items:center;">
        <h1>⚠️Error at getting data⚠️</h1>
        <p><?= htmlspecialchars($errorMsg); ?></p>
        <p>Please, try later 🥵.</p>
    </section>
<?php endif; ?>


