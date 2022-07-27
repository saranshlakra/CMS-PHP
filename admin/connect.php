<?php

include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

secure();

if (isset($_GET['delete'])) {

  $query = 'DELETE FROM connect
    WHERE id = ' . $_GET['delete'] . '
    LIMIT 1';
  mysqli_query($connect, $query);

  set_message('Connection has been deleted');

  header('Location: connect.php');
  die();
}

include('includes/header.php');

$query = 'SELECT *
  FROM connect
  ORDER BY title DESC';
$result = mysqli_query($connect, $query);

?>

<h2>Manage Connection</h2>

<table>
  <tr>
    <th></th>
    <th align="left">Title</th>
    <th align="center">Link</th>
    <th></th>
    <th></th>
    <th></th>
  </tr>
  <?php while ($record = mysqli_fetch_assoc($result)) : ?>
    <tr>
      <td align="center">
        <img src="image.php?type=connect&id=<?php echo $record['id']; ?>&width=300&height=300&format=inside">
      </td>
      <td align="center"><?php echo $record['title']; ?></td>
      <td align="left">
        <?php echo $record['link']; ?>
      </td>
      <td align="center"><a href="connect_photo.php?id=<?php echo $record['id']; ?>"><span class="material-symbols-outlined icons">
            add_a_photo
          </span></a></td>
      <td align="center"><a href="connect_edit.php?id=<?php echo $record['id']; ?>"><span class="material-symbols-outlined edit-icon icons">
            edit_note
          </span></a></td>
      <td align="center">
        <a href="connect.php?delete=<?php echo $record['id']; ?>" onclick="javascript:confirm('Are you sure you want to delete this connection?');"><span class="material-symbols-outlined icons delete-icon">
            delete_sweep
          </span></a>
      </td>
    </tr>
  <?php endwhile; ?>
</table>

<p><a href="connect_add.php"><i class="fas fa-plus-square"></i> Add Connection</a></p>


<?php

include('includes/footer.php');

?>