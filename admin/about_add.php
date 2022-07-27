<?php

include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

secure();

if (isset($_POST['tagline'])) {

  if ($_POST['tagline']) {

    $query = 'INSERT INTO about (tagline, description)
     VALUES 
     (
        "' . mysqli_real_escape_string($connect, $_POST['tagline']) . '",
         "' . mysqli_real_escape_string($connect, $_POST['description']) . '"
      )';
      
    mysqli_query($connect, $query);

    // echo $query;
    set_message('About has been added');
  }

  header('Location: about.php');
  die();
}

include('includes/header.php');

?>

<h2>Add About</h2>

<form method="post">

  <label for="company_name">Tagline:</label>
  <input type="text" name="tagline" id="tagline">

  <br>

  <label for="position">Description:</label>
  <input type="text" name="description" id="description">

  <br>

  <input type="submit" value="Add About">

</form>

<p><a href="about.php"><i class="fas fa-arrow-circle-left"></i> Return to About List</a></p>


<?php

include('includes/footer.php');

?>