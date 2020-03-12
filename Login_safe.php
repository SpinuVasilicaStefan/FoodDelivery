<!DOCTYPE html>

<html lang="en" >
<head>
    <meta charset="utf-8" />
    <title>FII Caffe</title>
    <meta name="description" content="Restaurante cu specific italian">
    <link rel="stylesheet" href="styleLogare.css">
    </head>
    
    <body>
         <div id = "main-wrapper">
             <center>
                <img src="Poze/logo.png" class = "avatar" alt = ""/>
            </center>
             <div class="erori">
               <?php session_start();   if(isset($_SESSION['eroare'])) echo $_SESSION['eroare']; ?>
             </div>
             <form class="myform" method="post" action="ctrllog_safe.php">
                <label>Username:</label><span class="error"> *<br/></span>
            <input type = "text" name = "username" class = "inputvalues"
            placeholder="Indroduceti un nume"><br/>
                <label>Password:</label><span class="error"> *<br/></span>
            <input type="password" name = "parola" class = "inputvalues"
            placeholder="Indroduceti parola"><br/>
            <input type="submit" name="login" value="Logare">
            <a class = "inregistrare" href="Inregistrare.php">Creare cont nou</a>
            <a class = "safe" href="Logare.php">Supliment sql</a>
            </form>
        </div>

    </body>
    
    <footer>
         <p> © Spînu Vasilică Ștefan, Muntean Cătălin-Tudor, 2019 </p>
    </footer>
</html>
