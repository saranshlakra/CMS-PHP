<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

if( !isset( $_GET['id'] ) )
{
  
  header( 'Location: connect.php' );
  die();
  
}

if( isset( $_POST['title'] ) )
{
  
  if( $_POST['title'] )
  {
    
    $query = 'UPDATE connect SET
      title = "'.mysqli_real_escape_string( $connect, $_POST['title'] ).'",
      link = "'.mysqli_real_escape_string( $connect, $_POST['link'] ).'"
      WHERE id = '.$_GET['id'].'
      LIMIT 1';
    mysqli_query( $connect, $query );
    
    set_message( 'Connection has been updated' );
    
  }

  header( 'Location: connect.php' );
  die();
  
}


if( isset( $_GET['id'] ) )
{
  
  $query = 'SELECT *
    FROM connect
    WHERE id = '.$_GET['id'].'
    LIMIT 1';
  $result = mysqli_query( $connect, $query );
  
  if( !mysqli_num_rows( $result ) )
  {
    
    header( 'Location: connect.php' );
    die();
    
  }
  
  $record = mysqli_fetch_assoc( $result );
  
}

include( 'includes/header.php' );

?>

<h2>Edit Connection</h2>

<form method="post">
  
  <label for="title">Title:</label>
  <input type="text" name="title" id="title" value="<?php echo htmlentities( $record['title'] ); ?>">
    
  <br>
  
  <label for="link">Link:</label>
  <input type="text" name="link" id="link" value="<?php echo htmlentities( $record['link'] ); ?> ">
  
  <br>

  <input type="submit" value="Edit Connection">
  
</form>

<p><a href="connect.php"><i class="fas fa-arrow-circle-left"></i> Return to Connection List</a></p>


<?php

include( 'includes/footer.php' );

?>