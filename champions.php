<?php
require_once("header.php");



  $host = 'localhost';
  $dbname = 'projetphp';
  $username = 'root';
  $password = '';
    
  $dsn = "mysql:host=$host;dbname=$dbname"; 
  // récupérer tous les champions
  $sql = "SELECT * FROM champions";
   
  try{
   $pdo = new PDO($dsn, $username, $password);
   $stmt = $pdo->query($sql);
   
   if($stmt === false){
    die("Erreur");
   }
   
  }catch (PDOException $e){
    echo $e->getMessage();
  }


?>



<section class="fondlogin" style="background-image: url('../ProjetSitePHP/_images/fondchampions.jpg');
background-size: 1920px 1080px;
background-repeat: repeat-y;">
    <div class="container py-1 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-24 col-md-24 col-lg-24 col-xl-24">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">

                    <div class="card-body text-center">

                        <div class="mb-md-5 mt-md-4">

                            <h2 class="fw-bold mb-2 text-uppercase">Champions</h2>
                            <div class="row">
                                <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                                <tr>
                                    <div class="col-3">
                                        <td><?php echo htmlspecialchars($row['champ_ID']);
                                    echo " : "; ?></td>
                                        <!-- on affiche l'id de l'utilisateur -->
                                        <td><?php echo htmlspecialchars($row['champ_nom']); ?></td>
                                        <!-- on affiche son pseudo -->

                                        <a href="voir-tips.php?champ_ID=<?= $row['champ_ID'] ?>"> ➡️ Voir les tips</a>
                                        <!-- Création d'un lien vers le profil de l'utilisateur en fonction de son ID dans la liste des membres -->
                                    </div>
                                </tr>
                                <?php  endwhile; ?>
                                <!-- à chaque nouvel utilisateur, cela va passer une ligne pour les afficher en colonne-->
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>