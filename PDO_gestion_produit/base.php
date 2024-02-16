<?php
require_once("utils/DBconnect.php");
require_once("dao/IProduitDao.php");
require_once("dao/imp/IProduitDaoImp.php");
require_once("model/Produit.php");


$produitDao = new IProduitDaoImp();

$produits = $produitDao->getAllProduit();

foreach ($produits as $produit) {
    echo $produit;
    ?>
    <a href="delete.php?id<?= $produit->getId() ?>">
        <button>Supprimer</button>
    </a>
    <a href="update.php?id<?= $produit->getId() ?>">
        <button>Modifier</button>
    </a>
    <hr>



    <?php
}
?>