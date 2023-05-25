<?php
require_once("Lib.php");
$action = key_exists('action', $_GET)? trim($_GET['action']): null;
$sauvegarde = key_exists('sauvegarde', $_GET)? trim($_GET['sauvegarde']): null;
switch ($action) {

	case "liste": //liste complète
		$corps="<h1>Liste des Personnes et leurs Animaux</h1>";
		$connection =connecter();
		$requete="SELECT * FROM Animaux";

		// On envois la requète
		$query  = $connection->query($requete);

		// On indique que nous utiliserons les résultats en tant qu'objet
		$query->setFetchMode(PDO::FETCH_OBJ);

		// Nous traitons les résultats en boucle
		$corps.= "<h4><span class='c1'><b><u>IdP</u></b></span> <span class='c1'>Nom</span> <span class='c1'>Prenom</span> <span class='c1'>Nom de l'animal </span> </h4>";

		while( $enregistrement = $query->fetch() )
		{
			//$tab_Personne[$enregistrement->idP]=array($enregistrement->nom,$enregistrement->prenom);
			// Affichage des enregistrements
			$idP=$enregistrement->idP;$nom=$enregistrement->nom;$prenom=$enregistrement->prenom;$nom_animal=$enregistrement->nom_animal;
			$tab_Animaux[$idP]=array($nom,$prenom);
			$corps.= "<span class='c1'><u><b>".$enregistrement->idP."</b></u> </span> <span class='c1'>". $enregistrement->nom." </span> <span class='c1'>".$enregistrement->prenom." </span> <span class='c1'>".$enregistrement->nom_animal." </span>";
			$corps.=  '<span class=\'c1\'><a href="index.php?action=select&idP='. $enregistrement->idP.'"><span class="glyphicon glyphicon-eye-open"></span></a>';
			$corps.=  '<a href="index.php?action=update&idP='. $enregistrement->idP.'"><span class="glyphicon glyphicon-pencil"></span></a>';
			$corps.=  '<a href="index.php?action=delete&idP='. $enregistrement->idP.'"><span class="glyphicon glyphicon-trash"></span></a></span>';
			$corps.="<br>";

		}
		$zonePrincipale=$corps ;
		$query = null;
		$connection = null;
		break;

	case "sauvegarde":
		include("fonctionnalites/sauvegarde.php");
    break;

	case "select":
    $cible='select';
    include('fonctionnalites/details.php');
    break;
    
	case "update": //un id particulier
    $cible='update';
    include('fonctionnalites/update.php');
    break;

	case "delete":
		include("fonctionnalites/delete.php");
		break;

	case "a_propos":
        include("fonctionnalites/propos.php");
        break;


	case "insert": //Saisie  via le formulaire	et insertion dans la base de données
		$cible='insert';
		if (!isset($_POST["nom"])	&& !isset($_POST["prenom"]) && !isset($_POST["dateN"])&& !isset($_POST["telephone"])&& !isset($_POST["adresse"])&& !isset($_POST["nom_animal"])&& !isset($_POST["type_animal"])&& !isset($_POST["race_animal"]))
		{
			include("form.html");
		}
		else{
			$nom = key_exists('nom', $_POST)? trim($_POST['nom']): null;
			$prenom = key_exists('prenom', $_POST)? trim($_POST['prenom']): null;
			$dateN = key_exists('dateN', $_POST)? trim($_POST['dateN']): null;
			$telephone = key_exists('telephone', $_POST)? trim($_POST['telephone']): null;
			$adresse = key_exists('adresse', $_POST)? trim($_POST['adresse']): null;
			$nom_animal= key_exists('nom_animal', $_POST)? trim($_POST['nom_animal']): null;
			$type_animal= key_exists('type_animal', $_POST)? trim($_POST['type_animal']): null;
			$race_animal= key_exists('race_animal', $_POST)? trim($_POST['race_animal']): null;
			if ($nom=="") 	$erreur["nom"] ="il manque un nom";

			if ($prenom=="") $erreur["prenom"] ="il manque un prenom";

			if ($dateN=="") $erreur["dateN"] ="il manque une date";
			else if(controlerDate($dateN) == false) $erreur["dateN"] = "date incorrecte";

			if ($telephone=="") $erreur["telephone"] ="il manque un telephone ";
			else if(controlerTel($telephone) == false) $erreur["telephone"] = "numéro incorrecte";

			if ($adresse=="") $erreur["adresse"] ="il manque une adresse";
			if ($nom_animal=="") $erreur["nom_animal"] ="il manque le nom de l'animal";
			if ($type_animal=="") $erreur["type_animal"] ="il manque le type de l'animal";
			if ($race_animal=="") $erreur["race_animal"] ="il manque la race de l'animal";

			$compteur_erreur=count($erreur);
			foreach ($erreur as $cle=>$valeur){
				if ($valeur==null) $compteur_erreur=$compteur_erreur-1;
			}

			if ($compteur_erreur == 0) {
				$connection =connecter();
				$corps = "Connection etablie <br>";
				$corps .= "Il faut maintenant insérer les données du formulaire dans la base <br>";
				$corps .= "et récupérer l'identifiant". $idP. "<br>";

				//Ecriture de la requête
				$sql = "INSERT INTO `Animaux`(`nom`, `prenom`, `dateN`, `telephone`, `adresse`, `nom_animal`, `type_animal`, `race_animal`) VALUES(:nom, :prenom, :dateN, :telephone, :adresse, :nom_animal, :type_animal, :race_animal)";

				$dateN = date("Y-m-d", strtotime($dateN));
				//Préparation de la requête
				$query = $connection->prepare($sql);

				//Injection des valeurs
				$query->bindValue(":nom", $nom, PDO::PARAM_STR);
				$query->bindValue(":prenom", $prenom, PDO::PARAM_STR);
				$query->bindValue(":dateN", $dateN, PDO::PARAM_STR);
				$query->bindValue(":telephone", $telephone, PDO::PARAM_STR);
				$query->bindValue(":adresse", $adresse, PDO::PARAM_STR);
				$query->bindValue(":nom_animal", $nom_animal, PDO::PARAM_STR);
				$query->bindValue(":type_animal", $type_animal, PDO::PARAM_STR);
				$query->bindValue(":race_animal", $race_animal, PDO::PARAM_STR);

				//Exécution de la requête
				if(!$query->execute()) {
					die("Une erreur est survenue");
				}
				else {
					die("Cette personne et son animal ont été ajoutés à la base de données avec succès !");
				}

				$patient = new Animaux($idP,$nom,$prenom, $dateN, $telephone, $adresse, $nom_animal, $type_animal, $race_animal);
				$corps .= "Saisie de : ". $patient;

				$zonePrincipale=$corps ;
				$connection = null;
			}
			else {
				include("form.html");
			}
		}
		break;





    $corps = $tab;
    $zonePrincipale=$corps ;
    $connection = null;



 default:
   $zonePrincipale="" ;
   break;

}
include("squelette.php");

?>