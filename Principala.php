<!DOCTYPE html>
<?php  

    session_start();

  function afisare(){    
    $conn = oci_connect('STUDENT', 'STUDENT', 'localhost/XE');
    $nume = "nume";
    $restaurant = "restaurant";
    echo gettype($_SESSION['oras']);
    $sql = oci_parse($conn, "select avgsal as ".$nume.", avgsal1 as ".$restaurant." from (select DISTINCT(p.nume) AS avgsal, count(*), r.nume as avgsal1  from produse p
    join combinari c on p.id_produs = c.id_produs
    join restaurant r on r.id_restaurant = c.id_restaurant
    join comanda c1 on c1.id_combinari = c.id_combinari and  r.oras = '".$_SESSION['oras']."' group by p.nume, r.nume order by 2 desc) where rownum <= 5");
      
      
    oci_execute($sql);
                
    $casuta1 = "'casuta rotate_right'";
    $casuta2 = "casuta rotate_left";
    $clasa = "caption";
    $poza = "Poze/carbonara.jpg";
    $alt = "Carbonara";
    $wid = "284";
    $hei = "213";
    $aux = 0;
    while (($row = oci_fetch_array($sql, OCI_BOTH)) != false) {
        if($aux == 0){
            echo '<div class="casuta rotate_right">
              <p class="prima">'.$_SESSION['oras'].' <br>Restaurant: '.$row['RESTAURANT'].'</p>
              </div>';
            $aux = 1;
        }
        else{
            echo '<div class="casuta rotate_left">
              <p class="prima">'.$row['NUME'].' <br>Restaurant: '.$row['RESTAURANT'].'</p>
              </div>';
            $aux = 0;
        }
        
    }
  }

    function afisarePoza(){
        $conn = oci_connect('STUDENT', 'STUDENT', 'localhost/XE'); 
        $tag = "Imagine";
        $alt = "Img";
        $src1 = "Poze/Pizza4.jpg";
        $src2 = "Poze/pasta.jpg";
        $src3 = "Poze/desert.jpg";
        $alias = "numar";
        $sql = oci_parse($conn, "select f_produs_cautat('".$_SESSION['oras']."') as ".$alias."  from dual");
        oci_execute($sql);
        while (($row = oci_fetch_array($sql, OCI_BOTH)) != false) {
            $sql1 = oci_parse($conn, "select id_categorie from produse where nume = '".$row['NUMAR']."'");
            oci_execute($sql1);
            while (($row1 = oci_fetch_array($sql1, OCI_BOTH)) != false) {
                if($row1['ID_CATEGORIE'] == 'Deserturi')
                    echo "<div class = ".$tag." ><img src = ".$src3." alt = ".$alt." ></div>";
                 else
                    if($row1['ID_CATEGORIE'] == 'Paste')
                        echo "<div class = ".$tag." ><img src = ".$src2." alt = ".$alt." ></div>";
                    else
                        echo "<div class = ".$tag." ><img src = ".$src1." alt = ".$alt." ></div>";
            }
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
<html lang="en" >
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
      <li class="dreapta"><a href=<?php 
                             
                             if(isset($_SESSION['log']) and $_SESSION['log'] === true)
                                 echo "cont.php";
                             else echo "Logare.php";
                             ?>
                             class="active">Contul meu</a></li>
      <li class="dreapta"><a href="cos.php" class="active">Cos</a></li>
    </ul>
    
    <?php
    //if(isset($_SESSION['log']))
        afisarePoza();
    ?>
    <div class = "descriere"><p>Statistici efectuate pe baza comenzilor efectuate in orasul dumneavoastra:</p></div>
    <div class = "galerie">
      <?php
        //if(isset($_SESSION['log'])){
        afisareCautat();
        afisareFemei();
        afisareBarbati();
        afisareRestaurant();
        afisareNr();
        //}
        
        ?>  
        
    </div>
    
    <footer>
         <p> © Spînu Vasilică Ștefan, Muntean Cătălin-Tudor, 2019 </p>
    </footer>
    
</body>
</html>
