<?php

    //Classe responsable de la sauvegarde des données
   $connection =connecter();
   $type = key_exists('type',$_POST)? $_POST['type']: null;
   $idP = key_exists('idP',$_POST)? $_POST['idP']: null;
   $sql = key_exists('sql',$_POST)? $_POST['sql']: null;
   if ($type =='confirmupdate'){
       $corps="<h1>Mise à jour de la personne ".$idP."</h1>" ;
   }
   else{
       $corps="<h1>Suppression de la personne ".$idP."</h1>" ;
   }

   $req=$connection->prepare($sql);
   $req->execute();
   $connection = null;
   $zonePrincipale=$corps ;
?>
