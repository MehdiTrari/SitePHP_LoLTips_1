<?php
require_once("header.php");



  $host = 'localhost';
  $dbname = 'projetphp';
  $username = 'root';
  $password = '';
    
  $dsn = "mysql:host=$host;dbname=$dbname"; 
  // récupérer tous les utilisateurs
  $sql = "SELECT ID, username FROM utilisateurs ";
  

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



<section class="fondlogin" style="background-image: url('../ProjetSitePHP/_images/fondmembres.jpg');">
    <div class="container py-1 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-24 col-md-24 col-lg-24 col-xl-24">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">

                    <div class="card-body text-center">

                        <div class="mb-md-5 mt-md-4">

                            <h2 class="fw-bold mb-2 text-uppercase">Membres</h2>
                            <div class="row">
                                <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                                <tr>
                                    <div class="col-3">
                                        <div>
                                            <td><?php echo htmlspecialchars($row['ID']); ?></td>
                                            <!-- on affiche l'id de l'utilisateur -->
                                            <td><?php echo htmlspecialchars($row['username']); ?></td>
                                            <!-- on affiche son pseudo -->
                                        </div>
                                        <div>
                                            <a href="voir-profil.php?ID=<?= $row['ID'] ?>"> ↪ Voir profil</a>
                                            <!-- Création d'un lien vers le profil de l'utilisateur en fonction de son ID dans la liste des membres -->
                                        </div>
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