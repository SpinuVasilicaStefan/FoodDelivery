<?php  
    session_start();
    function afisareTraseu(){
        $conn = oci_connect('STUDENT', 'STUDENT', 'localhost/XE'); 
        $sql = oci_parse($conn, "select * from livrari where id_client = '".$_SESSION['id_client']."'");
        oci_execute($sql);
        while (($row = oci_fetch_array($sql, OCI_BOTH)) != false) {
            echo "<ol class = 'titlu'>Id livrare : #".$row['ID_LIVRARE']." <br> Data : ".$row['DATA_LIVRARE']."</ol>";
            $sql1 = oci_parse($conn, 'select p.nume as numE, c.pret as pret, r.nume as restaurant from produse p
                join combinari c on c.id_produs = p.id_produs
                join restaurant r on r.id_restaurant = c.id_restaurant
                join comanda d on d.id_combinari = c.id_combinari and d.id_comanda = '.$row['ID_LIVRARE']."");
            oci_execute($sql1);
            $total = 0;
            while (($row1 = oci_fetch_array($sql1, OCI_BOTH)) != false) {
                $total = $total + $row1['PRET'];
                echo "<li class = 'element' >".$row1['NUME']." (".$row1['RESTAURANT'].")............".$row1['PRET']."</li>";

            }
            echo "<p class = 'pret' >TOTAL : ".$total."</p>";
        }
    
    }
?>
<html lang="en" >
<head>
    <meta charset="utf-8" />
    <title>FII Caffe</title>
    <meta name="description" content="Restaurante cu specific italian">
    <link rel="stylesheet" href="StyleComanda.css">
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
        <?php afisareTraseu(); ?>
    </div>

    
    <footer>
         <p> © Spînu Vasilică Ștefan, Muntean Cătălin-Tudor, 2019 </p>
    </footer>
    
</body>
</html>
