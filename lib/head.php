<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Quizzy</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js"></script>
</head>
<body class="no_margin no_padding">
 
    <?php
    include("db/db_connect.php") ;
    ?>
    <header>
        <div id="top_container" class="no_margin">
            <a href="/l1_info_4/Quizzy" id="logo_link"><img src="images/logo.png" alt="logo" id="logo"></a>
            <div id="top_bar" class="no_margin"></div>
            <input id="searchbox" type="text" class="form-input" placeholder="Chercher un quizz" name="search" title="Rechercher">
        </div>
    </header>
