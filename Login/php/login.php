<?php 
    session_start();
    include_once "config.php";
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $now = date('Y-m-d H:i:s');
    $ip = $_SERVER['REMOTE_ADDR'];
    require 'Geoip.class.php';
require 'vendor/autoload.php';
use GeoIp2\Database\Reader;
$reader = new Reader('GeoLite2-City.mmdb');

$record = $reader->city($ip);
$recordpays = $record->country->isoCode;
$recordville = $record->city->name;
$recordlg = $record->location->longitude;
$recordlt = $record->location->latitude;
    $bdd = new PDO('mysql:host=vikatch505.mysql.db;dbname=vikatch505;charset=utf8', 'vikatch505', 'Billitlebg59');
    if(!empty($email) && !empty($password)){
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
        if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
            $user_pass = $password;
            $enc_pass = $row['password'];
            
            if($user_pass === $enc_pass){
                $status = "En Ligne";
                $sql2 = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");
                if($sql2){
                    $_SESSION['unique_id'] = $row['unique_id'];
                    $_SESSION['id'] = $row['user_id'];
                    $_SESSION['admin'] = $row['admin'];
                    $etat='Succès : Connexion reussite';
                    if (empty($recordville)){
                        $recordville = 'N/A';
                        $recordlg = 'N/A';
                        $recordlt = 'N/A';
                        try{
        
                            $req = $bdd->prepare("
                            INSERT INTO logsconnexionocmf(Email, Date, Etat, IP, Pays, Localisation, Latitude, Longitude)
                            VALUES(:email, :date, :etat, :ip, :pays, :local, :lat, :long)");
                            $req->bindParam(':email', $email);
                            $req->bindParam(':date', $now);
                            $req->bindParam(':etat', $etat);
                            $req->bindParam(':ip', $ip);
                            $req->bindParam(':pays', $recordpays);
                            $req->bindParam(':local', $recordville);
                            $req->bindParam(':lat', $recordlt);
                            $req->bindParam(':long', $recordlg);
                            $req->execute();
                            }
                              
                            catch(PDOException $e){
                            echo "Erreur : " . $e->getMessage();
                            }
                    }elseif(!empty($recordville)){
                        try{
        
                            $req = $bdd->prepare("
                            INSERT INTO logsconnexionocmf(Email, Date, Etat, IP, Pays, Localisation, Latitude, Longitude)
                            VALUES(:email, :date, :etat, :ip, :pays, :local, :lat, :long)");
                            $req->bindParam(':email', $email);
                            $req->bindParam(':date', $now);
                            $req->bindParam(':etat', $etat);
                            $req->bindParam(':ip', $ip);
                            $req->bindParam(':pays', $recordpays);
                            $req->bindParam(':local', $recordville);
                            $req->bindParam(':lat', $recordlt);
                            $req->bindParam(':long', $recordlg);
                            $req->execute();
                            }
                              
                            catch(PDOException $e){
                            echo "Erreur : " . $e->getMessage();
                            }

                    }
                    echo "success";
                }else{
                    $etat='Erreur : Problème applicatif';
                    if (empty($recordville)){
                        $recordville = 'N/A';
                        $recordlg = 'N/A';
                        $recordlt = 'N/A';
                        try{
        
                            $req = $bdd->prepare("
                            INSERT INTO logsconnexionocmf(Email, Date, Etat, IP, Pays, Localisation, Latitude, Longitude)
                            VALUES(:email, :date, :etat, :ip, :pays, :local, :lat, :long)");
                            $req->bindParam(':email', $email);
                            $req->bindParam(':date', $now);
                            $req->bindParam(':etat', $etat);
                            $req->bindParam(':ip', $ip);
                            $req->bindParam(':pays', $recordpays);
                            $req->bindParam(':local', $recordville);
                            $req->bindParam(':lat', $recordlt);
                            $req->bindParam(':long', $recordlg);
                            $req->execute();
                            }
                              
                            catch(PDOException $e){
                            echo "Erreur : " . $e->getMessage();
                            }
                    }elseif(!empty($recordville)){
                        try{
        
                            $req = $bdd->prepare("
                            INSERT INTO logsconnexionocmf(Email, Date, Etat, IP, Pays, Localisation, Latitude, Longitude)
                            VALUES(:email, :date, :etat, :ip, :pays, :local, :lat, :long)");
                            $req->bindParam(':email', $email);
                            $req->bindParam(':date', $now);
                            $req->bindParam(':etat', $etat);
                            $req->bindParam(':ip', $ip);
                            $req->bindParam(':pays', $recordpays);
                            $req->bindParam(':local', $recordville);
                            $req->bindParam(':lat', $recordlt);
                            $req->bindParam(':long', $recordlg);
                            $req->execute();
                            }
                              
                            catch(PDOException $e){
                            echo "Erreur : " . $e->getMessage();
                            }

                    }
                    echo "Something went wrong. Please try again!";
                }
            }else{
                $etat='Erreur : Email ou mot de passe incorrect';
                if (empty($recordville)){
                    $recordville = 'N/A';
                    $recordlg = 'N/A';
                    $recordlt = 'N/A';
                    try{
    
                        $req = $bdd->prepare("
                        INSERT INTO logsconnexionocmf(Email, Date, Etat, IP, Pays, Localisation, Latitude, Longitude)
                        VALUES(:email, :date, :etat, :ip, :pays, :local, :lat, :long)");
                        $req->bindParam(':email', $email);
                        $req->bindParam(':date', $now);
                        $req->bindParam(':etat', $etat);
                        $req->bindParam(':ip', $ip);
                        $req->bindParam(':pays', $recordpays);
                        $req->bindParam(':local', $recordville);
                        $req->bindParam(':lat', $recordlt);
                        $req->bindParam(':long', $recordlg);
                        $req->execute();
                        }
                          
                        catch(PDOException $e){
                        echo "Erreur : " . $e->getMessage();
                        }
                }elseif(!empty($recordville)){
                    try{
    
                        $req = $bdd->prepare("
                        INSERT INTO logsconnexionocmf(Email, Date, Etat, IP, Pays, Localisation, Latitude, Longitude)
                        VALUES(:email, :date, :etat, :ip, :pays, :local, :lat, :long)");
                        $req->bindParam(':email', $email);
                        $req->bindParam(':date', $now);
                        $req->bindParam(':etat', $etat);
                        $req->bindParam(':ip', $ip);
                        $req->bindParam(':pays', $recordpays);
                        $req->bindParam(':local', $recordville);
                        $req->bindParam(':lat', $recordlt);
                        $req->bindParam(':long', $recordlg);
                        $req->execute();
                        }
                          
                        catch(PDOException $e){
                        echo "Erreur : " . $e->getMessage();
                        }

                }
                echo "Email ou Mot de Passe incorrect!";
            }
        }else{
            $etat='Erreur : Email inconnu';
            if (empty($recordville)){
                $recordville = 'N/A';
                $recordlg = 'N/A';
                $recordlt = 'N/A';
                try{

                    $req = $bdd->prepare("
                    INSERT INTO logsconnexionocmf(Email, Date, Etat, IP, Pays, Localisation, Latitude, Longitude)
                    VALUES(:email, :date, :etat, :ip, :pays, :local, :lat, :long)");
                    $req->bindParam(':email', $email);
                    $req->bindParam(':date', $now);
                    $req->bindParam(':etat', $etat);
                    $req->bindParam(':ip', $ip);
                    $req->bindParam(':pays', $recordpays);
                    $req->bindParam(':local', $recordville);
                    $req->bindParam(':lat', $recordlt);
                    $req->bindParam(':long', $recordlg);
                    $req->execute();
                    }
                      
                    catch(PDOException $e){
                    echo "Erreur : " . $e->getMessage();
                    }
            }elseif(!empty($recordville)){
                try{

                    $req = $bdd->prepare("
                    INSERT INTO logsconnexionocmf(Email, Date, Etat, IP, Pays, Localisation, Latitude, Longitude)
                    VALUES(:email, :date, :etat, :ip, :pays, :local, :lat, :long)");
                    $req->bindParam(':email', $email);
                    $req->bindParam(':date', $now);
                    $req->bindParam(':etat', $etat);
                    $req->bindParam(':ip', $ip);
                    $req->bindParam(':pays', $recordpays);
                    $req->bindParam(':local', $recordville);
                    $req->bindParam(':lat', $recordlt);
                    $req->bindParam(':long', $recordlg);
                    $req->execute();
                    }
                      
                    catch(PDOException $e){
                    echo "Erreur : " . $e->getMessage();
                    }

            }
            echo "Email ou Mot de Passe incorrect!";
        }
    }else{
        echo "All input fields are required!";
    }
?>