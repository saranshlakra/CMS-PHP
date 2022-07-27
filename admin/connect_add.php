<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

if( isset( $_POST['title'] ) )
{
  
  if( $_POST['title'] )
  {
    
    $query = 'INSERT INTO connect (
        photo,
        link,
        title
    ) VALUES (
         "'.mysqli_real_escape_string( $connect, $_POST['photo'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['link'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['title'] ).'"
      )';
    mysqli_query( $connect, $query );
    
    set_message( 'Connection has been added' );
    
  }
  
  header( 'Location: connect.php' );
  die();
  
}

include( 'includes/header.php' );

?>

<h2>Add Connection</h2>

<form method="post">
  
  <label for="title">Title:</label>
  <input type="text" name="title" id="title">
    
  <br>
  
  <label for="link">Link:</label>
  <input type="text" name="link" id="link">
  
  <br>
  
  <input type="submit" value="Add Connection">
  
</form>

<p><a href="connect.php"><i class="fas fa-arrow-circle-left"></i> Return to Connection List</a></p>


<?php

include( 'includes/footer.php' );

?>