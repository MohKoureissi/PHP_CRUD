<?php
require 'connexion.php';
if (isset($_POST['enregistrer'])) {
    if (isset($_POST['marque'], $_POST['couleur'], $_POST['ram'], $_POST['disque'], $_POST['ide']));
    $req = $bd->prepare('insert into ordinateur(marque,couleur,ram,disque,ide) values(?,?,?,?,?)');
    $req->bindValue(1, $_POST['marque']);
    $req->bindValue(2, $_POST['couleur']);
    $req->bindValue(3, $_POST['ram']);
    $req->bindValue(4, $_POST['disque']);
    $req->bindValue(5, $_POST['ide']);
    $req->execute();
    header('Location: ordinateur_list.php');
}

//EDITION
if (isset($_GET['idm'])) {
    $req = $bd->query('SELECT * FROM ordinateur where idord=' . $_GET['idm']);
    if ($ligne = $req->fetch()) {
        $_POST['idord'] = $ligne['idord'];
        $_POST['marque'] = $ligne['marque'];
        $_POST['couleur'] = $ligne['couleur'];
        $_POST['ram'] = $ligne['ram'];
        $_POST['disque'] = $ligne['disque'];
        $_POST['ide'] = $ligne['ide'];
        echo $_POST['ide'];
    }
}

//MODIFICATION
if (isset($_POST['modifier'])) {
    if (isset($_POST['marque'], $_POST['couleur'], $_POST['ram'], $_POST['disque'], $_POST['ide']));
    $req = $bd->prepare('update ordinateur set marque=?, couleur=?, ram=?, disque=?, ide=? where idord=?');
    $req->bindValue(1, $_POST['marque']);
    $req->bindValue(2, $_POST['couleur']);
    $req->bindValue(3, $_POST['ram']);
    $req->bindValue(4, $_POST['disque']);
    $req->bindValue(5, $_POST['ide']);
    $req->bindValue(6, $_POST['idord']);
    $req->execute();
    header('Location: ordinateur_list.php');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ordinateur form</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<?php include("head.php"); ?>
    <fieldset>
        <legend>Ordinateur</legend>
        <form action="ordinateur_form.php" method="post">
            <div>
                <label for="">Marque:</label>
                <input type="text" name="marque" value="<?php if (isset($_POST['marque'])) echo $_POST['marque'] ?>">
            </div>
            <div>
                <label for="">Couleur:</label>
                <input type="text" name="couleur" value="<?php if (isset($_POST['couleur'])) echo $_POST['couleur'] ?>">
            </div>
            <div>
                <label for="">Ram:</label>
                <input type="text" name="ram" value="<?php if (isset($_POST['ram'])) echo $_POST['ram'] ?>">
            </div>
            <div>
                <label for="">Disque:</label>
                <input type="text" name="disque" value="<?php if (isset($_POST['disque'])) echo $_POST['disque'] ?>">
            </div>
            </div>
            <div>
                <label for="">Etudiant:</label>
                <select name="ide" id="">
                    <option></option>
                    <?php
                     $req = $bd->query('SELECT * FROM etudiant');
                     
                     while($ligne=$req->fetch()){
                    if(isset($_POST['ide'])&& $ligne['ide']==$_POST['ide']){
                        echo '<option value="'.$ligne['ide'].'" selected>'.$ligne['nom'].
                        ' '.$ligne['prenom'].'</option>';
                    }
                    else{
                        echo '<option value="'.$ligne['ide'].'">'.$ligne['nom'].
                    ' '.$ligne['prenom'].'</option>';
                    }
                    
                }
                    ?>
                </select>
            </div>
            <?php if (isset($_GET['idm'])) { ?>
                <div>
                    <label for="">&nbsp;</label>
                    <input type="hidden" name="idord" value="<?php if (isset($_POST['idord'])) echo $_POST['idord'] ?>">

                    <input type="submit" value="Modifier" name="modifier">
                </div>
            <?php } else { ?>
                <div>
                    <label for="">&nbsp;</label>
                    <input type="submit" value="Enregistrer" name="enregistrer">
                </div>
            <?php } ?>
        </form>
    </fieldset>
    <?php include("foot.php"); ?>
</body>

</html>