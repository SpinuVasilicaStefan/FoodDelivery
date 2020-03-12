<?php

function verifica_bd($username, $parola)
{
	$conn = oci_connect('STUDENT', 'STUDENT', 'localhost/XE');
	$sql = oci_parse($conn, "select * from clienti where nume_utilizator = '$username' and parola='$parola'");
    //$sql = oci_parse($conn, "select * from clienti where nume_utilizator =" . "$username"); //and parola='$parola'");
    oci_execute($sql);
    oci_fetch_array($sql, OCI_BOTH);
    $nr_linii = oci_num_rows($sql);
    return $nr_linii;
}

?>