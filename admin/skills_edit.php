<?php
// including required modules
include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

// check if user is logged in before accessing /skills.php
secure();

// common header file
include('includes/header.php');

// checking if we got any id, if not we will not load this page and redirect to list page again
if (!isset($_GET['id'])) {
    header('Location: skills.php');
    die();
}
// getting data for id which we want edit
else {
    $query = 'SELECT * FROM skills WHERE id=' . $_GET['id'] . ' LIMIT 1';

    $result = mysqli_query($connect, $query);

    if (!mysqli_num_rows($result)) {
        header('Location: skills.php');
        die();
    }

    $record = mysqli_fetch_assoc($result);
}

// updating table if there is edit
if(isset($_POST['title'])){
    if($_POST['title'] and $_POST['level']){
        $query = 'UPDATE skills SET 
        title="'.mysqli_real_escape_string( $connect, $_POST['title'] ).'",
        level="'.$_POST['level'].'"
        WHERE id='.$_GET['id'].'
        LIMIT 1';

        mysqli_query($connect,$query);
        set_message('Skill has been updated');
    }

    header('Location: skills.php');
    die();
}
?>

<!-- editing form (html) -->
<h2>Edit Skills</h2>

<form method="post">
    <label for="skill_title">Skill Name:</label>
    <input type="text" name="title" id="skill_title" value="<?= $record['title'] ?>">
    <br>

    <label for="skill_level">Skill level:</label>
    <input type="range" name="level" id="skill_level" value="<?= $record['level'] ?>">
    <br>

    <button type="submit">Edit Skill</button>
</form>

<p><a href="skills.php"><i class="fas fa-arrow-circle-left"></i>Return to Skills List</a></p>