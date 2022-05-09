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
    session_start();
    if (isset($_GET['action'])){
        $act=$_GET['action'];
        if ($act == "déconnexion"){
            unset($_SESSION["id"]);
            unset($_SESSION["session"]);
            unset($_SESSION["admin"]);
        }else if ($act == "connexion"){
            header("Location: user_connect.php");
        }else if ($act == "inscription"){
            header("Location: user_signup.php");
        }
    }
    include_once("db/db_connect.php") ;
    ?>
    <header>
        <div id="top_container" class="no_margin no_padding">
            <div id="logo_wrapper">
                <a href="/l1_info_4/Quizzy" id="logo_link"><img src="images/logo.png" alt="logo" id="logo"></a>
            </div>
            <div id="searchbox_wrapper">
                <input id="searchbox" type="text" class="form-input" placeholder="Chercher un quizz" name="search" title="Rechercher">
            </div>
        </div>
        <form action="" method="get">
        <?php
            if (isset($_SESSION['id'])){
                include_once("crud/users.crud.php");
                $user=select_user($conn, $_SESSION['id']);
                print("<h4>Connecté en tant que : ".$user["nickname"]."</h4>");
                print('<input type="submit" name="action" value="déconnexion">');
            }else{
                print("<h4>Vous êtes déconnecté espèce de gros porc de merde va faire du sport sale chien :(</h4>");
                print('<input type="submit" name="action" value="connexion">');
                print('<input type="submit" name="action"> value="inscription');
            }
        ?>
        </form>
        

    </header>
