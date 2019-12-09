<?php 
    require_once './includes/fonctions.php';
    $page = url_data('page') ? url_data('page') : 'accueil';
?>
<!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Projet architect - <?=$page;?></title>
    </head>
    <body>
        <?php include_once './ossature/header.php';?>
        <?php include_once './ossature/nav.php';?>
        <?php include_once './ossature/main.php';?>
        <?php include_once './ossature/footer.php';?>
    </body>
</html>