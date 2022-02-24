<?php 
include "../db/db.php";

  if( isset( $_POST['choix_services'] ) )
  {
    $service_choisi = $_POST['choix_services'];
    $intervention_id = $_POST['id'];
    // echo "<p>$service_choisi</p>";
    // echo "<p>$intervention_id</p>";
    
    $sql_recherche_id = "SELECT id FROM service WHERE title = :service_choisi";
      
    $data				= array(
        ':service_choisi' 	=> $service_choisi,
        );
    
    $requete 	= 	$bdd -> prepare($sql_recherche_id);
    $requete	-> 	execute($data);
    while ( $row    = $requete -> fetch()) {
        $id_service = $row['id'];
    }
    
    // echo '<hr>';
    // echo "<p>$id_service</p>";
    
    $sql = "UPDATE intervention SET service_id = :id_service WHERE id = :intervention_id";
    
    
        
    $data				= array(
    ':id_service' 	    => $id_service,
    ':intervention_id' 	=> $intervention_id,
    );
    
    try {
    $requete 	= 	$bdd -> prepare($sql);
    $requete	-> 	execute($data);
    // header("Location: /intervention/");
    }
    catch(Exception $e){							
    echo '<div class="alert alert-danger" role="alert">';
    printf("<p>ERROR SQL</p><p>Error : %s\n", $e->getMessage());
    echo "</p><p>$sql</p><p> Data : "; print_r($data); echo "</p>";
    echo '</div>';
    }
  }



// $service_choisi = $_POST['choix_services'];
// $intervention_id = $_POST['intervention_id'];
// echo "<p>$service_choisi</p>";
// echo "<p>$intervention_id</p>";

// $sql_recherche_id = "SELECT id FROM service WHERE title = :service_choisi";
  
// $data				= array(
//     ':service_choisi' 	=> $service_choisi,
//     );

// $requete 	= 	$bdd -> prepare($sql_recherche_id);
// $requete	-> 	execute($data);
// while ( $row    = $requete -> fetch()) {
//     $id_service = $row['id'];
// }

// echo '<hr>';
// echo "<p>$id_service</p>";

// $sql = "UPDATE intervention SET service_id = :id_service WHERE id = :intervention_id";


    
// $data				= array(
// ':id_service' 	    => $id_service,
// ':intervention_id' 	=> $intervention_id,
// );

// try {
// $requete 	= 	$bdd -> prepare($sql);
// $requete	-> 	execute($data);
// header("Location: /intervention/");
// }
// catch(Exception $e){							
// echo '<div class="alert alert-danger" role="alert">';
// printf("<p>ERROR SQL</p><p>Error : %s\n", $e->getMessage());
// echo "</p><p>$sql</p><p> Data : "; print_r($data); echo "</p>";
// echo '</div>';
// }
?>