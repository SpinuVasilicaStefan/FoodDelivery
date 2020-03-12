<!DOCTYPE html>
<?php
    session_start();
    ini_set('max_execution_time', 300);
    
    function afisareProfit(){
        $conn = oci_connect('STUDENT', 'STUDENT', 'localhost/XE'); 
        $tag = "Imagine";
        $alt = "Img";
        $alias = "numar";
        $sql = oci_parse($conn, "select f_profit_interval_anual('".$_SESSION['oras']."') as ".$alias."  from dual");
        oci_execute($sql);
        while (($row = oci_fetch_array($sql, OCI_BOTH)) != false) {
            echo '<div class="casuta rotate_left"><p class="prima">Profit lunar :<br>'.$row['NUMAR'].'</p>
              </div>';
        }
    }

     function afisareProfitLunar(){
        $conn = oci_connect('STUDENT', 'STUDENT', 'localhost/XE'); 
        $tag = "Imagine";
        $alt = "Img";
        $alias = "numar";
        $sql = oci_parse($conn, "select f_profit_interval_lunar('".$_SESSION['oras']."') as ".$alias."  from dual");
        oci_execute($sql);
        while (($row = oci_fetch_array($sql, OCI_BOTH)) != false) {
            echo '<div class="casuta rotate_left"><p class="prima">Profit lunar :<br>'.$row['NUMAR'].'</p>
              </div>';
        }
    }
     

?>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>FII Caffe</title>
    <meta name="description" content="Restaurante cu specific italian">
    <link rel="stylesheet" href="style2.css">
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
      <li class="dreapta"><a href="cont.php" class="active">Cont</a></li>
      <li class="dreapta"><a href="cos.php" class="active">Cos</a></li>
    </ul>
    
    <div class = "descriere"><p>Noi suntem o firma transparenta, care doreste sa isi mentina clientii informati in legatura cu activitatea noastra, asa ca va punem la dispozitie o serie de statistici </p></div>
    <div class = "galerie">
      <?php
        afisareProfitLunar();
        afisareProfit();
        ?>  
        
    </div>
    
    <footer>
         <p> © Spînu Vasilică Ștefan, Muntean Cătălin-Tudor, 2019 </p>
    </footer>
    
</body>
</html>
