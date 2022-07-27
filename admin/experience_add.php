<?php

include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

secure();

if (isset($_POST['company_name'])) {

  if ($_POST['company_name']) {

    $query = 'INSERT INTO experience (company_name, position, job_role, start_date, end_date ) 
    VALUES 
    (
      "' . mysqli_real_escape_string($connect, $_POST['company_name']) . '",
      "' . mysqli_real_escape_string($connect, $_POST['position']) . '",
      "' . mysqli_real_escape_string($connect, $_POST['job_role']) . '",
      "' . mysqli_real_escape_string($connect, $_POST['start_date']) . '",
      "' . mysqli_real_escape_string($connect, $_POST['end_date']) . '"
    )';
    mysqli_query($connect, $query);
    // echo $query; // for debugging
    set_message('Experience has been added');
  }

  header('Location: experience.php');
  die();
}

include('includes/header.php');

?>

<h2>Add Experience</h2>

<form method="post">

  <label for="company_name">Company Name:</label>
  <input type="text" name="company_name" id="company_name">

  <br>

  <label for="position">Position:</label>
  <input type="text" name="position" id="position">

  <br>

  <label for="job_role">Job Role:</label>
  <input type="text" name="job_role" id="job_role">

  <br>

  <label for="start_date">Star Date:</label>
  <input type="date" name="start_date" id="start_date">

  <br>

  <label for="end_date">End Date:</label>
  <input type="date" name="end_date" id="end_date">

  <br>


  <input type="submit" value="Add Experience">

</form>

<p><a href="experience.php"><i class="fas fa-arrow-circle-left"></i> Return to Experience List</a></p>


<?php

include('includes/footer.php');

?>