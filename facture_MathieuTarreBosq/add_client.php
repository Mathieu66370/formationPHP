<?php include("configDB.php"); ?>

<div style="text-align:center; margin-bottom:20px;">
    <a href="add_client.php"><button style="background-color:#4CAF50;color:white;padding:8px 12px;border-radius:8px;border:2px solid #4caf50;margin:3px;">Ajouter un client</button></a>
    <a href="list_client.php"><button style="background-color:#2196F3;color:white;padding:8px 12px;border-radius:8px;border:2px solid #2196f3;margin:3px;">Liste des clients</button></a>
    <a href="add_facture.php"><button style="background-color:#FF9800;color:white;padding:8px 12px;border-radius:8px;border:2px solid #FF9800;margin:3px;">Ajouter une facture</button></a>
    <a href="list_facture.php"><button style="background-color:#f44336;color:white;padding:8px 12px;border-radius:8px;border:2px solid #f44336;margin:3px;">Liste des factures</button></a>
</div>

<h2 style="text-align:center;">Ajouter un client :</h2>

<form method="post" style="max-width:400px;margin:auto;padding:15px;border:2px solid #ccc;border-radius:10px;background-color:#f9f9f9;">
    Nom : <input type="text" name="nom" required style="width:100%;padding:5px;margin:5px 0;"><br>
    Prénom : <input type="text" name="prenom" required style="width:100%;padding:5px;margin:5px 0;"><br>
    Sexe :
    <select name="sexe" required style="width:100%;padding:5px;margin:5px 0;">
        <option value="H">Homme</option>
        <option value="F">Femme</option>
    </select><br>
    Date de naissance : <input type="date" name="date_naissance" required style="width:100%;padding:5px;margin:5px 0;"><br>
    <input type="submit" name="ajouter" value="Enregistrer" style="background-color:#4CAF50;color:white;padding:8px 12px;border:none;border-radius:8px;cursor:pointer;">
</form>

<?php
if (isset($_POST['ajouter'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $sexe = $_POST['sexe'];
    $date_naissance = $_POST['date_naissance'];

    $sql = "INSERT INTO clients (nom, prenom, sexe, date_naissance) VALUES (?, ?, ?, ?)";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([$nom, $prenom, $sexe, $date_naissance]);

    echo "<p style='text-align:center;color:green;'>Client ajouté avec succès.</p>";
}
?>
