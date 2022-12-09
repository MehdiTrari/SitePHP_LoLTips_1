<?php

session_start();
include_once('_bdd/connexionBDD.php');

?>
<html lang="fr">

<head>
    <?php 
        // utilisation de plusieurs fichier et d'un dossier général pour le header afin de simplifier le code
        require_once('_header/meta.php'); 
        require_once('_header/link.php');
        require_once('_header/script.php');
        ?>
    <title>LoLTips</title>
</head>

<body>
    <?php 
        require_once('_navbar/navbar.php');
        ?>
    <?php 
        require_once('_footer/footer.php');
        ?>
</body>


</html>