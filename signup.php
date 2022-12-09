<?php
require_once("header.php"); 


if(isset($_SESSION['id'])){
    header('Location: /');
    exit;
}// Si l'utilisateur est connecté à sa session, il ne peut pas accéder de nouveau à signup.php


if(!empty($_POST)){ 
    extract($_POST); // on extrait les données en methode POST si les variables ne sont pas vides

    $valid = (boolean) true;

    if(isset($_POST['compte'])){
        $prenom = trim($prenom);
        $nom = trim($nom);
        $pseudo = ucfirst(trim($pseudo));
        $mot_de_passe = trim($mot_de_passe);
        $mail =  trim($mail);

        $erreur_mail = "";
        $erreur_mdp = "";
        $erreur_pseudo = "";
    
        // SYSTEME DE VERIFICATION POUR LA CREATION DE COMPTES

        if(empty($pseudo)){
            $valid = false;
            $erreur_pseudo = "Ce champ ne peut pas être vide"; //Message d'erreur pour $pseudo si le champ est vide
        }else{
            $req = $bdd->prepare("SELECT id
            FROM utilisateurs 
            WHERE username = ?");
            
            $req->execute(array($pseudo));

            $req = $req->fetch();

            if(isset($req['id'])){
                $valid = false;
                $erreur_pseudo = "Ce pseudo est déjà pris !"; // On vient regarder dans la bdd si le pseudo est déjà pris, si oui,
                                                             // alors le message d'erreur s'affiche.
            } 
        }

        if(empty($mot_de_passe)){
            $valid = false;
            $erreur_mdp = "Ce champ ne peut pas être vide"; //Message d'erreur pour $mot_de_passe si le champ est vide
        }

        if(strlen($mot_de_passe) < 8){
            $valid =  false;
            $erreur_mdp = "Ce mot de passe doit faire au moins 8 caractères !"; // si le mdp fait pas minimum 8 caractères, un message d'erreur s'affiche
        }

        if(empty($mail)){
            $valid = false;
            $erreur_mail = "Ce champ ne peut pas être vide"; //Message d'erreur pour $mail si le champ est vide
        }elseif(!filter_var($mail, FILTER_VALIDATE_EMAIL)){ 
            $valid = false;
            $erreur_mail = "Format du mail invalide !";// Message d'erreur pour $mail si le format du mail n'est pas bon
        }else{
            $req = $bdd->prepare("SELECT id
            FROM utilisateurs 
            WHERE mail = ?");
            $req->execute(array($mail));

            $req = $req->fetch();

            if(isset($req['id'])){
                $valid = false;
                $erreur_mail = "Ce mail est déjà pris !";   // On vient regarder dans la bdd si le mail est déjà pris, si oui,
                                                           // alors le message d'erreur s'affiche.
            } 
        }
        
        // ENVOIE LES DONNEES A LA BDD UNE FOIS LA CREATION DE COMPTE COMPLETE
        
        if($valid){

            
            //$crypt_password = crypt($mot_de_passe, '$6$rounds=5000$3K00wzrKoV|uYO1zF}_9JT$]iuV}d4&WU+|LUT::Z:{_t3T+n5dR)#o/|vKz;nul$');
            $crypt_password = password_hash($mot_de_passe, PASSWORD_ARGON2ID);
            $req = $bdd->prepare("INSERT INTO utilisateurs(username, prenom, nom, mail, mot_de_passe) VALUES (?, ?, ?, ?, ?)");
            $req -> execute(array($pseudo, $prenom, $nom, $mail, $crypt_password));
            header('Location: login.php');
            exit;
        }
   
}
}

?>
<!-- utilisation de bootstrap pour le style -->
<div class="fondsignup" style="background-image: url('../ProjetSitePHP/_images/background.jpg');">
    <section class="h-100bg-dark">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col">
                    <div class="card card-registration my-4">
                        <div class="row g-0">
                            <div class="col-xl-6 d-none d-xl-block">
                                <img
                                    src="https://img.redbull.com/images/c_fill,g_auto,w_600,h_600/q_auto:low,f_auto/redbullcom/2017/06/12/8821db4c-9326-4491-bc64-8e5b3a28457b/darius-most-annoying-league-champions.jpg.jpg" />
                            </div>
                            <div class="col-xl-6">
                                <div class="card-body p-md-5 text-black">
                                    <h3 class="mb-5 text-uppercase">Création de Compte</h3>
                                    <form method="post">
                                        <!-- création du formulaire en methode post qui une renvoie vers la page login-->
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="form-outline">
                                                    <label class="form-label" for="form3Example1m">Prenom</label>
                                                    <input name="prenom" type="text" id="form3Example1m"
                                                        class="form-control form-control-lg"
                                                        value="<?php if(isset($prenom)){echo $prenom; } ?>" />
                                                </div>
                                            </div>
                                            <div class=" col-md-6 mb-4">
                                                <div class="form-outline">
                                                    <label class="form-label" for="form3Example1n">Nom</label>
                                                    <input name="nom" type="text" id="form3Example1n"
                                                        class="form-control form-control-lg"
                                                        value="<?php if(isset($nom)){echo $nom; } ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" row">
                                            <div class="col-md-6 mb-4">
                                                <div class="form-outline">
                                                    <?php if(isset($pseudo)){echo '<div style="color : red;">' . $erreur_pseudo . '</div>'; } ?>
                                                    <label style="color:red" ; class="form-label"
                                                        for="form3Example1m1">Pseudo</label>
                                                    <input name="pseudo" type="text" id="form3Example1m1"
                                                        class="form-control form-control-lg"
                                                        value="<?php if(isset($pseudo)){echo $pseudo; }"" ?>" />
                                                </div>
                                            </div>
                                            <div class=" col-md-6 mb-4">
                                                <div class="form-outline">
                                                    <?php if(isset($mot_de_passe)){echo '<div style="color : red;">' . $erreur_mdp . '</div>'; } ?>
                                                    <label style="color:red" ; class="form-label"
                                                        for="form3Example1n1">Mot
                                                        de Passe</label>
                                                    <input name="mot_de_passe" type="password" id="form3Example1n1"
                                                        class="form-control form-control-lg"
                                                        value="<?php if(isset($mot_de_passe)){echo $mot_de_passe; } ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" form-outline mb-4">
                                            <?php if(isset($mail)){echo '<div style="color : red;">' . $erreur_mail . '</div>'; } ?>
                                            <label style="color:red" ; class="form-label"
                                                for="form3Example97">Email</label>
                                            <input name="mail" type="text" id="form3Example97"
                                                class="form-control form-control-lg"
                                                value="<?php if(isset($mail)){echo $mail; } ?>" />
                                        </div>
                                        <div class="d-flex justify-content-end pt-1">
                                            * Les champs en rouge sont obligatoires
                                        </div>
                                        <div class="d-flex justify-content-end pt-3">
                                            <button name="compte" type="submit"
                                                class="btn btn-warning btn-lg ms-2">Créer le
                                                compte</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>