<?php
       $idP=$_GET["idP"]; //On récupère l'identifiant de l'élément en question
       $connection =connecter(); //On se connecte à la base de données

       $requete="SELECT * FROM Animaux where idP=$idP"; //On récupère les infos de la table
       $query= $connection->query($requete);
       $query->setFetchMode(PDO::FETCH_OBJ);

       //On parcourt tous les élements de l'objet
       while( $enregistrement = $query->fetch() )
       {
           $idP=$enregistrement->idP;
           $nom=$enregistrement->nom;
           $prenom=$enregistrement->prenom;
           $dateN=$enregistrement->dateN;
           $telephone=$enregistrement->telephone;
           $adresse=$enregistrement->adresse;
           $nom_animal=$enregistrement->nom_animal;
           $type_animal=$enregistrement->type_animal;
           $race_animal=$enregistrement->race_animal;
       }
$cible='update';
//On vérifie que les variables ne sont pas nulles
if (!isset($_POST["nom"])	&& !isset($_POST["prenom"]) && !isset($_POST["dateN"])&& !isset($_POST["telephone"])&& !isset($_POST["adresse"])&& !isset($_POST["nom_animal"])&& !isset($_POST["type_animal"])&& !isset($_POST["race_animal"]))
{
 include("form.html");
}
//Messages d'erreur associés
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
  #else if(controlerDate($dateN) == false) $erreur["dateN"] = "date incorrecte";

  if ($telephone=="") $erreur["telephone"] ="il manque un telephone ";
  #else if(controlerTel($telephone) == false) $erreur["telephone"] = "numéro incorrecte";

  if ($adresse=="") $erreur["adresse"] ="il manque une adresse";

  if ($nom_animal=="") $erreur["nom_animal"] ="il manque le nom de l'animal";
  if ($type_animal=="") $erreur["type_animal"] ="il manque le type de l'animal";
  if ($race_animal=="") $erreur["race_animal"] ="il manque la race de l'animal";

 $compteur_erreur=count($erreur);
 foreach ($erreur as $cle=>$valeur){
   if ($valeur==null) $compteur_erreur=$compteur_erreur-1;
 }

//Si aucune erreur, on actualise la table avec les nouvelles données
 if ($compteur_erreur == 0) {
   #$sql = "UPDATE PersonnE SET nom=?, prenom=? WHERE idP=?";
   $sql="update Animaux set nom='$nom', prenom='$prenom', dateN='$dateN', telephone='$telephone', adresse='$adresse', nom_animal='$nom_animal', type_animal='$type_animal', race_animal='$race_animal' where idP='$idP'";
   $tab='<form action="index.php?action=sauvegarde" method="post">
       <input type="hidden" name="type" value="'.'confirmupdate'.'"/>
       <input type="hidden" name="idP" value="'.$idP.'"/>
       <input type="hidden" name="sql" value="'.$sql.'"/>
       <p>Etes vous sûr de vouloir mettre à jour cet enregistrement ?</p>
       <p>
         <input type="submit" value="Enregistrer" class="btn btn-danger">
         <a href="index.php?action=liste" class="btn btn-secondary">Annuler</a>
       </p>
   </form>';
   $corps = $tab;
   $zonePrincipale=$corps ;
 }
 else {
   include("form.html");
 }
}

$connection = null;
?>
