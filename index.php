<?php 
const API_URL = "https://whenisthenextmcufilm.com/api";

//starting a new session of cURL; ch = cURL handle
$ch = curl_init(API_URL);

//getting the response, without show it.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//ejecute request 
$result = curl_exec($ch);

//save the response as Asociative Array (JSON)
$data = json_decode($result, true);

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
        
        
        <h2> Next movie: <?= $data["following_production"]["title"] ?> </h2>
        <img src="<?= $data["following_production"]["poster_url"]; ?>" width="300" alt="<?= $data["title"]?>" />
        <h3> Premier on <?= $data["following_production"]["days_until"]; ?> days!! </h3>
        <p>Premier date: <?= $data['release_date'] ?> </p>
        
        
        
        
    </div>
</main>
