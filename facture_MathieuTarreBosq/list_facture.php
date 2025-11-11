<?php include("configDB.php"); ?>

<div style="text-align:center; margin-bottom:20px;">
    <a href="add_client.php"><button style="background-color:#4CAF50;color:white;padding:8px 12px;border-radius:8px;border:2px solid #4CAF50;margin:3px;">Ajouter un client</button></a>
    <a href="list_client.php"><button style="background-color:#2196F3;color:white;padding:8px 12px;border-radius:8px;border:2px solid #2196F3;margin:3px;">Liste des clients</button></a>
    <a href="add_facture.php"><button style="background-color:#FF9800;color:white;padding:8px 12px;border-radius:8px;border:2px solid #FF9800;margin:3px;">Ajouter une facture</button></a>
    <a href="list_facture.php"><button style="background-color:#f44336;color:white;padding:8px 12px;border-radius:8px;border:2px solid #f44336;margin:3px;">Liste des factures</button></a>
</div>

<h2 style="text-align:center;">Liste des factures :</h2>

<form method="get" style="text-align:center;margin-bottom:15px;">
    Du : <input type="date" name="date_debut">
    Au : <input type="date" name="date_fin">
    Client :
    <select name="client">
        <option value="">Tous</option>
        <?php
        $clients = $bdd->query("SELECT * FROM clients");
        while ($c = $clients->fetch()) {
            echo "<option value='{$c['id_client']}'>{$c['nom']} {$c['prenom']}</option>";
        }
        ?>
    </select>
    <input type="submit" value="Rechercher" style="padding:5px 10px;">
</form>

<?php
$where = [];
$params = [];

if (!empty($_GET['client'])) {
    $where[] = "f.id_client = ?";
    $params[] = $_GET['client'];
}
if (!empty($_GET['date_debut'])) {
    $where[] = "f.date_emission >= ?";
    $params[] = $_GET['date_debut'];
}
if (!empty($_GET['date_fin'])) {
    $where[] = "f.date_emission <= ?";
    $params[] = $_GET['date_fin'];
}

$sql = "SELECT f.*, c.nom, c.prenom FROM factures f JOIN clients c ON f.id_client=c.id_client";
if ($where) $sql .= " WHERE " . implode(" AND ", $where);

$stmt = $bdd->prepare($sql);
$stmt->execute($params);

if ($stmt->rowCount() > 0) {
    echo "<table style='border-collapse:collapse;margin:auto;width:90%;border:2px solid #ccc;'>";
    echo "<tr style='background-color:#f2f2f2;text-align:center;'>
            <th style='border:1px solid #ccc;padding:8px;'>ID</th>
            <th style='border:1px solid #ccc;padding:8px;'>Client</th>
            <th style='border:1px solid #ccc;padding:8px;'>Montant (EUR)</th>
            <th style='border:1px solid #ccc;padding:8px;'>Produits</th>
            <th style='border:1px solid #ccc;padding:8px;'>Quantité</th>
            <th style='border:1px solid #ccc;padding:8px;'>Date d'émission</th>
            <th style='border:1px solid #ccc;padding:8px;'>Actions</th>
          </tr>";
    while ($row = $stmt->fetch()) {
        echo "<tr style='text-align:center;'>
                <td style='border:1px solid #ccc;padding:5px;'>{$row['id_facture']}</td>
                <td style='border:1px solid #ccc;padding:5px;'>{$row['nom']} {$row['prenom']}</td>
                <td style='border:1px solid #ccc;padding:5px;'>{$row['montant']}</td>
                <td style='border:1px solid #ccc;padding:5px;'>{$row['produits']}</td>
                <td style='border:1px solid #ccc;padding:5px;'>{$row['quantite']}</td>
                <td style='border:1px solid #ccc;padding:5px;'>{$row['date_emission']}</td>
                <td style='border:1px solid #ccc;padding:5px;'>
                    <a href='edit_facture.php?id={$row['id_facture']}'><button style='background-color:#FF9800;color:white;padding:5px;border:none;border-radius:5px;'>Modifier</button></a>
                    <a href='delete_facture.php?id={$row['id_facture']}'><button style='background-color:#f44336;color:white;padding:5px;border:none;border-radius:5px;'>Supprimer</button></a>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p style='text-align:center;'>Aucune facture trouvée dans la base de données.</p>";
}
?>
