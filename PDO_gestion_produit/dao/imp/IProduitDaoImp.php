<?php
require_once("utils/DBconnect.php");
require_once("dao/IProduitDao.php");
require_once("dao/imp/IProduitDaoImp.php");
class IProduitDaoImp implements IProduitDao
{
    // Propriété pour stocker l'instance de connexion à la base de données
    private PDO $connexion;

    // Constructeur pour initialiser la connexion à la base de données
    public function __construct()
    {
        // Obtention de l'instance de connexion à la base de données via le singleton DBconnect
        $this->connexion = DBconnect::getInstance(
            "mysql:host=localhost;dbname=gestprod",
            "root",
            ""
        )->getConnexion();
    }

    public function saveProduit(
        string $name,
        string $noProduit,
        int $prix,
        string $description
    ) {
        try {
            // Définition de la requête SQL pour insérer une nouvelle personne dans la table 'persons'
            $query = "INSERT INTO produit (name, noProduit, prix, description) VALUES (:name, :noProduit, :prix, :description)";

            // Préparation de la requête SQL
            $stmt = $this->connexion->prepare($query);

            // Liaison des valeurs des champs du formulaire avec les paramètres de la requête SQL
            $stmt->bindValue(':name', $name);
            $stmt->bindValue(':noProduit', $noProduit);
            $stmt->bindValue(':prix', $prix);
            $stmt->bindValue(':description', $description);

            // Exécution de la requête SQL préparée
            $stmt->execute();

            // Affichage d'un message de réussite si l'insertion s'est déroulée avec succès
            echo "Enregistrement réussi !";
        } catch (PDOException $e) {
            // Affichage d'un message d'erreur en cas d'échec de l'insertion
            echo "Un problème est survenu";
        }
    }

    public function getAllProduit(): array
    {
        $produit = [];

        try {
            // Préparation de la requête SQL pour récupérer toutes les personnes
            $statement = $this->connexion->prepare("SELECT * FROM produit ;");
            // Exécution de la requête SQL
            $statement->execute();
            // Récupération des résultats sous forme de tableau associatif
            $resultat = $statement->fetchAll(PDO::FETCH_ASSOC);
            // Si des résultats sont trouvés
            if (count($resultat) > 0) {
                // Parcours des résultats pour créer des objets Person
                foreach ($resultat as $row) {
                    // Création d'un nouvel objet Person avec les données récupérées
                    $produit[] = new Produit(
                        $row['name'],
                        $row['noProduit'],
                        $row['id'],
                        $row['prix'],
                        $row['description']
                    );
                }
            }
        }
        // Gestion des exceptions PDO
        catch (PDOException $e) {
            // Affichage du message d'erreur en cas d'échec
            echo "Erreur : " . $e->getMessage();
        }

        // Retourne le tableau des personnes récupérées depuis la base de données
        return $produit;
    }

    public function getProduitByName(string $name): array
    {
        $result = []; // Initialisation de la variable résultat à un tableau vide

        try {
            // Préparation de la requête SQL pour récupérer une personne par son ID
            $query = "SELECT * FROM produit WHERE name LIKE :name";

            // Préparation de la requête SQL
            $stmt = $this->connexion->prepare($query);

            // Liaison de la valeur de $id avec le paramètre :id de la requête SQL préparée
            $stmt->bindValue(':name','%' . $name . '%');

            // Exécution de la requête SQL préparée
            $stmt->execute();

            // Récupération du résultat de la requête sous forme de tableau associatif
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Gestion des exceptions PDO : affichage du message d'erreur
            echo $e->getMessage();
        }

        // Retourne le résultat (peut être un tableau associatif contenant les données de la personne ou null si aucune personne correspondante n'a été trouvée)
        return $result;
    }

    public function ProduitByPriceIN($minPrix, $maxPrix): array
    {
        $result = []; // Initialisation de la variable résultat à un tableau vide

        try {
            // Préparation de la requête SQL pour récupérer une personne par son ID
            $query = "SELECT * FROM `produit` WHERE prix IN BETWEEN minPrix and maxPrix;";

            // Préparation de la requête SQL
            $stmt = $this->connexion->prepare($query);

            // Liaison de la valeur de $id avec le paramètre :id de la requête SQL préparée
            $stmt->bindValue(':minPrix', $minPrix);
            $stmt->bindValue(':maxPrix', $maxPrix);

            // Exécution de la requête SQL préparée
            $stmt->execute();

            // Récupération du résultat de la requête sous forme de tableau associatif
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Gestion des exceptions PDO : affichage du message d'erreur
            echo $e->getMessage();
        }

        // Retourne le résultat (peut être un tableau associatif contenant les données de la personne ou null si aucune personne correspondante n'a été trouvée)
        return $result;
    }

    public function updateProduit($id, $name, $noProduit, $prix, $description)
    {
        try {
            // Requête SQL pour mettre à jour les informations d'une personne avec un ID donné
            $query  = "UPDATE persons SET name = :name , noProduit = :noProduit , prix = :prix , description = :description WHERE id = :id ;";

            // Préparation de la requête SQL
            $stmt = $this->connexion->prepare($query);

            // Liaison des valeurs des paramètres de la requête SQL préparée
            $stmt->bindValue(":id", $id);
            $stmt->bindValue(':name', $name);
            $stmt->bindValue(':noProduit', $noProduit);
            $stmt->bindValue(':prix', $prix);
            $stmt->bindValue(':description', $description);

            // Exécution de la requête SQL préparée
            $stmt->execute();
        } catch (PDOException $PDOException) {
            // Gestion des exceptions PDO : affichage du message d'erreur
            echo $PDOException->getMessage();
        }
    }

    public function getPersonById(int $id): array
    {
        $result = []; // Initialisation de la variable résultat à un tableau vide

        try {
            // Préparation de la requête SQL pour récupérer une personne par son ID
            $query = "SELECT * FROM produit WHERE id = :id";

            // Préparation de la requête SQL
            $stmt = $this->connexion->prepare($query);

            // Liaison de la valeur de $id avec le paramètre :id de la requête SQL préparée
            $stmt->bindValue(':id', $id);

            // Exécution de la requête SQL préparée
            $stmt->execute();

            // Récupération du résultat de la requête sous forme de tableau associatif
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Gestion des exceptions PDO : affichage du message d'erreur
            echo $e->getMessage();
        }

        // Retourne le résultat (peut être un tableau associatif contenant les données de la personne ou null si aucune personne correspondante n'a été trouvée)
        return $result;
    }

    public function deleteProduit(int $id): bool
    {
        try {
            // Requête SQL pour supprimer une personne avec un ID donné
            $query = "DELETE FROM persons WHERE id = :id";

            // Préparation de la requête SQL
            $stmt = $this->connexion->prepare($query);

            // Liaison de la valeur de $id avec le paramètre :id de la requête SQL préparée
            $stmt->bindValue(":id", $id);

            // Exécution de la requête SQL préparée
            $stmt->execute();

            // Retourne vrai si la suppression est réussie
            return true;
        } catch (PDOException $e) {
            // Affichage du message d'erreur en cas d'échec de la suppression
            echo $e->getMessage();
        }

        // Retourne faux si la suppression échoue
        return false;
    }

}