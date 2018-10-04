<?php

/* Connect to a MySQL database using driver invocation */
$dsn = 'mysql:host=localhost;port=8889;dbname=academia_meetup';
$user = 'academia_meetup';
$password = 'Hackers!@#@meetup';

try {
    $dbh = new PDO($dsn, $user, $password);
    if($_POST['post'] == 1) {
        $sql = 'SELECT `cantitate` FROM cantitate_produse WHERE `categorie` = '.$_POST["categorie"].' AND `produs` = '.$_POST["produs"];
        foreach ($dbh->query($sql) as $row) {
            echo $row['cantitate'] . "\t";

        }
    }
    if($_POST['post'] == 2) {
        $sql = 'SELECT `numar_comenzi` FROM comenzi WHERE `id` = 1';
        foreach ($dbh->query($sql) as $row) {
            $nr = $row['numar_comenzi'] + 1;
            $arr;
            if ($nr % 4 == 0) {
                $arr = array('success' => false);
                $sqlMassUpdate = 'UPDATE cantitate_produse SET `cantitate`= 10';
                $dbh->query($sqlMassUpdate);
                $sqlUpdate = 'UPDATE comenzi SET `numar_comenzi`= '.$nr.' WHERE `id` = 1';
                $dbh->query($sqlUpdate);
            } else {
                foreach ( $_POST['produse'] as $produs) {
                    $sqlCantitate = 'SELECT `cantitate` FROM cantitate_produse WHERE `categorie` = '.$produs['categorie'].' AND `produs` = '.$produs['produs'];
                    $cantitate;
                    foreach ($dbh->query($sqlCantitate) as $row) {
                        $cantitate = $row['cantitate'] - $produs['cantitate'];
                    }
                    $sqlUpdate2 = 'UPDATE cantitate_produse SET `cantitate`= '.$cantitate.' WHERE `categorie` = '.$produs['categorie']. ' AND `produs` = '.$produs['produs'];
                    $dbh->query($sqlUpdate2);
                }
                $sqlUpdate = 'UPDATE comenzi SET `numar_comenzi`= '.$nr.' WHERE `id` = 1';
                $dbh->query($sqlUpdate);
                $arr = array('success' => true);
            }

            echo json_encode($arr);

        }

    }
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}


?>