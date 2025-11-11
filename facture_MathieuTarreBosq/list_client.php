<?php include("configDB.php"); ?>

<div style="text-align:center; margin-bottom:20px;">
    <a href="add_client.php"><button style="background-color:#4CAF50;color:white;padding:8px 12px;border-radius:8px;border:2px solid #4CAF50;margin:3px;">Ajouter un client</button></a>
    <a href="list_client.php"><button style="background-color:#2196F3;color:white;padding:8px 12px;border-radius:8px;border:2px solid #2196F3;margin:3px;">Liste des clients</button></a>
    <a href="add_facture.php"><button style="background-color:#FF9800;color:white;padding:8px 12px;border-radius:8px;border:2px solid #FF9800;margin:3px;">Ajouter une facture</button></a>
    <a href="list_facture.php"><button style="background-color:#f44336;color:white;padding:8px 12px;border-radius:8px;border:2px solid #f44336;margin:3px;">Liste des factures</button></a>
</div>

<h2 style="text-align:center;">Liste des clients :</h2>

<?php
$result = $bdd->query("SELECT * FROM clients");

if ($result->rowCount() > 0) {
    echo "<table style='border-collapse:collapse;margin:auto;width:90%;border:2px solid #ccc;'>";
    echo "<tr style='background-color:#f2f2f2;text-align:center;'>
            <th style='border:1px solid #ccc;padding:8px;'>ID</th>
            <th style='border:1px solid #ccc;padding:8px;'>Nom</th>
            <th style='border:1px solid #ccc;padding:8px;'>Prénom</th>
            <th style='border:1px solid #ccc;padding:8px;'>Sexe</th>
            <th style='border:1px solid #ccc;padding:8px;'>Date de naissance</th>
          </tr>";
    while ($row = $result->fetch()) {
        echo "<tr style='text-align:center;'>
                <td style='border:1px solid #ccc;padding:5px;'>{$row['id_client']}</td>
                <td style='border:1px solid #ccc;padding:5px;'>{$row['nom']}</td>
                <td style='border:1px solid #ccc;padding:5px;'>{$row['prenom']}</td>
                <td style='border:1px solid #ccc;padding:5px;'>{$row['sexe']}</td>
                <td style='border:1px solid #ccc;padding:5px;'>{$row['date_naissance']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p style='text-align:center;'>Aucun client trouvé dans la base de données.</p>";
}
?>
