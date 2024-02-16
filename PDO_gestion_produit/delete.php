<?php
require_once("utils/DBconnect.php");
require_once("dao/IProduitDao.php");
require_once("dao/imp/IProduitDaoImp.php");

$produitDao = new IProduitDaoImp();

if (isset($_GET["id"])) {
    $produitDao->deleteProduit($_GET['id']);
    header('Location: base.php');
}

