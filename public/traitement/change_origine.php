<?php 
include "../db/db.php";

  if( isset( $_POST['origine'] ) )
  {
    $origine = $_POST['origine'];
    $intervention_id = $_POST['id'];

    if ($origine == 3) {
		$origine = 2; //la variable origine_txt est l'inverse de la var origine, comme ca on l'affiche ci-dessous
	}
	else if ($origine == 2 ) {
		$origine = 3;
	}    
    
    $sql = "UPDATE intervention SET origine_id = :origine WHERE id = :intervention_id";    
        
    $data				= array(
    ':origine' 			=> $origine,
    ':intervention_id' 	=> $intervention_id,
    );
    
    try {
    $requete 	= 	$bdd -> prepare($sql);
    $requete	-> 	execute($data);
    }
    catch(Exception $e){							
    echo '<div class="alert alert-danger" role="alert">';
    printf("<p>ERROR SQL</p><p>Error : %s\n", $e->getMessage());
    echo "</p><p>$sql</p><p> Data : "; print_r($data); echo "</p>";
    echo '</div>';
    }
  }
  ?>
