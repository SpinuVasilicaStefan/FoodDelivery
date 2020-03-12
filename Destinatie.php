<?php  
    session_start();
    function verificare(){
        $conn = oci_connect('STUDENT', 'STUDENT', 'localhost/XE'); 
        $tag = "Imagine";
        $alt = "Img";
        $alias = "numar";
        $sql = oci_parse($conn, "select count(*) as ".$alias."  from clienti c 
        join livrari l on l.id_client = c.id_client and l.data_livrare >= systimestamp - INTERVAL '0 01:00:00.0' DAY TO SECOND  and c.nume_utilizator =  '".$_SESSION['nume_utilizator']."'");
        oci_execute($sql);
        while (($row = oci_fetch_array($sql, OCI_BOTH)) != false) {
            if ($row['NUMAR'] > 0)
                afisareTraseu();
            else
                echo 'Nu aveti nici o comanda in curs de livrare';
        }
    }
    function afisareTraseu(){
        $conn = oci_connect('STUDENT', 'STUDENT', 'localhost/XE'); 
        $tag = "Imagine";
        $alt = "Img";
        $alias = "numar";
        $sql = oci_parse($conn, "select f_livrari('traseu','".$_SESSION['oras']."',systimestamp - INTERVAL '0 01:00:00.0' DAY TO SECOND, systimestamp) as ".$alias."  from dual");
        oci_execute($sql);
        while (($row = oci_fetch_array($sql, OCI_BOTH)) != false) {
            echo $row['NUMAR'];
            $sql1 = oci_parse($conn, "select f_livrari('profit','".$_SESSION['oras']."',systimestamp - INTERVAL '0 01:00:00.0' DAY TO SECOND, systimestamp) as ".$alias."  from dual");
            oci_execute($sql1);
            while (($row1 = oci_fetch_array($sql, OCI_BOTH)) != false) {
                echo $row1['NUMAR'];
            }
        }
    
    }
?>
<html lang="en" >
<head>
    <meta charset="utf-8" />
    <title>FII Caffe</title>
    <meta name="description" content="Restaurante cu specific italian">
    <link rel="stylesheet" href="StyleDestinatie.css">
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
      <li class="dreapta"><a href="" class="active">Cont</a></li>
      <li class="dreapta"><a href="cos.php" class="active">Cos</a></li>
    </ul>
    
    <div class = "panou" align = "center">
        <p class = "titlu"><?php verificare(); ?></p>
    </div>

    
    <footer>
         <p> © Spînu Vasilică Ștefan, Muntean Cătălin-Tudor, 2019 </p>
    </footer>
    
</body>
</html>
