<?php

$data = $data1['data'];
$errorMsg = $data1['errorMsg'];

?>

<?php if ($data): ?>
   <main>
        <div>
            <h1> The Next Marvel Movie </h1>
            <h2> <?= $data["title"]; ?> </h2>
            <img src="<?= $data["poster_url"]; ?>" width="300" alt="<?= $data["title"]?>" />
            <h3>  <?= get_until_msg($data["days_until"]); ?> </h3>
            <p>Premier date: <?= $data['release_date'] ?> </p>
            <p>
                <?= $data["overview"]?>
            </p>
            
            <br>
            
            <h2> Next movie: <?= $data["following_production"]["title"] ?> </h2>
            <img src="<?= $data["following_production"]["poster_url"]; ?>" width="300" alt="<?= $data["title"]?>" />
            <h3> Premier on <?= 
            get_until_msg($data["following_production"]["days_until"]); ?> </h3>
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