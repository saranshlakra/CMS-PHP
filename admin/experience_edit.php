<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

if( !isset( $_GET['id'] ) )
{
  
  header( 'Location: experience.php' );
  die();
  
}

if( isset( $_POST['company_name'] ) )
{
  
  if( $_POST['company_name'] )
  {
    
    $query = 'UPDATE experience SET
      company_name = "'.mysqli_real_escape_string( $connect, $_POST['company_name'] ).'",
      position = "'.mysqli_real_escape_string( $connect, $_POST['position'] ).'",
      job_role = "'.mysqli_real_escape_string( $connect, $_POST['job_role'] ).'",
      start_date = "'.mysqli_real_escape_string( $connect, $_POST['start_date'] ).'",
      end_date = "'.mysqli_real_escape_string( $connect, $_POST['end_date'] ).'"
      WHERE id = '.$_GET['id'].'
      LIMIT 1';
    mysqli_query( $connect, $query );
    
    set_message( 'Experience has been updated' );
    
  }
// echo $query;
 header( 'Location: experience.php' );
  die();
  
}


if( isset( $_GET['id'] ) )
{
  
  $query = 'SELECT * FROM experience WHERE id = '.$_GET['id'].'LIMIT 1';
  $result = mysqli_query( $connect, $query );
  
  if( !mysqli_num_rows( $result ) )
  {
    
    header( 'Location: experience.php' );
    die();
    
  }
  
  $record = mysqli_fetch_assoc( $result );
  
}

include( 'includes/header.php' );

?>

<h2>Edit Experience</h2>

<form method="post">
  
  <label for="company_name">Company Name:</label>
  <input type="text" name="company_name" id="company_name" value="<?php echo htmlentities( $record['company_name'] ); ?>">
    
  <br>
  
  <label for="position">Position:</label>
  <input type="text" name="position" id="position" value="<?php echo htmlentities( $record['position'] ); ?> ">
   
  <br>
  
  <label for="job_role">Job_role:</label>
  <input type="text" name="job_role" id="job_role" value="<?php echo htmlentities( $record['job_role'] ); ?>">
    
  <br>
  
  <label for="start_date">Join Date:</label>
  <input type="date" name="start_date" id="start_date" value="<?php echo htmlentities( $record['start_date'] ); ?>">
  
  <label for="end_date">End Date:</label>
  <input type="date" name="end_date" id="end_date" value="<?php echo htmlentities( $record['end_date'] ); ?>">
      
  <br>
  
  <input type="submit" value="Edit Experience">
  
</form>

<p><a href="experience.php"><i class="fas fa-arrow-circle-left"></i> Return to Experience List</a></p>


<?php

include( 'includes/footer.php' );

?>