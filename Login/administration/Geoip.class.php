<?php
/*
 * Geoip.class.php
 * Classe d'utilisation de l'API geolocalise-ip.com
 * Compatible PHP 5+
**/
class Geoip {
    # Credentials
    private $email;
    private $pass;
 
    # URL de l'API
    public $endpoint;
 
    # Constructeur
    public function __construct(){
        $this->email = 'aymerickvalois@yahoo.fr';
        $this->pass  = 'Passw0rd';
        $this->endpoint = "http://www.geolocalise-ip.com/api.php";
    }
 
    # Set credential (private car confidentiel)
    public function setEmail($email = null){ $this->email = $email; }
    public function setPass($pass = null)  { $this->pass = $pass; }
 
    # Query : retourne les infos de géolosalisation pour l'IP passée en paramètre
    public function query($ip){
        # Check param
        if( empty($ip) ){
            trigger_error("L'ip est vide.", E_USER_WARNING);
            return false;
        }
 
        # Appel de l'API
        $url = $this->endpoint.'?'.http_build_query(array(
            'email' => $this->email,
            'pass'  => $this->pass,
            'ip'    => $ip
        ));
        $return['apiRequest'] = $url;
        $result = file_get_contents($url);
        if( $result == false || empty($result) ){
            $return['erreur'] = 1;
            $return['erreur_msg'] = "API indisponible ($url)";
            return $return;
        }
        $result = utf8_encode($result);
        $return['apiResponse'] = $result;
 
        # Decodage de la réponse
        # 1. Isolation du message d'erreur à la fin
        if( preg_match('#^(.*?&erreur=.*?)<(.*)$#i', $result, $matches) ){
            $result = $matches[1];
            $return['erreur_msg'] = '<'.trim($matches[2]);
        }
 
        # 2. Parse
        parse_str($result, $geo);
 
        # Retour
        $return = array_merge($return, $geo);
        return $return;
    }
}
?>