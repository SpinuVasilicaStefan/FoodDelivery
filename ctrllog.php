<?php

require_once 'modellog.php';

session_start();

function preluare_date()
{
	$_SESSION['username'] = $_POST['username'];
	$_SESSION['parola'] = $_POST['parola'];
}

function validare()
{
	if(empty($_SESSION['username']) or empty($_SESSION['parola']))
	{
		$_SESSION['eroare'] = "Toate campurile sunt obligatorii!";
	}
	else
	{
		if(strlen($_SESSION['username']) > 4)
		{
			if(strlen($_SESSION['parola']) > 4)
	        {
           		$nr_linii = verifica_bd($_SESSION['username'], $_SESSION['parola']);
           		if($nr_linii == 0)
           		{
           			$_SESSION['eroare'] = "Username sau parola gresite!";
           		}
           		else
           		{
                    $username =$_SESSION['username'];
                    $parola = $_SESSION['parola'];
                    $conn = oci_connect('STUDENT', 'STUDENT', 'localhost/XE');
                    $sql = oci_parse($conn, "select * from clienti where nume_utilizator = '$username' and parola='$parola'");
                    oci_execute($sql);
                    $res=oci_fetch_array($sql, OCI_BOTH);
                    $_SESSION['nume_utilizator']=$res['NUME_UTILIZATOR'];
                    $_SESSION['id_client']=$res['ID_CLIENT'];
                    $_SESSION['nume']=$res['NUME'];
                    $_SESSION['prenume']=$res['PRENUME'];
                    $_SESSION['oras']=$res['ORAS'];
                    $_SESSION['adresa']=$res['ADRESA'];
                    $_SESSION['telefon']=$res['TELEFON'];
                    $_SESSION['email']=$res['EMAIL'];
                    $_SESSION['sex']=$res['SEX'];
                    $_SESSION['log']=true;
                    
                
                    
           			unset($_SESSION['eroare']);
           		}
	       	}
	       	else
	       	{
	       		$_SESSION['eroare'] = "Parola trebuie sa aiba minim 5 caractere!";
	       	}
		}
		else
		{
			$_SESSION['eroare'] = "Username invalid!";
		}
	}
}

function logare()
{
	if(isset($_POST['login']))
	{
		preluare_date();
		validare();
		if(isset($_SESSION['eroare']))
		{
            header("Location: Logare.php");
            //echo $_SESSION['eroare'];
		}
		else
		{
			header("Location: Principala.php");
		}
	}
}

logare();

?>