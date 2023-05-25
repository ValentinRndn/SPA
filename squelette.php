<!doctype html>
<html lang="fr">
<head>
  <title>SPA</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="style/style.css"  type="text/css" >
</head>
<body>
  <div class="container">
    <h1>SPA</h1>
    <hr>
    <div class="navigation">
        <a href="index.php?action=insert">Ajouter un animal</a>
        <a href="index.php?action=liste">Liste d'animau(x)</a>
        <a href="index.php?action=a_propos">À propos</a>
    </div>
    <hr>
      <table class="tabM">
        <tr>
            <td class="tdM"><?php  echo $zonePrincipale; ?>  </td>
        </tr>
      </table>
  </div>
</body>
</html>
