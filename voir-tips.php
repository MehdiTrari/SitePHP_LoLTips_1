<?php
require_once("header.php");

$get_id = (int) $_GET['champ_ID']; // on vient récupérer l'ID en GET dans l'url du voir-profil

if($get_id <= 0){
    header('Location : champions.php'); // Si l'ID de l'url est inférieur ou égal à 0 alors la personne est redirigé vers la page champions.php
    exit;
}


$req = $bdd->prepare("SELECT * FROM champions WHERE champ_ID = ?");

$req->execute([$get_id]);

$req_user = $req->fetch();



?>



<section class="fondlogin" style="background-image: url('../ProjetSitePHP/_images/tips.jpg');">
    <div class="container py-1 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-24 col-md-24 col-lg-24 col-xl-24">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">

                    <div class="card-body text-center">

                        <div class="mb-md-5 mt-md-4">

                            <h2 class="fw-bold mb-2 text-uppercase">Données de
                                <?php echo $req_user['champ_nom']?> </h2>

                            <div>Nom : <?php echo $req_user['champ_nom']?> </div>
                            <div>Type : <?php echo $req_user['champ_type']?></div>
                            <div>Range : <?php echo $req_user['champ_range']?></div>
                            <div>Dégâts AD ou AP : <?php echo $req_user['champ_ADAP']?></div>
                            <div>Tips : <?php echo $req_user['tips']?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>