<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
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
               <?php session_start(); if(isset($_SESSION['eroare'])) echo $_SESSION['eroare']; ?>
           </div>
             <form class="myform" method="post" action="ctrlreg.php">
                 
                <label>Nume utilizator:</label><span class="error"> *<br/></span>
                <input type = "text" name = "username" class = "inputvalues"
                placeholder="Indroduceti un nume"><br/>


                <label>Nume:</label><span class="error"> *<br/></span>
                <input type = "text" name = "nume" class = "inputvalues"
                placeholder="Indroduceti un nume"><br/>

                <label>Prenume:</label><span class="error"> *<br/></span>
                <input type = "text" name = "prenume" class = "inputvalues"
                placeholder="Indroduceti un nume"><br/>

                <label>Telefon:</label><span class="error"> *<br/></span>
                <input type = "text" name = "telefon" class = "inputvalues"
                placeholder="Indroduceti un nume"><br/>

                <label>Oras:</label><span class="error"> *<br/></span>
                <input type = "text" name = "oras" class = "inputvalues"
                placeholder="Indroduceti un nume"><br/>

                <label>Adresa:</label><span class="error"> *<br/></span>
                <input type = "text" name = "adresa" class = "inputvalues"
                placeholder="Indroduceti un nume"><br/>

                <label>Email:</label><span class="error"> *<br/></span>
                <input type = "text" name = "email" class = "inputvalues"
                placeholder="Indroduceti un nume"><br/>
                 
                 <label>Sex (Masculin/Feminin) :</label><span class="error"> *<br/></span>
                <input type = "text" name = "sex" class = "inputvalues"
                placeholder="Indroduceti un nume"><br/>

                <label>Parola:</label><span class="error"> *<br/></span>
                <input type = "password" name = "parola" class = "inputvalues"
                placeholder="Indroduceti un nume"><br/>

                <label>Repetati Parola:</label><span class="error"> *<br/></span>
                <input type = "password" name = "parola2" class = "inputvalues"
                placeholder="Indroduceti un nume"><br/>


                <input type="submit" name="register" value="Creeaza Cont">

            </form>
        </div>

    </body>
    
    <footer>
         <p> © Spînu Vasilică Ștefan, Muntean Cătălin-Tudor, 2019 </p>
    </footer>
</html>
