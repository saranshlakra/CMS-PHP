<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

if( !isset( $_GET['id'] ) )
{
  
  header( 'Location: education.php' );
  die();
  
}

if( isset( $_POST['instituename'] ) )
{
  if( $_POST['instituename'] )
  {
    
    $query = 'UPDATE education SET
      instituename = "'.mysqli_real_escape_string( $connect, $_POST['instituename'] ).'",
      location = "'.mysqli_real_escape_string( $connect, $_POST['location'] ).'",
      degree = "'.mysqli_real_escape_string( $connect, $_POST['degree'] ).'",
      completedate = "'.mysqli_real_escape_string( $connect, $_POST['completedate'] ).'",
      info = "'.mysqli_real_escape_string( $connect, $_POST['info'] ).'"
      WHERE id = '.$_GET['id'].'
      LIMIT 1';
    mysqli_query( $connect, $query );
    set_message( 'Education has been updated' );
    
  }

  
  header( 'Location: education.php' );
  die();
  
}


if( isset( $_GET['id'] ) )
{
  
  $query = 'SELECT *
    FROM education
    WHERE id = '.$_GET['id'].'
    LIMIT 1';
  $result = mysqli_query( $connect, $query );
   
//   echo $result;
//   echo $query;
  
  if( !mysqli_num_rows( $result ) )
  {
    
    header( 'Location: education.php' );
    die();
    
  }
  
  $record = mysqli_fetch_assoc( $result );
  
}

include( 'includes/header.php' );

?>

<h2>Edit Education</h2>

<form method="post">
  
  <label for="instituename">Institution Name:</label>
  <input type="text" name="instituename" id="instituename" value="<?php echo htmlentities( $record['instituename'] ); ?>">
    
  <br>

  <label for="location">Location:</label>
  <input type="text" name="location" id="location" value="<?php echo htmlentities( $record['location'] ); ?>">
    
  <br>
  
  <label for="degree">Degree:</label>
  <input type="text" name="degree" id="degree" value="<?php echo htmlentities( $record['degree'] ); ?>">
    
  <br>

  <label for="degree">Completion Date:</label>
  <input type="text" name="completedate" id="completedate" value="<?php echo htmlentities( $record['completedate'] ); ?>">
    
  <br>
  
  <label for="info">Small Info:</label>
  <textarea type="text" name="info" id="info" rows="5"><?php echo htmlentities( $record['info'] ); ?></textarea>
  
  <script>

  ClassicEditor
    .create( document.querySelector( '#info' ) )
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );
    
  </script>
  
  <br>

  <input type="submit" value="Edit Education">
  
</form>

<p><a href="education.php"><i class="fas fa-arrow-circle-left"></i> Return to Education List</a></p>


<?php

include( 'includes/footer.php' );

?>