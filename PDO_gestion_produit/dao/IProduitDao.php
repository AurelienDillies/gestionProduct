<?php
require_once("utils/DBconnect.php");
require_once("dao/IProduitDao.php");
require_once("dao/imp/IProduitDaoImp.php");
interface IProduitDao
{
    function saveProduit(string $name, string $noProduit, int $prix, string $description);
    function getAllProduit(): array;
    function updateProduit(string $name, string $noProduit, int $prix, string $description, int $id);
    function getProduitByName(string $name): array;
    function ProduitByPriceIN($minPrix, $maxPrix): array;
    function getPersonById(int $id): array;
    function deleteProduit(int $id): bool;
}


