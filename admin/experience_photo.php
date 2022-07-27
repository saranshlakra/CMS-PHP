<?php

include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

secure(); // checking user

if (!isset($_GET['id'])) {

  header('Location: experience.php');
  die();
}

if (isset($_FILES['photo'])) {

  if (isset($_FILES['photo'])) {

    if ($_FILES['photo']['error'] == 0) {

      switch ($_FILES['photo']['type']) {
        case 'image/png': // for storing png image
          $type = 'png';
          break;

        case 'image/jpg': // for storing jpeg/jpg image
        case 'image/jpeg':
          $type = 'jpeg';
          break;

        case 'image/gif': // for storing gif image
          $type = 'gif';
          break;
      }

      $query = 'UPDATE experience SET photo = "data:image/' . $type . ';base64,' . base64_encode(file_get_contents($_FILES['photo']['tmp_name'])) . '"
        WHERE id = ' . $_GET['id'] . '
        LIMIT 1';
      mysqli_query($connect, $query);
    }
  }

  // showing message to admin
  set_message('Experience photo has been updated');

  header('Location: experience.php');
  die();
}


if (isset($_GET['id'])) {

  if (isset($_GET['delete'])) {

    $query = 'UPDATE experience SET
      photo = ""
      WHERE id = ' . $_GET['id'] . '
      LIMIT 1';
    $result = mysqli_query($connect, $query);

  // showing message to admin
    set_message('Experience photo has been deleted');

    header('Location: experience.php');
    die();
  }

  $query = 'SELECT *
    FROM experience
    WHERE id = ' . $_GET['id'] . '
    LIMIT 1';
  $result = mysqli_query($connect, $query);

  if (!mysqli_num_rows($result)) {

    header('Location: experience.php');
    die();
  }

  $record = mysqli_fetch_assoc($result);
}

include('includes/header.php');

include 'includes/wideimage/WideImage.php'; // for storing images

?>

<h2>Edit Company Logo</h2>

<p>
  For best results photos should be approximately 800 x 800 pixels.
</p>

<?php 
if ($record['photo']) : 
?>

  <?php

  $data = base64_decode(explode(',', $record['photo'])[1]);
  $img = WideImage::loadFromString($data);
  $data = $img->resize(200, 200, 'outside')->crop('center', 'center', 200, 200)->asString('jpg', 70);

  ?>
  <p><img src="data:image/jpg;base64,<?php echo base64_encode($data); ?>" width="200" height="200"></p>
  <p><a href="experience_photo.php?id=<?php echo $_GET['id']; ?>&delete"><i class="fas fa-trash-alt"></i> Delete this Photo</a></p>

<?php 
endif; 
?>

<form method="post" enctype="multipart/form-data">

  <label for="photo">Photo:</label>
  <input type="file" name="photo" id="photo">

  <br>

  <input type="submit" value="Save Photo">

</form>

<p><a href="experience.php"><i class="fas fa-arrow-circle-left"></i> Return to Experience List</a></p>


<?php

include('includes/footer.php');

?>