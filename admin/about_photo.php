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

if( isset( $_FILES['photo'] ) )
{
  
  if( isset( $_FILES['photo'] ) )
  {
  
    if( $_FILES['photo']['error'] == 0 )
    {

      switch( $_FILES['photo']['type'] )
      {
        case 'image/png': 
          $type = 'png'; 
          break;

        case 'image/jpg':
        case 'image/jpeg':
          $type = 'jpeg'; 
          break;

        case 'image/gif': 
          $type = 'gif'; 
          break;      
      }

      $query = 'UPDATE about SET
        photo = "data:image/'.$type.';base64,'.base64_encode( file_get_contents( $_FILES['photo']['tmp_name'] ) ).'"
        WHERE id = '.$_GET['id'].' LIMIT 1';

      mysqli_query( $connect, $query );

    }
    
  }
  
  set_message( 'About photo has been updated' );
// echo $query; // for checking the bug
  header( 'Location: about.php' );
  die();
  
}


if( isset( $_GET['id'] ) )
{
  
  if( isset( $_GET['delete'] ) )
  {
    
    $query = 'UPDATE about SET  photo = "" WHERE id = '.$_GET['id'].' LIMIT 1';


    $result = mysqli_query( $connect, $query );
    
    set_message( 'About photo has been deleted' );
    
    header( 'Location: about.php' );
    die();
    
  }
  
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

include 'includes/wideimage/WideImage.php';

?>

<h2>Edit Display Photo</h2>

<p>photos should be approximately 800 x 800 pixels.</p>

<?php if( $record['photo'] ): ?>

  <?php

  $data = base64_decode( explode( ',', $record['photo'] )[1] );
  $img = WideImage::loadFromString( $data );
  $data = $img->resize( 200, 200, 'outside' )->crop( 'center', 'center', 200, 200 )->asString( 'jpg', 70 );

  ?>
  <p><img src="data:image/jpg;base64,<?php echo base64_encode( $data ); ?>" width="200" height="200"></p>
  <p><a href="about_photo.php?id=<?php echo $_GET['id']; ?>&delete"><i class="fas fa-trash-alt"></i> Delete this Photo</a></p>

<?php 
endif; 
?>

<form method="post" enctype="multipart/form-data">
  
  <label for="photo">Display Photo:</label>
  <input type="file" name="photo" id="photo">
  
  <br>
  
  <input type="submit" value="Save Photo">
  
</form>

<p><a href="about.php"><i class="fas fa-arrow-circle-left"></i> Return to About List</a></p>


<?php

include( 'includes/footer.php' );

?>