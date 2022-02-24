<?php 
include "../db/db.php";
$user = $_POST['choix_users'];
$user_explose = explode('|',$user);
$user_id = $user_explose[1];
$intervention_id = $_POST['intervention_id'];
echo "<p>$user_id</p>";
echo "<p>$intervention_id</p>";


$sql_recherche_id = "SELECT id FROM user WHERE id = :user_id";

$data				= array(
    ':user_id' 	=> $user_id,
    );

$requete 	= 	$bdd -> prepare($sql_recherche_id);
$requete	-> 	execute($data);
while ( $row    = $requete -> fetch()) {
    $id_user = $row['id'];
}

if ($id_user != $user_id ){
header("Location: /intervention/");
}
else {

$sql = "UPDATE intervention SET agent_id = :user_id WHERE id = :intervention_id";


    
$data				= array(
':user_id' 			=> $user_id,
':intervention_id' 	=> $intervention_id,
);

try {
$requete 	= 	$bdd -> prepare($sql);
$requete	-> 	execute($data);
header("Location: /intervention/");
}
catch(Exception $e){							
echo '<div class="alert alert-danger" role="alert">';
printf("<p>ERROR SQL</p><p>Error : %s\n", $e->getMessage());
echo "</p><p>$sql</p><p> Data : "; print_r($data); echo "</p>";
echo '</div>';
}
}
