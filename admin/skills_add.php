<?php
// including required modules
include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

// check if user is logged in before accessing /skills.php
secure();

// handling form submit
if (isset($_POST['title'])) {
    if ($_POST['title'] and $_POST['level']) {
        // insert query
        $query = 'INSERT INTO skills (title, level)
                VALUES(
                    "' . mysqli_real_escape_string($connect, $_POST['title']) . '",
                    "' . (int)$_POST['level']. '"
                )';
        mysqli_query($connect, $query);

        // echo $query;

        set_message('Skill has been added');
    }

    header('Location: skills.php');
    die();
}

// common header file
include('includes/header.php');
?>

<!-- adding skill form (html) -->
<h2>Add Skills</h2>

<form method="post">
    <label for="skill_title">Skill Name:</label>
    <input type="text" name="title" id="skill_title">
    <br>

    <label for="skill_level">Skill level:</label>
    <input type="range" name="level" id="skill_level">
    <br>

    <button type="submit">Add Skill</button>
</form>