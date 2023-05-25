<?php

    #Classe responsable du détail d'une personne et de son animal


    $idP=$_GET["idP"];  //On récupère l'identifiant de l'élément en question
    $corps = '<h1>Détails de la personne et son animal</h1>';
    $connection =connecter(); //On se connecte à la base de données
    $requete="SELECT * FROM Animaux where idP=$idP"; //On récupère les infos de la table
    $query  = $connection->query($requete);
    $query->setFetchMode(PDO::FETCH_OBJ);
    while( $enregistrement = $query->fetch() )
    {
    //On intègre toutes les variables au corps du texte
	$corps .= '<p><b>Identifiant :</b> ' . $enregistrement->idP. '</p>';
	$corps .= '<p><b>Nom :</b> ' . $enregistrement->nom. '</p>';
	$corps .= '<p><b>Prénom :</b> ' . $enregistrement->prenom . '</p>';
	$corps .= '<p><b>Date :</b> ' . $enregistrement->dateN . '</p>';
	$corps .= '<p><b>Téléphone :</b> ' . $enregistrement->telephone . '</p>';
	$corps .= '<p><b>Adresse :</b> ' . $enregistrement->adresse . '</p>';
	$corps .= '<p><b>Nom de l\'animal :</b> ' . $enregistrement->nom_animal . '</p>';
	$corps .= '<p><b>Type de l\'animal :</b> ' . $enregistrement->type_animal . '</p>';
	$corps .= '<p><b>Race de l\'animal :</b> ' . $enregistrement->race_animal . '</p>';


}
    $query = null;
    $connection = null;
    $zonePrincipale=$corps ;
?>
