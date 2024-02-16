<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="get">
        <label for="name">Nom : </label>
        <input type="text" name="name"> <br>
        <label for="noProduit">Numéro produit : </label>
        <input type="text" name="noProduit"> <br>
        <label for="prix">Prix : </label>
        <input type="number" name="prix"> <br>
        <label for="description">Description : </label>
        <input type="text" name="description"> <br>
        <input type="submit" name="submit" value="Enregistrer le produit">
    </form>

    <?php
    require_once("utils/DBconnect.php");
    require_once("dao/IProduitDao.php");
    require_once("dao/imp/IProduitDaoImp.php");

    $produitDao = new IProduitDaoImp();
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (
            isset($_GET['name'])
            && isset($_GET['noProduit'])
            && isset($_GET['prix'])
            && isset($_GET['description'])
        ) {
            $name = $_GET['name'];
            $noProduit = $_GET['noProduit'];
            $prix = $_GET['prix'];
            $description = $_GET['description'];

            $produitDao->saveProduit($name, $noProduit, $prix, $description);
        }
    }

    ?>
</body>

</html>