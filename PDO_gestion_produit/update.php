<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php    
require_once("utils/DBconnect.php");
require_once("dao/IProduitDao.php");
require_once("dao/imp/IProduitDaoImp.php");
require_once("model/Produit.php");

$produitDao = new IProduitDaoImp();
$produit_id = $_GET['id'];

$result = $produitDao->getPersonById($produit_id);

$produit = new Produit(
    $result['id'],
    $result['name'],
    $result['prix'],
    $result['noProduit'],
    $result['description'],
)
?>

<form action="" method="post">
        <label for="name">Nom : </label>
        <input type="text" name="name" value="<?= $produit->getName() ?>"> <br>

        <label for="noProduit">Numéro produit : </label>
        <input type="text" name="noProduit" value="<?= $produit->getNoProduit() ?>"> <br>

        <label for="prix">Prix : </label>
        <input type="number" name="prix" value="<?= $produit->getPrix() ?>"> <br>

        <label for="description">Description : </label>
        <input type="text" name="description" value="<?= $produit->getDescription() ?>"> <br>

        <input type="submit" name="submit" value="Modifier le produit">
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $noProduit = $_POST['noProduit'];
        $prix = $_POST['prix'];
        $description = $_POST['description'];

        $produitDao->updateProduit($name, $noProduit, $prix, $description, $id);

        header('Location: base.php');
    }
?>

</body>
</html>