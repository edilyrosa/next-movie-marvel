<?php 
declare(strict_types=1);
require_once 'consts.php'; //the const API_URL is here
require_once 'functions.php'; //*the funcions of get_data and get_until_msg are here
?>

<?php
$response = get_data(API_URL);
$dataTitle = [
    'title' => $response['data']['title'] ?? 'No Movie Found', //if the data is null, we set a default title.
]
?>

<?php 
render_template('head', $dataTitle); //is able to consume <?= $data['title']; //*the HTML head
require_once 'styles.php'; //the CSS styles
//require_once 'sections/main.php'; //is able to consume <?= $data['title'] and <?= $data['errorMsg']//*HTML main content of the page,
render_template('main', $response); ; //is able to consume <?= $data['title'] and <?= $data['errorMsg']//*HTML main content of the page,
?>




