<?php

//fonctions utiles
function connecter()
{
    try {
        $dns = 'mysql:host=mysql.info.unicaen.fr;port=3306;dbname=22010720_bd;charset=utf8';
        $utilisateur = '22010720';
    	  $motDePasse = 'cheg3OoPh1imoh5i';
        // Options de connection
        $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                        );
        $connection = new PDO( $dns, $utilisateur, $motDePasse, $options );
        return($connection);


    } catch ( Exception $e ) {
        echo "Connection à MySQL impossible : ", $e->getMessage();
        die();
    }
}

//Méthode modifiée pour suivre le format IS0 imposé par la requête SQL
function controlerDate($valeur) {
    if (preg_match("/^(\d\d)(\d\d)[\/|\-|\.](\d{1,2})[\/|\-|\.]?(\d{1,2})$/", $valeur, $regs)) {
        $jour = ($regs[3] < 10) ? "0".$regs[3] : $regs[3];
        $mois = ($regs[2] < 10) ? "0".$regs[2] : $regs[2];
        if ($regs[4]) $an = $regs[3] . $regs[4];
              if (checkdate($mois, $jour, $an)) return true;
        else return false;
    }
    else return false;
}

function controlerNum($valeur, $strict=false) {
    if ($strict) {
        if (ereg("^[0-9]+$", $valeur)) return true;
        else return false;
    }
    else if (preg_match("/^[\d|\s|\-|\+|E|e|,|\.]+$/", $valeur)) return true;
    else return false;
}
function controlerTel($valeur) {
	if (preg_match('#(0|\+33)[1-9]( *[0-9]{2}){4}#', $valeur))
	return true;
	else return false;
}



class Animaux
{
    private $idP;
    private $nom;
    private $prenom;
    private $dateN;
    private $telephone;
    private $adresse;
    private $nom_animal;
    private $type_animal;
    private $race_animal;


    //Constructeur
    public function __construct($idP,$nom,$prenom,$dateN="0000-00-00",$telephone="xx xx xx xx xx", $adresse, $nom_animal, $type_animal, $race_animal)
    {
        $this->idP=$idP;
        $this->nom=$nom;
        $this->prenom=$prenom;
        $this->dateN=$dateN;
        $this->telephone=$telephone;
        $this->adresse=$adresse;
        $this->nom_animal=$nom_animal;
        $this->type_animal=$type_animal;
        $this->race_animal=$race_animal;
    }

    //
    public function __toString()
    {
        $ligneT= "(<u><b>".$this->idP."</b></u>, ".$this->nom.", ". $this->prenom.", ". $this->dateN.", ". $this->telephone.", ". $this->telephone.", ". $this->adresse.", ". $this->nom_animal.", ". $this->type_animal.", ". $this->race_animal." )<br>";
        return $ligneT;
    }
}



$idP=null;$nom = null;$prenom = null;$dateN = null;$lieuN =  null;$telephone = null;$adresse = null;  $nom_animal = null; $type_animal = null;  $race_animal = null;
$erreur=array("nom"=>null,"prenom"=>null,"dateN"=>null,"lieuN"=>null,"telephone"=>null,"adresse"=>null, "nom_animal" => null, "type_animal" => null, "race_animal" => null);
$tab_Animaux=array();
?>
