<?php
require "connexion.php";
if (isset($_GET['ids'])) {
    $bd->query('delete from utilisateur where id=' . $_GET['ids']);
    header('Location: utulisateur_list.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste utilisateur</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<?php include("head.php"); ?>
    <table border="1">
        <tr>
            <th>N°</th>
            <th>Nom</th>
            <th>Login</th>
            <th>Action</th>
        </tr>
        <?php
        $req = $bd->query("SELECT * FROM utilisateur");
        $i = 1;
        while ($ligne = $req->fetch()) {
            echo "<tr>";
            echo '<td>' . $i . '</td>';
            echo '<td>' . $ligne['nom'] . '</td>';
            echo '<td>' . $ligne['login'] . '</td>';
            echo '<td> 
            <a href="utilisateur_form.php?idm=' . $ligne['id'] . '">Editer </a>
            <a href="utulisateur_list.php?ids=' . $ligne['id'] . '">Supprimer </a>
            </td>';
            $i++;
            echo "</tr>";
        }


        ?>

    </table>
    <?php include("foot.php"); ?>
</body>

</html>