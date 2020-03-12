<?php

function verifica_bd_safe($username, $parola) //fara sql injection
{
	$conn = oci_connect('STUDENT', 'STUDENT', 'localhost/XE');
	
    $sql = oci_parse($conn, "select * from clienti where nume_utilizator =:nm and parola=:ps");
    
    oci_bind_by_name($sql, ":nm", $username);
    oci_bind_by_name($sql, ":ps", $parola);
    
    oci_execute($sql);
    oci_fetch_array($sql, OCI_BOTH);
    $nr_linii = oci_num_rows($sql);
    return $nr_linii;
}

?>