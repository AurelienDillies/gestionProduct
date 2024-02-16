<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="" method="get">
    <label for="id_produit">id du produit :</label>
    <input type="number" name="id_produit">
    <input type="submit" name="submit" value="Chercher">
</form>    
<?php
require_once("utils/DBconnect.php");
require_once("dao/IProduitDao.php");
require_once("dao/imp/IProduitDaoImp.php");
require_once("model/Produit.php");

$produitDao = new IProduitDaoImp();

?>
</body>
</html>