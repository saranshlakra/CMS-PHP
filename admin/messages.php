<?php
// including required modules
include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

// check if user is logged in before accessing /messages.php
secure();

// common header file
include('includes/header.php');

// if this page is called for "delete" then below code will be run 1st before getting all row
// "delete" is parameter we will be getting from url
if (isset($_GET['delete'])) {
    $query = 'DELETE FROM messages WHERE id =' . $_GET['delete'] . ' LIMIT 1';

    mysqli_query($connect, $query);

    set_message('message got deleted');

    header('Location: messages.php');
    die();
}

// fetching data from database, messages table
$query = 'SELECT * FROM messages ORDER BY datetime DESC';

// running query
$result = mysqli_query($connect, $query);
?>

<!-- outputting data (html) -->
<h2>Read messages</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>Message</th>
        <th></th>
        <th></th>
    </tr>
    <!-- traversing data from result -->
    <?php while ($record = mysqli_fetch_assoc($result)) { ?>

        <tr>
            <td align="center"><?= $record['id'] ?></td>
            <!-- Username -->
            <td align="center">
                <?= $record['user_name1'] ?>
            </td>
            <!-- User Email -->
            <td align="center"><?= $record['user_email'] ?></td>
            <!-- User message -->
            <td align="center">
                <small><?= $record['message'] ?></small>
            </td>

            <!-- Reply button -->
            <td align="center">
                <a href="mailto: <?= $record['user_email'] ?>">Reply</a>
            </td>
            <!-- delete message button : delete code is in this file itself as no need to go to other page -->
            <td align="center">
                <a href="messages.php?delete=<?= $record['id'] ?>" onclick="javascript:confirm('Are you sure you want to delete this message?');">
                    Delete
                </a>
            </td>

        </tr>

    <?php } ?>
</table>

<!-- common footer file -->
<?php
include('includes/footer.php')
?>