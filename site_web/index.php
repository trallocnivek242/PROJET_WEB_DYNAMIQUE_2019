<?php 
    require_once './includes/config.php';
    $page = url_data('page') ? url_data('page') : 'accueil';
?>
<!DOCTYPE html>
    <html lang="<?=$config->site_lang;?>">
    <head>
        <meta charset="<?=$config->site_charset;?>">
        <meta name="viewport" content="<?=$config->site_viewport;?>">
        <meta name="author" content="<?=$config->site_authors;?>">
        <meta name="description" content="<?=$config->site_description;?>">
        <meta name="keywords" content="<?=$config->site_keywords;?>">
        <meta http-equiv="X-UA-Compatible" content="<?=$config->site_equiv;?>">
        <title><?=$config->site_title;?> - <?=$page;?></title>
    </head>
    <body>
        <?php include_once './ossature/header.php';?>
        <?php include_once './ossature/nav.php';?>
        <?php include_once './ossature/arianne.php';?>
        <main>
            <?php include_once './ossature/main.php';?>
        </main>
        <?php include_once './ossature/footer.php';?>
    </body>
</html>