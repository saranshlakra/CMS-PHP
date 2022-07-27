<?php
// including required modules
include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

// check if user is logged in before accessing /skills.php
secure();

// common header file
include('includes/header.php');

// if this page is called for "delete" then below code will be run 1st before getting all row
// "delete" is parameter we will be getting from url
if (isset($_GET['delete'])) {
    $query = 'DELETE FROM skills WHERE id =' . $_GET['delete'] . ' LIMIT 1';

    mysqli_query($connect, $query);

    set_message('Skill got deleted');

    header('Location: skills.php');
    die();
}

// fetching data from database, skills table
$query = 'SELECT * FROM skills ORDER BY title';

// running query
$result = mysqli_query($connect, $query);
?>

<!-- outputting data (html) -->
<h2>Manage skills</h2>
<table>
    <tr>
        <th>Logo</th>
        <th>Title</th>
        <th>Level</th>
        <!-- edit photo -->
        <th></th>
        <!-- edit -->
        <th></th>
        <!-- delete -->
        <th></th>
    </tr>
    <!-- traversing data from result -->
    <?php while ($record = mysqli_fetch_assoc($result)) { ?>

        <tr>
            <!-- logo -->
            <td align="center">
                <img src="image.php?type=skill&id=<?= $record['id'] ?>&width=100&height=100&format=inside">
            </td>
            <!-- skill title -->
            <td align="center"><?= $record['title'] ?></td>
            <!-- skill level -->
            <td align="center"><?= $record['level'] ?></td>

            <!-- edit photo button -->
            <td align="center">
                <a href="skills_photo.php?id=<?= $record['id'] ?>"><span class="material-symbols-outlined icons">
                        add_a_photo
                    </span></a>
            </td>
            <!-- edit skill button -->
            <td align="center">
                <a href="skills_edit.php?id=<?= $record['id'] ?>"><span class="material-symbols-outlined edit-icon icons">
                        edit_note
                    </span></a>
            </td>
            <!-- delete skill button : delete code is in this file itself as no need to go to other page -->
            <td align="center">
                <a href="skills.php?delete=<?= $record['id'] ?>" onclick="javascript:confirm('Are you sure you want to delete this project?');">
                    <span class="material-symbols-outlined icons delete-icon">
                        delete_sweep
                    </span>
                </a>
            </td>

        </tr>

    <?php } ?>
</table>

<!-- add a new skill -->
<p>
    <a href="skills_add.php">
        <i class="fas fa-plus-square"></i>Add Skill
    </a>
</p>

<!-- common footer file -->
<?php
include('includes/footer.php')
?>