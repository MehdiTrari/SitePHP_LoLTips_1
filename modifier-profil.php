<?php
require_once("header.php");

  if(!isset($_SESSION['ID'])){
    header('location: index.php');
    exit;
  }

$req = $bdd->prepare("SELECT * FROM utilisateurs WHERE ID = ?");

$req->execute([$_SESSION['ID']]);

$req_user = $req->fetch();

if(!empty($_POST)){
    extract($_POST);

    $valid = true;

    if(isset($_POST['modif_mail'])){
        $mail =  trim($mail);

        if(!isset($mail)){
            $req = $bdd->prepare("SELECT ID FROM utilisateurs WHERE mail = ?");

            $req->execute([$mail]);

            $req = $req->fetch();

   
        
        }
        
    

    }
if(!isset($mail)){
    $mail = $req_user['mail'];
}

}
?>



<section class="fondlogin" style="background-image: url('../ProjetSitePHP/_images/fondmembres.jpg');">
    <div class="container py-1 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-24 col-md-24 col-lg-24 col-xl-24">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">

                    <div class="card-body text-center">

                        <div class="mb-md-5 mt-md-4">

                            <h2 class="fw-bold mb-2 text-uppercase">Modifier mes informations </h2>

                            <!-- Formulaire de modification du mail -->
                            <form action="post">
                                <div class="mb-3">

                                    <input class="form-control form-control-lg" type="email" name="mail"
                                        value="<?= $mail ?>" placeholder="Modifier votre mail" />
                                </div>
                                <div class="mb-3">
                                    <input class="btn btn-warning btn-lg ms-2" type="submit" name="modif_mail"
                                        value="Modifier " />
                                </div>
                            </form>

                            <!-- Formulaire de modification du prenom -->
                            <form action="post">
                                <div class="mb-3">
                                    <input class="form-control form-control-lg" type="text" name="Prenom" value=""
                                        placeholder="Modifier votre prenom" />
                                </div>
                                <div class="mb-3">
                                    <input class="btn btn-warning btn-lg ms-2" type="submit" name="modif_prenom"
                                        value="Modifier" />
                                </div>
                            </form>

                            <!-- Formulaire de modification du nom -->
                            <form action="post">
                                <div class="mb-3">
                                    <input class="form-control form-control-lg" type="text" name="Nom" value=""
                                        placeholder="Modifier votre nom" />
                                </div>
                                <div class="mb-3">
                                    <input class="btn btn-warning btn-lg ms-2" type="submit" name="modif_nom"
                                        value="Modifier" />
                                </div>
                            </form>

                            <!-- Formulaire de modification du mot de passe -->
                            <br>
                            <form action="post">
                                <div class="mb-3">
                                    <input class="form-control form-control-lg" type="password" name="oldpwd" value=""
                                        placeholder="Mot de passe actuel" />
                                </div>
                                <div class="mb-3">
                                    <input class="form-control form-control-lg" type="password" name="pwd" value=""
                                        placeholder="Nouveau mot de passe" />
                                </div>
                                <div class="mb-3">
                                    <input class="form-control form-control-lg" type="password" name="confpwd" value=""
                                        placeholder="Confirmation mot de passe" />
                                </div>
                                <div class="mb-3">
                                    <input class="btn btn-warning btn-lg ms-2" type="submit" name="modif_mdp"
                                        value="Modifier" />
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>