<!DOCTYPE html>

<?php
    if(isset($_POST['logout']))
    {
        session_start();
        session_destroy();
        header("Location: Principala.php");
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
      <li class="dreapta"><a href="cos.php" class="active">Cos</a></li>
      <li class="dreapta"><a href="cont.php" class="active">Contul meu</a></li>
    </ul>
    
    <div class="cont">
        <?php
            session_start();
            echo "<p>Nume: ".$_SESSION['nume']."<?p>";
            echo "<p>Prenume: ".$_SESSION['prenume']."<?p>";
            echo "<p>Username: ".$_SESSION['nume']."<?p>";
            echo "<p>Email: ".$_SESSION['email']."<?p>";
            echo "<p>Telefon: ".$_SESSION['telefon']."<?p>";
            echo "<p>Oras: ".$_SESSION['oras']."<?p>";
            echo "<p>Adresa: ".$_SESSION['adresa']."<?p>";
        ?>
        <form action="cont.php" method="post">
            <input type="submit" name="logout" value="Deconectare">
        </form>
    </div>
    
    
    <footer>
         <p> © Spînu Vasilică Ștefan, Muntean Cătălin-Tudor, 2019 </p>
    </footer>
    
</body>
</html>
