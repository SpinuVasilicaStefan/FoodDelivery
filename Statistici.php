<!DOCTYPE html>
<?php
    session_start();

    function afisareFluctuatie(){
        $conn = oci_connect('STUDENT', 'STUDENT', 'localhost/XE'); 
        $tag = "Imagine";
        $alt = "Img";
        $alias = "numar";
        $sql = oci_parse($conn, "select f_clienti_fluctuatie() as ".$alias."  from dual");
        oci_execute($sql);
        while (($row = oci_fetch_array($sql, OCI_BOTH)) != false) {
            echo '<div class="casuta rotate_right"><p class="prima">Media clientilor noi / zi: <br>'.$row['NUMAR'].'</p>
              </div>';
        }
    
    }

    function afisareCautat(){
        $conn = oci_connect('STUDENT', 'STUDENT', 'localhost/XE'); 
        $tag = "Imagine";
        $alt = "Img";
        $alias = "numar";
        $sql = oci_parse($conn, "select f_produs_cautat('".$_SESSION['oras']."') as ".$alias."  from dual");
        oci_execute($sql);
        while (($row = oci_fetch_array($sql, OCI_BOTH)) != false) {
            echo '<div class="casuta rotate_left"><p class="prima">Produs popular in orasul dumneavoastra: <br>'.$row['NUMAR'].'</p>
              </div>';
        }
    
    }

    function afisareDesertCautat(){
        $conn = oci_connect('STUDENT', 'STUDENT', 'localhost/XE'); 
        $tag = "Imagine";
        $alt = "Img";
        $alias = "numar";
        $sql = oci_parse($conn, "select f_desert_cautat('".$_SESSION['oras']."') as ".$alias."  from dual");
        oci_execute($sql);
        while (($row = oci_fetch_array($sql, OCI_BOTH)) != false) {
            echo '<div class="casuta rotate_left"><p class="prima">Desert popular in orasul dumneavoastra: <br>'.$row['NUMAR'].'</p>
              </div>';
        }
    
    }

    function afisarePasteCautat(){
        $conn = oci_connect('STUDENT', 'STUDENT', 'localhost/XE'); 
        $tag = "Imagine";
        $alt = "Img";
        $alias = "numar";
        $sql = oci_parse($conn, "select f_paste_cautat('".$_SESSION['oras']."') as ".$alias."  from dual");
        oci_execute($sql);
        while (($row = oci_fetch_array($sql, OCI_BOTH)) != false) {
            echo '<div class="casuta rotate_right"><p class="prima">Paste populare in orasul dumneavoastra: <br>'.$row['NUMAR'].'</p>
              </div>';
        }
    
    }

    function afisarePizzaCautat(){
        $conn = oci_connect('STUDENT', 'STUDENT', 'localhost/XE'); 
        $tag = "Imagine";
        $alt = "Img";
        $alias = "numar";
        $sql = oci_parse($conn, "select f_pizza_cautat('".$_SESSION['oras']."') as ".$alias."  from dual");
        oci_execute($sql);
        while (($row = oci_fetch_array($sql, OCI_BOTH)) != false) {
            echo '<div class="casuta rotate_left"><p class="prima">Pizza populara in orasul dumneavoastra: <br>'.$row['NUMAR'].'</p>
              </div>';
        }
    
    }




    function afisareFemei(){
        $conn = oci_connect('STUDENT', 'STUDENT', 'localhost/XE'); 
        $tag = "Imagine";
        $alt = "Img";
        $alias = "numar";
        $sql = oci_parse($conn, "select f_produs_femei('".$_SESSION['oras']."') as ".$alias."  from dual");
        oci_execute($sql);
        while (($row = oci_fetch_array($sql, OCI_BOTH)) != false) {
            echo '<div class="casuta rotate_right"><p class="prima">Produs popular printre femei :<br>'.$row['NUMAR'].'</p>
              </div>';
        }
    
    }

    function afisareBarbati(){
        $conn = oci_connect('STUDENT', 'STUDENT', 'localhost/XE'); 
        $tag = "Imagine";
        $alt = "Img";
        $alias = "numar";
        $sql = oci_parse($conn, "select f_produs_barbati('".$_SESSION['oras']."') as ".$alias."  from dual");
        oci_execute($sql);
        while (($row = oci_fetch_array($sql, OCI_BOTH)) != false) {
            echo '<div class="casuta rotate_left"><p class="prima">Produs popular printre barbati :<br>'.$row['NUMAR'].'</p>
              </div>';
        }
    
    }
    function afisareRestaurant(){
        $conn = oci_connect('STUDENT', 'STUDENT', 'localhost/XE'); 
        $tag = "Imagine";
        $alt = "Img";
        $alias = "numar";
        $sql = oci_parse($conn, "select f_restaurant_bune('".$_SESSION['oras']."') as ".$alias."  from dual");
        oci_execute($sql);
        while (($row = oci_fetch_array($sql, OCI_BOTH)) != false) {
            echo '<div class="casuta rotate_right"><p class="prima">Cel mai bun restaurant din oras:<br>'.$row['NUMAR'].'</p>
              </div>';
        }
    
    }
    function afisareRestaurantSlab(){
        $conn = oci_connect('STUDENT', 'STUDENT', 'localhost/XE'); 
        $tag = "Imagine";
        $alt = "Img";
        $alias = "numar";
        $sql = oci_parse($conn, "select f_restaurant_slab('".$_SESSION['oras']."') as ".$alias."  from dual");
        oci_execute($sql);
        while (($row = oci_fetch_array($sql, OCI_BOTH)) != false) {
            echo '<div class="casuta rotate_left"><p class="prima">Cel mai slab restaurant din oras:<br>'.$row['NUMAR'].'</p>
              </div>';
        }
    
    }

    function afisareNr(){
        $conn = oci_connect('STUDENT', 'STUDENT', 'localhost/XE'); 
        $tag = "Imagine";
        $alt = "Img";
        $alias = "numar";
        $sql = oci_parse($conn, "select f_clienti_azi() as ".$alias."  from dual");
        oci_execute($sql);
        while (($row = oci_fetch_array($sql, OCI_BOTH)) != false) {
            echo '<div class="casuta rotate_left"><p class="prima">Clienti noi astazi :<br>'.$row['NUMAR'].'</p>
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
        afisareDesertCautat();
        afisarePasteCautat();
        afisarePizzaCautat();
        afisareFemei();
        afisareBarbati();
        afisareRestaurant();
        //afisareRestaurantSlab();
        afisareFluctuatie();
        afisareNr();
        ?>  
        
    </div>
    
    <footer>
         <p> © Spînu Vasilică Ștefan, Muntean Cătălin-Tudor, 2019 </p>
    </footer>
    
</body>
</html>
