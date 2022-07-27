<?php
// including required modules
include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

// check if user is logged in before accessing /skills.php
secure();

// common header file
include('includes/header.php');

// checking if got any id to edit if not we will not render this page
if (!isset($_GET['id'])) {
    header('Location: skills.php');
    die();
}
// getting data from database for id which got from url
else {

    // if image is to be deleted and we have id as well
    if (isset($_GET['delete'])) {

        $query = 'UPDATE skills SET 
        photo = "" 
        WHERE id = ' . $_GET['id'] . ' 
        LIMIT 1';
        $result = mysqli_query($connect, $query);

        set_message('Skills photo has been deleted');

        header('Location: skills.php');
        die();
    }

    $query = 'SELECT * FROM skills WHERE id=' . $_GET['id'] . ' LIMIT 1';

    $result = mysqli_query($connect, $query);

    if (!mysqli_num_rows($result)) {
        header('LOcation: skills.php');
        die();
    }

    $record = mysqli_fetch_assoc($result);
}

// updating logo (when someone post new logo )
if (isset($_FILES['photo'])) {

    if ($_FILES['photo']['error'] == 0) {

        switch ($_FILES['photo']['type']) {
            case 'image/png':
                $type = 'png';
                break;
            case 'image/jpg':
            case 'image/jpeg':
                $type = 'jpeg';
                break;
            case 'image/gif':
                $type = 'gif';
                break;
        }

        $query = 'UPDATE skills SET 
        photo = "data:image/' . $type . ';base64,' . base64_encode(file_get_contents($_FILES['photo']['tmp_name'])) . '" 
        WHERE id = ' . $_GET['id'] . ' 
        LIMIT 1';

        // echo $query;
        mysqli_query($connect, $query);
    }

    set_message('Skills photo has been updated');

    header('Location: skills.php');
    die();
}


// including wideimage lib 
include 'includes/wideimage/WideImage.php';
?>

<!-- change or delete photo form (html) -->
<h2>Edit Skill Logo</h2>

<?php if ($record['photo']) {
    $data = base64_decode(explode(',', $record['photo'])[1]);
    $img = WideImage::loadFromString($data);
    $data = $img->resize(200, 200, 'outside')->crop('center', 'center', 200, 200)->asString('jpg', 70);
?>

    <p><img src="data:image/jpg;base64,<?= base64_encode($data); ?>" width="200" height="200"></p>
    <p><a href="skills_photo.php?id=<?= $_GET['id']; ?>&delete"><i class="fas fa-trash-alt"></i> Delete this Photo</a></p>

<?php } ?>

<form method="post" enctype="multipart/form-data">

    <label for="skill_logo">Photo:</label>
    <input type="file" name="photo" id="skill_logo">

    <br>

    <button type="submit">Add photo</button>

</form>

<p><a href="skills.php"><i class="fas fa-arrow-circle-left"></i> Return to Skills List</a></p>