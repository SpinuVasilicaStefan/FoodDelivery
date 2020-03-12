<!DOCTYPE html>
<?php  

    session_start();

    

    function afisare_paste(){    
    $conn = oci_connect('STUDENT', 'STUDENT', 'localhost/XE');
    $nume = "nume";
    $restaurant = "restaurant";
    $pret = "pret";
    $combinari="ceva";
        
        /*$sql = oci_parse($conn, "select id_comb as combinari, avgsal as ".$nume.", avgsal1 as ".$restaurant.", avgsal2 as ".$pret." from (select c.id_combinari AS id_comb, p.nume AS avgsal, r.nume as avgsal1, c.pret as avgsal2  from produse p
    join combinari c on p.id_produs = c.id_produs
    join restaurant r on r.id_restaurant = c.id_restaurant and  p.id_categorie = 'Paste' and r.oras = '".$_SESSION['oras']."' order by 1 ASC) ");*/
        
        $sql = oci_parse($conn, "select c.id_combinari as combinari, p.nume as ".$nume.", r.nume as ".$restaurant.", c.pret as ".$pret."  from combinari c
        join produse p on p.id_produs = c.id_produs
        join restaurant r on r.id_restaurant = c.id_restaurant
        and p.id_categorie='Paste'");
        
      
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
              <p class="prima">'.$row['NUME'].' <br>Restaurant: '.$row['RESTAURANT'].' <br>Pret: '.$row['PRET'].'</p>
              <form action="Paste.php" method="post"><input type="submit" name='.$row['COMBINARI'].' value="Comanda"></form></div>';
            $aux = 1;
        }
        else{
            echo '<div class="casuta rotate_left">
              <p class="prima">'.$row['NUME'].' <br>Restaurant: '.$row['RESTAURANT'].' <br>Pret: '.$row['PRET'].'</p> 
              <form action="Paste.php" method="post"><input type="submit" name='.$row['COMBINARI'].' value="Comanda"></form></div> ';
            $aux = 0;
        }
        
        
        if(isset($_POST[$row['COMBINARI']]))
        {
            $interogare = oci_parse($conn, "SELECT MAX(id_comanda) AS id FROM comanda");
            oci_execute($interogare);
            $result = oci_fetch_assoc($interogare);
            $id = $result['ID'];
            if(isset($_SESSION['comanda_noua']) and $_SESSION['comanda_noua'] === true)
            {
                $_SESSION['comanda_noua'] = false;
                $id = $id + 1;
            }
            $_SESSION['comanda'] = $id;
            // am luat id pentru comanda
            $com ="-";
            $comb = $row['COMBINARI'];
            $ins = oci_parse($conn, "INSERT INTO comanda VALUES (".$id.",
            ".$_SESSION['id_client'].", ".$row['COMBINARI'].", '=')");
            
            if(!isset($_SESSION['id_client']))
                header("Location: Logare.php");


            oci_execute($ins);
            unset($_POST[$row['COMBINARI']]);
            header("Location: Paste.php");
            
        }
        echo $row['COMBINARI'];
    }
  }




?>
<html lang="en" >
<head>
    <meta charset="utf-8" />
    <title>FII Caffe</title>
    <meta name="description" content="Restaurante cu specific italian">
    <link rel="stylesheet" href="style3.css">
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
    
    <div class = "descriere"><p>Produse de pe site-ul nostru</p></div>
    <div class = "galerie">
      <?php
        afisare_paste()
        
        ?>   
    </div>
    
    <footer>
         <p> © Spînu Vasilică Ștefan, Muntean Cătălin-Tudor, 2019 </p>
    </footer>
    
</body>
</html>
