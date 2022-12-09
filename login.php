<?php
require_once("header.php");


if(isset($_SESSION['ID'])){
    header('Location: index.php');
    exit;
} // Si l'utilisateur est connecté à sa session, il ne peut pas accéder de nouveau à login.php

if(!empty($_POST)){ 
    extract($_POST); // on extrait les données en methode POST si les variables ne sont pas vides

    $valid = (boolean) true;

    if(isset($_POST['connexion'])){
        $mail =  trim($mail);
        $mot_de_passe = trim($mot_de_passe);

        //SYSTEME DE VERIFICATION SI C'EST VIDE OU NON

        if(empty($mail)){
            $valid = false;
            $erreur_mail="Ce champ ne peut pas être vide !";
        }
        if(empty($mot_de_passe)){
            $valid = false;
            $erreur_mdp ="Ce champ ne peut pas être vide !";
        }

        // VERIFIE SI LE MOT DE PASSE CORRESPOND BIEN AU COMPTE ASSOCIE AVEC LE MAIL DONNE

        if($valid){
            $req = $bdd->prepare("SELECT mot_de_passe
            FROM utilisateurs 
            WHERE mail = ?");
            
            $req->execute(array($mail));

            $req = $req->fetch();

            if(isset($req['mot_de_passe'])){
                if (!password_verify($mot_de_passe, $req['mot_de_passe'])){
                    $valid = false;
                    $erreur_mail = "Les identifiants sont incorrectes.";
                }
            }else{
                $valid = false;
                $erreur_mail = "Les identifiants sont incorrectes.";
            }
        }

        // CREATION DE LA SESSION
        
        if($valid){
            $req = $bdd->prepare("SELECT *
            FROM utilisateurs 
            WHERE mail = ?");
            $req->execute(array($mail));

            $req_user = $req->fetch();
            
            if(isset($req_user['ID'])){

                $_SESSION['ID'] = $req_user['ID'];
                $_SESSION['mail'] = $req_user['mail'];
                $_SESSION['mot_de_passe'] = $req_user['mot_de_passe'];
                $_SESSION['administrateur'] = $req_user['administrateur'];
                
                header('Location: index.php');
                exit;
            }else{
                $valid = false;
                $erreur_mail = "Les identifiants sont incorrectes.";
            }
        }
      
}
}



?>



<section class="fondlogin" style="background-image: url('../ProjetSitePHP/_images/background.jpg');">
    <div class="container py-1 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                    <div class="card-body text-center">

                        <div class="mb-md-5 mt-md-4">

                            <h2 class="fw-bold mb-2 text-uppercase">Connexion</h2>
                            <p class="text-white-50 mb-5">Veuillez insérer vos identifiants</p>
                            <form method="post">

                                <div class="form-outline form-white mb-4">
                                    <?php if(isset($erreur_mail)){echo '<div style="color : red;">' . $erreur_mail . '</div>'; } ?>
                                    <input name="mail" type="email" id="typeEmailX" class="form-control form-control-lg"
                                        value="<?php if(isset($mail)){echo $mail; } ?>" />
                                    <label class="form-label" for="typeEmailX">Email</label>
                                </div>
                                <div class="form-outline form-white mb-4">
                                    <?php if(isset($erreur_mdp)){echo '<div style="color : red;">' . $erreur_mdp . '</div>'; } ?>
                                    <input name="mot_de_passe" type="password" id="typePasswordX"
                                        class="form-control form-control-lg"
                                        value="<?php if(isset($mot_de_passe)){echo $mot_de_passe; } ?>" />
                                    <label class="form-label" for="typePasswordX">Mot de Passe</label>
                                </div>

                                <button type="submit" name="connexion"
                                    class="btn btn-outline-light btn-lg px-5">Connexion</button>
                            </form>
                        </div>
                        <div>
                            <p class="mb-0">Vous n'avez pas de compte ?<a href="signup.php"
                                    class="text-white-50 fw-bold">Créer un compte</a>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>