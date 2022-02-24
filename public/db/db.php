<?php
    try {
        $bdd = new PDO( 'mysql:host=127.0.0.1:3307;dbname=gestionnaireTache', 'root', '' );
        $bdd->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        $bdd->exec("SET NAMES 'UTF8'");
        // echo "good";
    } catch ( Exception $e ) {
        die( 'Erreur : ' . $e->getMessage() );
    }
    // echo "<p>Test</p>";
?>