<?php

include '../config/config.php';
$id = (!empty($_GET['id']))? intval($_GET['id']) : 0;




    try{
        
        $age = 1;
        $req = $bdd->prepare("UPDATE users SET `admin` = :adm WHERE `user_id` = :coucou");
        $req->bindParam(':adm', $age, PDO::PARAM_INT);
        $req->bindParam(':coucou', $id);
        $req->execute();
    }
          
    catch(PDOException $e){
        echo "Erreur : " . $e->getMessage();
    }

?>
<script type="text/javascript">
                window.location.replace("http://intradef.vikatchev.com/Login/administration/acces.php");
            </script>