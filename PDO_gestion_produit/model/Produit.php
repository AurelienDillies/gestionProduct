<?php
class Produit
{
    private string $name;
    private string $noProduit;
    private int $id;
    private int $prix;
    private string $description;

    public function __construct(string $name, string $noProduit, int $id, int $prix, string $description)
    {
        $this->name = $name;
        $this->noProduit = $noProduit;
        $this->id = $id;
        $this->prix = $prix;
        $this->description = $description;
    }


    /**
     * Get the value of name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of noProduit
     *
     * @return string
     */
    public function getNoProduit(): string
    {
        return $this->noProduit;
    }

    /**
     * Set the value of noProduit
     *
     * @param string $noProduit
     *
     * @return self
     */
    public function setNoProduit(string $noProduit): self
    {
        $this->noProduit = $noProduit;

        return $this;
    }

    /**
     * Get the value of id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param int $id
     *
     * @return self
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of prix
     *
     * @return int
     */
    public function getPrix(): int
    {
        return $this->prix;
    }

    /**
     * Set the value of prix
     *
     * @param int $prix
     *
     * @return self
     */
    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get the value of description
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @param string $description
     *
     * @return self
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
    public function __toString()
    {
        return "<br> Nom : " . $this->name .
            "<br> Numéro produit : " . $this->noProduit .
            "<br> Prix : " . $this->prix .
            "<br> Description : " . $this->description .
            "<br> ID : " . $this->id . "<br>";
    }
}