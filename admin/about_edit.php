<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure(); // checking user

if( !isset( $_GET['id'] ) )
{
  
  header( 'Location: about.php' ); // redirecting to about page
  die();
  
}

if( isset( $_POST['tagline'] ) )
{
  
  if( $_POST['tagline'] )
  {
    
    $query = 'UPDATE about SET
      tagline = "'.mysqli_real_escape_string( $connect, $_POST['tagline'] ).'",
      description = "'.mysqli_real_escape_string( $connect, $_POST['description'] ).'"
      WHERE id = '.$_GET['id'].'
      LIMIT 1';
    mysqli_query( $connect, $query );
    
    set_message( 'About has been updated' );
    
  }
// echo $query;
 header( 'Location: about.php' );
  die();
  
}


if( isset( $_GET['id'] ) )
{
  
  $query = 'SELECT * FROM about WHERE id = '.$_GET['id'].' LIMIT 1';
  
  $result = mysqli_query( $connect, $query );
  
  if( !mysqli_num_rows( $result ) )
  {
    
    header( 'Location: about.php' );
    die();
    
  }
  
  $record = mysqli_fetch_assoc( $result );
  
}

include( 'includes/header.php' );

?>

<h2>Edit About</h2>

<form method="post">
  
  <label for="tagline">Tagline:</label>
  <input type="text" name="tagline" id="tagline" value="<?php echo htmlentities( $record['tagline'] ); ?>">
    
  <br>
  
  <label for="description">Description:</label>
  <input type="text" name="description" id="description" value="<?php echo htmlentities( $record['description'] ); ?> ">
  
  
  <br>
  
  <input type="submit" value="Edit about">
  
</form>

<p><a href="about.php"><i class="fas fa-arrow-circle-left"></i> Return to About List</a></p>


<?php

include( 'includes/footer.php' );

?>