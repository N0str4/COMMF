<?php include '../config/config.php';
if(isset ($_GET["etat"])) { 
    $etat = $_GET["etat"]; 
    } else { 
    $etat = "ERROR"; // ou toute valeur par défaut... 
    }
    $id = (!empty($_GET['id']))? intval($_GET['id']) : 0;
    if(isset ($_GET["type"])) { 
        $type = $_GET["type"]; 
        } else { 
        $type = "ERROR"; // ou toute valeur par défaut... 
        }
 $now = date('Y-m-d H:i:s');   
 $req2 = $bdd->query("SELECT * FROM `users` WHERE `user_id` LIKE '$id'");
 $donnees2 = $req2->fetch();
$email = $donnees2["email"];

if($etat==1){

$final = "Attention : Message Accueil Supprimé";

}else {

    $final = "Erreur : Code Erroné";
    
    }
try{
      $req = $bdd->prepare("
      INSERT INTO logsconnexionocmf(Email, Date, Etat, IP)
      VALUES(:email, :date, :etat, :ip)");
      $req->bindParam(':email', $email);
      $req->bindParam(':date', $now);
      $req->bindParam(':etat', $final);
      $req->bindParam(':ip', $type);
      $req->execute();
  }   
  catch(PDOException $e){
      echo "Erreur : " . $e->getMessage();
  }?><script type="text/javascript">
  window.location.replace("http://intradef.vikatchev.com/Login/administration/index.php");
  </script>