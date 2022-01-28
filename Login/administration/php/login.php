<?php 
    session_start();
    include_once "config.php";
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $now = date('Y-m-d H:i:s');
    $ip = file_get_contents('https://api.ipify.org');
require '../Geoip.class.php';
require 'vendor/autoload.php';
use GeoIp2\Database\Reader;
$reader = new Reader('GeoLite2-City.mmdb');

$record = $reader->city($ip);
$recordpays = $record->country->isoCode;
$recordville = $record->city->name;
/*$geoip = new Geoip();
$taillep = strlen($ip);
$record = $geoip->query($ip);
$recordville = $record['ville'];
$recordregion = $record['region'];
$recordlg = $record['lg'];
$recordlt = $record['lt'];
$recordpays = $record['pays'];*/
//var_dump($record);
    $bdd = new PDO('mysql:host=vikatch505.mysql.db;dbname=vikatch505;charset=utf8', 'vikatch505', 'Billitlebg59');
    if(!empty($email) && !empty($password)){
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
        if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
            $user_pass = $password;
            $status2 = $row['admin'];
            $enc_pass = $row['password'];
            if($user_pass === $enc_pass && $status2==1 ){
                $status = "En Ligne";
                $sql2 = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");
                if($sql2){
                    $_SESSION['unique_id'] = $row['unique_id'];
                   $_SESSION['id'] = $row['user_id'];
                   $etat='Succès : Connexion reussite';
                    echo "success";
                }else{
                    $etat='Erreur : Problème applicatif';
                
                    echo "Erreur. Patientez, puis connectez vous à nouveau dans quelques minutes";
                    
                }
            }elseif($user_pass === $enc_pass && $status2!=1 ) {
                echo "Vous n'avez pas les accès requis.";
                $etat="Erreur : Vous n'avez pas les accès requis";
                
            }else {
                $etat='Erreur : Email ou mot de passe incorrect';
                
                echo "Email ou Mot de Passe incorrect!";
            }
        }else{
            $etat='Erreur : Email inconnu';
            
            echo "Email ou Mot de Passe incorrect!";
        }
    }else{
        echo "All input fields are required!";
    }
?>


