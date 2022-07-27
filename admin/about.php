<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

if( isset( $_GET['delete'] ) )
{
  
  $query = 'DELETE FROM about WHERE id = '.$_GET['delete'].' LIMIT 1';

  mysqli_query( $connect, $query );
  
  set_message( 'About has been deleted' ); // informing admin
  
  header( 'Location: about.php' ); // redirecting to about page
  die();
  
}

include( 'includes/header.php' );

$query = 'SELECT * FROM about ORDER BY tagline DESC';

$result = mysqli_query( $connect, $query );

?>

<h2>Manage about</h2>

<!-- diplaying table -->
<table>
  <tr>
    <th>Display Photo</th>
    <th align="center">Tagline</th>
    <th align="left">Description</th>
    <th align="center"></th>
    <th></th>
    <th></th>
    <th></th>
  </tr>
  <?php while( $record = mysqli_fetch_assoc( $result ) ): ?>
    <tr>
      <td align="center">
        <img src="image.php?type=about&id=<?php echo $record['id']; ?>&width=300&height=300&format=inside">
      </td>
      <td align="center"><?php echo $record['tagline']; ?></td>
      <td align="left">
        <small><?php echo $record['description']; ?></small>
      </td>
      <td align="center"><a href="about_photo.php?id=<?php echo $record['id']; ?>"><span class="material-symbols-outlined icons">
            add_a_photo
          </span></a></td>
      <td align="center"><a href="about_edit.php?id=<?php echo $record['id']; ?>"><span class="material-symbols-outlined edit-icon icons">
            edit_note
          </span></a></td>
      <td align="center">
        <a href="about.php?delete=<?php echo $record['id']; ?>" onclick="javascript:confirm('Are you sure you want to delete it?');"><span class="material-symbols-outlined icons delete-icon">
            delete_sweep
          </span></a>
      </td>
    </tr>
  <?php
 endwhile; 
 ?>
</table>

<p><a href="about_add.php"><i class="fas fa-plus-square"></i> Add About</a></p>


<?php

include( 'includes/footer.php' );

?>