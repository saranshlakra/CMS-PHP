<?php

include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

secure(); // checking user

if (isset($_GET['delete'])) {

  $query = 'DELETE FROM experience
    WHERE id = ' . $_GET['delete'] . '
    LIMIT 1';
  mysqli_query($connect, $query);

  set_message('Experience has been deleted');

  header('Location: experience.php');
  die();
}

include('includes/header.php');

$query = 'SELECT *
  FROM experience ORDER BY start_date DESC';

$result = mysqli_query($connect, $query);

?>

<h2>Manage Experience</h2>

<table>  <!-- display table -->
  <tr> 
    <th>Company Logo</th>
    <th align="center">Company Name</th>
    <th align="left">Position</th>
    <th align="left">Job Role</th>
    <th align="center">Join Date</th>
    <th align="center">End Date</th>
    <th align="center"></th>
    <th></th> <!--  for photo -->
    <th></th> <!-- for edit -->
    <th></th> <!--for delete -->
    
  </tr>
  <?php while ($record = mysqli_fetch_assoc($result)) : ?>
    <tr>
      <td align="center">
        <img src="image.php?type=experience&id=<?php echo $record['id']; ?>&width=300&height=300&format=inside">
      </td>
      <td align="center"><?php echo $record['company_name']; ?></td>
      <td align="left">
        <small><?php echo $record['position']; ?></small>
      </td>
      <td align="center"><?php echo $record['job_role']; ?></td>
      <td align="center" style="white-space: nowrap;"><?php echo htmlentities($record['start_date']); ?></td>
      <td align="center" style="white-space: nowrap;"><?php echo htmlentities($record['end_date']); ?></td>
      <td align="center"><a href="experience_photo.php?id=<?php echo $record['id']; ?>"><span class="material-symbols-outlined icons">
            add_a_photo
          </span></a></td>
      <td align="center"><a href="experience_edit.php?id=<?php echo $record['id']; ?>"><span class="material-symbols-outlined edit-icon icons">
            edit_note
          </span></a></td>
      <td align="center">
        <a href="experience.php?delete=<?php echo $record['id']; ?>" onclick="javascript:confirm('Are you sure you want to delete this experience?');"><span class="material-symbols-outlined icons delete-icon">
            delete_sweep
          </span></a>
      </td>
    </tr>
  <?php 
endwhile; 
?>
</table>

<p><a href="experience_add.php"><i class="fas fa-plus-square"></i> Add experience</a></p>


<?php

include('includes/footer.php');

?>