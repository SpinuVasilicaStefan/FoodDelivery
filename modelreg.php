<?php

function verifica_existenta($nr_tel)
{
	$conn = oci_connect('STUDENT', 'STUDENT', 'localhost/XE');
    $sql = oci_parse($conn, "SELECT * FROM clienti WHERE telefon='$nr_tel'");
    oci_execute($sql);
    oci_fetch_array($sql, OCI_DEFAULT);
    $nr_linii = oci_num_rows($sql);
    return $nr_linii;
}

function adaugare($username, $nume, $prenume, $nr_tel, $oras, $adresa, $email, $sex, $parola)
{
	$conn = oci_connect('STUDENT', 'STUDENT', 'localhost/XE');
    
    $interogare = oci_parse($conn, "SELECT MAX(id_client) AS id FROM clienti");
    oci_execute($interogare);
    $result = oci_fetch_assoc($interogare);
    $id = $result['ID'];
    
    $id= $id + 1;
    $_SESSION['id_client'] = $id;
    $_SESSION['nume_utilizator'] = $username;
    $sql = oci_parse($conn, "EXEC inserare(".$id.",
    '".$username."',
    '".$nume."', '".$prenume."',
    '".$nr_tel."', '".$oras."',
    '".$adresa."', '".$email."', '".$sex."', '".$parola."')");
    
    oci_bind_by_name($sql, ":bid", $id);
    oci_bind_by_name($sql, ":busername", $username);
    oci_bind_by_name($sql, ":bnume", $nume);
    oci_bind_by_name($sql, ":bprenume", $prenume);
    oci_bind_by_name($sql, ":btelefon", $nr_tel);
    oci_bind_by_name($sql, ":boras", $oras);
    oci_bind_by_name($sql, ":badresa", $adresa);
    oci_bind_by_name($sql, ":bemail", $email);
    oci_bind_by_name($sql, ":bsex", $sex);
    oci_bind_by_name($sql, ":bparola", $parola);
    echo $sql;
    //oci_execute($sql);
}

?>