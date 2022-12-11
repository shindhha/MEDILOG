<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/monStyle.css">
    <title>Recherche</title>
</head>
<body class="container largeur100">
    <div class="text-center entete border-1 largeur100">


        <a href="index.php"><img src="images/medicaments2.jpg" alt="Médicament" class="logo"></a>

        <h1>APPLICATION<br/>MEDILOG</h1>

        <h2>-- Recherche d'un médicament --</h2>
    </div>
    <?php
    spl_autoload_extensions(".php");
    spl_autoload_register();
    use yasmf\HttpHelper;
    

    $conditionLab = isset($_POST['lab']) && $_POST['lab'] != "TOUS";
    $conditionMedic = isset($_POST['typeMedic']) && $_POST['typeMedic'] != "TOUS";
    $conditionDesign = isset($_POST['Designation']);

    
    ?>

    
    <div class="largeur100 text-center col">
        <h1>Recherche</h1><br><br>
        <form  method="post" action="" >
            <span>Désignation a rechercher :</span>

            <input type="text" class="form-control" name="Designation" value="<?php if (isset($_POST['Designation'])) { echo $_POST['Designation']; } ?>" placeholder="Taper un mot a rechercher">

            <br/>
            <span>Type de médicament :</span>
            <select name='typeMedic' class="form-control">
                <option>TOUS</option>
                <?php
                while($row = $tabTypes->fetch()) {
                    if (isset($_POST['typeMedic']) && $_POST['typeMedic'] == $row['Type']) {
                        echo "<option selected='selected'>" . $row['Type'] . "</option>";
                    } else {
                        echo "<option>" . $row['Type'] . "</option>";
                    }

                }
                ?>
            </select>
            <br/>
            <span>Laboratoire :</span>
            <select name='lab' class="form-control">
                <option>TOUS</option>
                <?php

                while($row = $tabLab->fetch()) {
                    if (isset($_POST['lab']) && $_POST['lab'] == $row['Labo']) {
                        echo "<option selected='selected'>" . $row['Labo'] . "</option>";
                    } else {
                        echo "<option>" . $row['Labo'] . "</option>";
                    }
                }
                ?>
            </select>
            <br/>
            <button type="submit">Envoyer</button>
        </form>
    </div>
    <table class="table table-striped contenu">

        <?php

        foreach($tab as $i) {

            echo "<tr>" 
            . "<td>" . $i['designation'] . "</td>"
            . "<td>" . $i['type'] . "</td>"
            . "<td>" . $i['labo'] . "</td>"
            ."</tr>";
        } 
        ?>
    </table>

    <table class="bottom largeur100">
        <td class="menu" colspan="2">
            <span>Menu :</span>
            <a href="index.php">Acceuil</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="index.php?action=searchPage">Recherche d'un médicament</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="index.php?action=ordoPage">Création d'ordonnance</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </td>
        <td class="iut">
            <span>Réaliser par</span><br>
            <a href="https://www.iut-rodez.fr/fr" target="_blank"><img src="images/LogoIut.png" alt="LogoIut" class="logoIut"></a>
        </td>
    </table>          
</table>
</table>
</body>
</html>