<?php include_once("_header/link.php");?>


<nav class="navbar navbar-expand-lg bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php" style="color:white">Accueil</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">



                <?php if(!isset($_SESSION['ID'])){


                ?>

                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <a class="connect" href="login.php" style="color:white; position:relative; right:5px">Connexion</a>

                </div>


                <?php }else{
                    
                
                ?>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <a class="disconnect" href="logout.php" style="color:white; position:relative; left:5px;">
                        Déconnexion</a>
                    <a class="nav-link" href="profil.php" style="color:#CDCDCD; position:relative; left:5px;">Profil</a>
                </div>
                <?php } ?>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">

                    <a class="nav-link" href="champions.php" style="color:#CDCDCD">Champions</a>
                    <a class="nav-link" href="membres.php" style="color:#CDCDCD">Membres</a>
                    <a class="nav-link" href="https://www.op.gg/summoners/euw/D%C3%A9mon%20Roubaisien"
                        style="color:#CDCDCD">Mehdi's Stats</a>
                </div>

            </ul>

            <?php 

                ?>







        </div>
    </div>
</nav>