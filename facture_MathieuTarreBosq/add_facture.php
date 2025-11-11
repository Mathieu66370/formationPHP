<?php include("configDB.php"); ?>

<div style="text-align:center; margin-bottom:20px;">
    <a href="add_client.php"><button style="background-color:#4CAF50;color:white;padding:8px 12px;border-radius:8px;border:2px solid #4CAF50;margin:3px;">Ajouter un client</button></a>
    <a href="list_client.php"><button style="background-color:#2196F3;color:white;padding:8px 12px;border-radius:8px;border:2px solid #2196F3;margin:3px;">Liste des clients</button></a>
    <a href="add_facture.php"><button style="background-color:#FF9800;color:white;padding:8px 12px;border-radius:8px;border:2px solid #FF9800;margin:3px;">Ajouter une facture</button></a>
    <a href="list_facture.php"><button style="background-color:#f44336;color:white;padding:8px 12px;border-radius:8px;border:2px solid #f44336;margin:3px;">Liste des factures</button></a>
</div>

<h2 style="text-align:center;">Ajouter une facture :</h2>

<form method="post" style="max-width:450px;margin:auto;padding:15px;border:2px solid #ccc;border-radius:10px;background-color:#f9f9f9;">
    Client :
    <select name="id_client" required style="width:100%;padding:5px;margin:5px 0;">
        <option value="">-- Sélectionner --</option>
        <?php
        $clients = $bdd->query("SELECT * FROM clients");
        while ($c = $clients->fetch()) {
            echo "<option value='{$c['id_client']}'>{$c['nom']} {$c['prenom']}</option>";
        }
        ?>
    </select><br>
    Montant : <input type="number" step="0.01" name="montant" required style="width:100%;padding:5px;margin:5px 0;"><br>
    Produits : <textarea name="produits" required style="width:100%;padding:5px;margin:5px 0;"></textarea><br>
    Quantité : <input type="number" name="quantite" required style="width:100%;padding:5px;margin:5px 0;"><br>
    Date d'émission : <input type="date" name="date_emission" value="<?= date('Y-m-d') ?>" required style="width:100%;padding:5px;margin:5px 0;"><br>
    <input type="submit" name="ajouter" value="Enregistrer" style="background-color:#FF9800;color:white;padding:8px 12px;border:none;border-radius:8px;cursor:pointer;">
</form>

<?php
if (isset($_POST['ajouter'])) {
    $id_client = $_POST['id_client'];
    $montant = $_POST['montant'];
    $produits = $_POST['produits'];
    $quantite = $_POST['quantite'];
    $date_emission = $_POST['date_emission'];

    $sql = "INSERT INTO factures (id_client, montant, produits, quantite, date_emission) VALUES (?, ?, ?, ?, ?)";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([$id_client, $montant, $produits, $quantite, $date_emission]);

    echo "<p style='text-align:center;color:green;'> Facture ajoutée avec succès.</p>";
}
?>
