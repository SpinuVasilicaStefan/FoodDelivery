<?php  
    session_start();
    function afisareTraseu(){
        $conn = oci_connect('STUDENT', 'STUDENT', 'localhost/XE'); 
        $sql = oci_parse($conn, "select p.nume as nume from produse p ORDER BY 1 asc");
        oci_execute($sql);
        echo "<ol class = 'titlu'>Best Deal in orasul duneavoastra</ol>";
        while (($row = oci_fetch_array($sql, OCI_BOTH)) != false) {
            $alias = "numar";
            $sql1 = oci_parse($conn, "select f_best_deal('".$_SESSION['oras']."', '".$row['NUME']."') as ceva  from dual");
            oci_execute($sql1);
            $total = 0;
            while (($row1 = oci_fetch_array($sql1, OCI_BOTH)) != false) {
                echo "<li class = 'element' >".$row['NUME']."............".$row1['CEVA']."</li>";

            }
        }
    
    }
?>
<html lang="en" >
<head>
    <meta charset="utf-8" />
    <title>FII Caffe</title>
    <meta name="description" content="Restaurante cu specific italian">
    <link rel="stylesheet" href="StyleDeal.css">
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
