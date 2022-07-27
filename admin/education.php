<?php

include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

secure();

if (isset($_GET['delete'])) {

  $query = 'DELETE FROM education
    WHERE id = ' . $_GET['delete'] . '
    LIMIT 1';
  mysqli_query($connect, $query);

  set_message('Education record has been deleted');

  header('Location: education.php');
  die();
}

include('includes/header.php');

$query = 'SELECT * FROM education ORDER BY instituename DESC';
$result = mysqli_query($connect, $query);
// echo $result;
 //echo $query;

?>

<h2>Manage Education</h2>

<table>
  <tr>
    <th align="center">Institution Name</th>
    <th align="left">Location</th>
    <th align="center">Degree</th>
    <th align="center">Completion Date</th>
    <th align="center">Info</th>
    <th></th>
    <th></th>
  </tr>
  <?php while ($record = mysqli_fetch_assoc($result)) : ?>
    <tr>
      <td align="center"><?php echo $record['instituename']; ?></td>
      <td align="center"><?php echo $record['location']; ?></td>
      <td align="center" style="white-space: nowrap;"><?php echo htmlentities($record['degree']); ?></td>
      <td align="center"><?php echo $record['completedate']; ?></td>
      <td align="left">
        <?php echo $record['info']; ?>
      </td>
      <td align="center"><a href="education_edit.php?id=<?php echo $record['id']; ?>"><span class="material-symbols-outlined edit-icon icons">
            edit_note
          </span></a></td>
      <td align="center">
        <a href="education.php?delete=<?php echo $record['id']; ?>" onclick="javascript:confirm('Are you sure you want to delete this education details?');"><span class="material-symbols-outlined icons delete-icon">
            delete_sweep
          </span></a>
      </td>
    </tr>
  <?php endwhile; ?>
</table>

<p><a href="education_add.php"><i class="fas fa-plus-square"></i> Add Education</a></p>


<?php

include('includes/footer.php');

?>