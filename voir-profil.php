<?php
require_once("header.php");

$get_id = (int) $_GET['ID']; // on vient récupérer l'ID en GET dans l'url du voir-profil

if($get_id <= 0){
    header('Location : membres.php'); // Si l'ID de l'url est inférieur ou égal à 0 alors la personne est redirigé vers la page membre.php
    exit;
}


$req = $bdd->prepare("SELECT * FROM utilisateurs WHERE ID = ?");

$req->execute([$get_id]);

$req_user = $req->fetch();

switch($req_user['administrateur']){
    case 0:
        $role = "Utilisateur";  // si administrateur = 0, le membre sera un utilisateur lambda.
        break;
    case 1:
        $role = "Administrateur"; // si administrateur = 1, le membre sera un administrateur.
        break;
}


?>



<section class="fondlogin" style="background-image: url('../ProjetSitePHP/_images/fondmembres.jpg');">
    <div class="container py-1 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-24 col-md-24 col-lg-24 col-xl-24">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">

                    <div class="card-body text-center">

                        <div class="mb-md-5 mt-md-4">

                            <h2 class="fw-bold mb-2 text-uppercase">Profil de
                                <?php echo $req_user['username']?> </h2>

                            <div>Nom : <?php echo $req_user['nom']?> </div>
                            <div>Prenom : <?php echo $req_user['prenom']?></div>
                            <div>Adresse Mail : <?php echo $req_user['mail']?></div>
                            <div>Rôle du membre : <?php echo $role ?></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>