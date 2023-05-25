<?php

    #Classe à propos
    //On intègre toutes les variables au corps du texte
    $corps = '<h1>Détails sur le créateur du site</h1>';
    $corps .= '<h4><u><b>Auteur : </b></u></h4>';
	$corps .= '<p><b>Nom : RENAUDIN </b></p>';
	$corps .= '<p><b>Prénom : Valentin</b></p>';
	$corps .= '<p><b>Numéro ETU : 22010720 </b></p>';
	$corps .= '<h4><u><b>Possibilités : </b></u></h4>';
	$corps .= '<p><b>- Ajouter un animal et son propriétaire à une base de données</b></p>';
	$corps .= '<p><b>- Voir le détail d\'une ligne de la base </b></p>';
	$corps .= '<p><b>- Modifier une ligne de la base </b></p>';
	$corps .= '<p><b>- Supprimer une ligne de la base </b></p>';
    $query = null;
    $connection = null;
    $zonePrincipale=$corps ;
?>
