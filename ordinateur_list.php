<?php require 'connexion.php';

// SUPPRESSION
if (isset($_GET['ids'])) {
    $bd->query('delete from ordinateur where idord=' . $_GET['ids']);
    header('Location: ordinateur_list.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ordinateur Liste</title>
</head>

<body>
    <table border="1">
        <tr>
            <th>N°</th>
            <th>Marque</th>
            <th>Couleur</th>
            <th>Ram</th>
            <th>Disque</th>
            <th>Etudiant</th>
            <th>Action</th>
        </tr>

        <?php
        $req = $bd->query('SELECT * FROM ordinateur join etudiant on ordinateur.ide=etudiant.ide');
        $i = 1;
        while ($ligne = $req->fetch()) {
            echo '<tr>';
            echo '<td>' . $i . '</td>';
            echo '<td>' . $ligne['marque'] . '</td>';
            echo '<td>' . $ligne['couleur'] . '</td>';
            echo '<td>' . $ligne['ram'] . '</td>';
            echo '<td>' . $ligne['disque'] . '</td>';
            echo '<td>' . $ligne['nom'] . '</td>';
            echo '<td>
                    <a href="ordinateur_form.php?idm=' . $ligne['idord'] . '">Editer</a>
                    <a href="ordinateur_list.php?ids=' . $ligne['idord'] . '">Supprimer</a>
                </td>';
            $i++;
            echo '</tr>';
        }
        ?>

    </table>
</body>

</html>