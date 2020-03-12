<!DOCTYPE html>
<?php  

    session_start();

    
?>
<html lang="en" >
<head>
    <meta charset="utf-8" />
    <title>FII Caffe</title>
    <meta name="description" content="Restaurante cu specific italian">
    <link rel="stylesheet" href="style4.css">
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
    
    <div class = "descriere"><p>Categorii disponibile</p></div>
    <div class = "galerie">
    
        <a href = "Pizza.php"><div class="casuta rotate_right">
        <p class="caption">Pizza</p>
        </div></a>

        <a href = "Paste.php"><div class="casuta rotate_left">
          
          <p class="caption">Paste</p>
        </div></a>

        <a href = "Deserturi.php"><div class="casuta rotate_right">
          
          <p class="caption">Deserturi</p>
        </div></a>

    
        
        
        
    </div>
    <footer>
         <p> © Spînu Vasilică Ștefan, Muntean Cătălin-Tudor, 2019 </p>
    </footer>
    
</body>
</html>
