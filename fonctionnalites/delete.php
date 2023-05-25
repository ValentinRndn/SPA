<?php
//Classe responsable de la supression d'un élément

$idP=$_GET["idP"]; //On récupère l'identifiant de l'élément en question
$connection =connecter(); //On se connecte à la base de données
$sql="DELETE FROM Animaux where idP like '$idP'";  //On récupère les infos de la table

//Formulaire qui demande la confirmation de la supression
$tab='
<form action="index.php?action=sauvegarde" method="post">
    <input type="hidden" name="type" value="confirmdelete"/>
    <input type="hidden" name="idP" value="'.$idP.'"/>
    <input type="hidden" name="sql" value="'.$sql.'"/>
    <p>Etes vous sûr de vouloir supprimer cette personne et son animal ?</p>
    <p>
        <input type="submit" value="Enregistrer" class="btn btn-danger">
        <a href="index.php?action=liste" class="btn btn-secondary">Annuler</a>
    </p>
</form>';
$corps = $tab;
$zonePrincipale=$corps ;
$connection = null;

?>
