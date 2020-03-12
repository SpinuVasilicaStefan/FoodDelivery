<?php

require_once('modelreg.php');

session_start();

function preluare_date()
{
    $_SESSION['username'] = $_POST['username'];
	$_SESSION['nume'] = $_POST['nume'];
	$_SESSION['prenume'] = $_POST['prenume'];
    $_SESSION['telefon'] = $_POST['telefon'];
	$_SESSION['oras'] = $_POST['oras'];
    $_SESSION['adresa'] = $_POST['adresa'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['sex'] = $_POST['sex'];
	$_SESSION['parola'] = $_POST['parola'];
	$_SESSION['parola2'] = $_POST['parola2'];
    
}

function validare()
{
		if(empty($_SESSION['nume']) or empty($_SESSION['prenume']) or empty($_SESSION['telefon']) or empty($_SESSION['parola']) or empty($_SESSION['parola2']) or empty($_SESSION['username']) or empty($_SESSION['oras']) or empty($_SESSION['adresa']) or empty($_SESSION['email']))
	    {
	        $_SESSION['eroare'] = "Toate campurile sunt obligatorii!";
	    }
		else
		{
			if(strlen($_SESSION['telefon']) == 10) // si toate sunt cifre
			{
				$nr_linii = verifica_existenta($_SESSION['telefon']);

	            if($nr_linii > 0)
	            {
	            	$_SESSION['eroare'] = "Nr. de telefon utilizat la crearea altui cont!";
	            }
	            else
	            {
	            	if(strlen($_SESSION['parola']) > 4)
	            	{
	            		if($_SESSION['parola'] === $_SESSION['parola'])
		            	{
		            		unset($_SESSION['eroare']);
		            	}
		            	else
		            	{

		            		$_SESSION['eroare'] = "Parolele nu coincid!";
		            	}
	            	}
	            	else
	            	{
	            		$_SESSION['eroare'] = "Parola trebuie sa aiba minim 5 caractere!";
	            	}
	            }
			}
			else
			{
				$_SESSION['eroare'] = "Numar de telefon invalid!";
			}
		}
	}

	function inregistrare()
	{
		if(isset($_POST["register"]))
		{
			preluare_date();
			validare();
			if(isset($_SESSION['eroare']))
			{
                header("Location: Inregistrare.php");
				//echo $_SESSION['eroare'];
			}
			else
			{
				adaugare($_SESSION['username'], $_SESSION['nume'], $_SESSION['prenume'], $_SESSION['telefon'], $_SESSION['oras'], $_SESSION['adresa'], $_SESSION['email'], $_SESSION['sex'], $_SESSION['parola']);
                $_SESSION['log']=true;
                header("Location: Principala.php");
            }
		}
	}

	inregistrare();

?>