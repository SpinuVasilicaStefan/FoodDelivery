<!DOCTYPE html>

<?php
    if(isset($_POST['logout']))
    {
        session_start();
        inserare_livrare();
        
        
        $_SESSION['comanda_noua'] = true;
        $_SESSION['comanda'] ++;
        header("Location: Principala.php");
    }

function inserare_livrare()
{
     $conn = oci_connect('STUDENT', 'STUDENT', 'localhost/XE');
     $interogare = oci_parse($conn, "SELECT MAX(id_comanda) AS id FROM comanda");
     oci_execute($interogare);
     $result = oci_fetch_assoc($interogare);
     $id = $result['ID'];
     $_SESSION['comanda'] = $id;
    
        //reducere
        $alias = "numar";
        $sql = oci_parse($conn, "select f_fluctuatie_comanda('".$_SESSION['id_client']."') as ".$alias."  from dual");
        oci_execute($sql);
        $res = oci_fetch_assoc($sql);
        $coef = $res['NUMAR'];

        if($coef<5)
            $ins = oci_parse($conn, "INSERT INTO livrari VALUES (".$id.", ".$_SESSION['id_client'].", '10', SYSDATE)");
        else if($coef<10)
            $ins = oci_parse($conn, "INSERT INTO livrari VALUES (".$id.", ".$_SESSION['id_client'].", '5', SYSDATE)");
        else if($coef<20)
            $ins = oci_parse($conn, "INSERT INTO livrari VALUES (".$id.", ".$_SESSION['id_client'].", '2', SYSDATE)");
        else
            $ins = oci_parse($conn, "INSERT INTO livrari VALUES (".$id.", ".$_SESSION['id_client'].", '0', SYSDATE)");
     oci_execute($ins);
}

function afisare()
{
    session_start();
        
    $conn = oci_connect('STUDENT', 'STUDENT', 'localhost/XE');
    $nume = "nume";
    $pret = "pret";
    if(isset($_SESSION['comanda']))
        $comanda = $_SESSION['comanda'];
    else
        $comanda = 0;
    
    $sql = oci_parse($conn, "select nume, pret from produse p
    JOIN combinari cb ON cb.id_produs=p.id_produs
    JOIN comanda c ON c.id_combinari=cb.id_combinari
    where cb.id_produs=p.id_produs and c.id_comanda='$comanda'");
            
    oci_execute($sql);
        
    while (($row = oci_fetch_array($sql, OCI_BOTH)) != false) {
        echo '<a href=""><div class="item">
        <p class="prima">'.$row['NUME'].' <br>Pret: '.$row['PRET'].'</p>';
        $aux = 1;
    }
}

?>

<html lang="en" >
<head>
    <meta charset="utf-8" />
    <title>FII Caffe</title>
    <meta name="description" content="Restaurante cu specific italian">
    <link rel="stylesheet" href="stilcont.css">
    </head>
    
<body>
     <ul>
      <li class="stanga"><a href="Principala.php" class="active">Acasa</a></li>
      <li class="stanga"><a href="Meniu.php" class="active">Meniu</a></li>
      <li class="stanga"><a href="DespreNoi.php" class="active">Despre noi</a></li>
      <li class="stanga"><a href="Statistici.php" class="active">Statistici</a></li>
      <li class="stanga"><a href="Destinatie.php" class="active">Traseu curier</a></li>
      <li class="stanga"><a href="Livrari.php" class="active">Livrari</a></li>
      <li class="stanga"><a href="BestDeal.php" class="active">Best deal</a></li>
      <li class="dreapta"><a href="ProfitAnual.php" class="active">Profituri</a></li>
      <li class="dreapta"><a href=<?php 
                             
                             if(isset($_SESSION['log']) and $_SESSION['log'] === true)
                                 echo "cont.php";
                             else echo "Logare.php";
                             ?>
                             class="active">Contul meu</a></li>
      <li class="dreapta"><a href="cos.php" class="active">Cos</a></li>
    </ul>
    
    <div class="cont">
        <?php afisare(); ?>
        
        
        <form action="cos.php" method="post">
            <input type="submit" name="logout" value="Realizeaza comanda">
        </form>
    </div>
    
    
    <footer>
         <p> © Spînu Vasilică Ștefan, Muntean Cătălin-Tudor, 2019 </p>
    </footer>
    
</body>
</html>