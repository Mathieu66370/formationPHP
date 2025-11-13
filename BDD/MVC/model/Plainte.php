<?php
require_once "Database.php";

class Plainte
{
    private $bdd;

    public function __construct(Database $bdd)
    {
        $this->bdd = $bdd;
    }

    // Récupérer toutes les plaintes
    public function getAllPlaintes(): array
    {
        $sql = "SELECT p.*, u.nom AS nom_utilisateur
                FROM plainte p
                LEFT JOIN utilisateurs u ON p.utilisateur_id = u.id
                ORDER BY p.date_plainte DESC";
        $query = $this->bdd->getBdd()->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer une seule plainte par ID
    public function showOnePlainte(int $id): ?array
    {
        $sql = "SELECT * FROM plainte WHERE id = :id";
        $query = $this->bdd->getBdd()->prepare($sql);
        $query->execute([':id' => $id]);
        return $query->fetch(PDO::FETCH_ASSOC) ?: null;
    }
}
