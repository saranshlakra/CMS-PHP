<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

if( isset( $_POST['instituename'] ) )
{
  
  if( $_POST['instituename'] )
  {
    
    $query = 'INSERT INTO education (
        instituename,
        location,
        degree,
        completedate,
        info
      ) VALUES (
         "'.mysqli_real_escape_string( $connect, $_POST['instituename'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['location'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['degree'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['completedate'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['info'] ).'"
      )';
    mysqli_query( $connect, $query );
    
    // echo $query;
    set_message( 'Education has been added' );
    
  }
  
  header( 'Location: education.php' );
  die();
  
}

include( 'includes/header.php' );

?>

<h2>Add Education</h2>

<form method="post">
  
  <label for="instituename">Institution Name:</label>
  <input type="text" name="instituename" id="instituename">
    
  <br>
  
  <label for="location">Location:</label>
  <input type="text" name="location" id="location" >
    
  <br>
  
  <label for="degree">Degree:</label>
  <input type="text" name="degree" id="degree">
    
  <br>
  
  <label for="completedate">Completion Date:</label>
  <input type="text" name="completedate" id="completedate">
    
  <br>

  <label for="info">Small Info:</label>
  <textarea type="text" name="info" id="info" rows="5"></textarea>
  
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

  <input type="submit" value="Add Education">
  
</form>

<p><a href="education.php"><i class="fas fa-arrow-circle-left"></i> Return to Education List</a></p>


<?php

include( 'includes/footer.php' );

?>