<!DOCTYPE html>
<html>

<head>
    <title>Data Page</title>
</head>

<body>
    <center>
        <?php


        $conn = mysqli_connect(
            "localhost",
             "root", 
             "", 
             "cms_portfolio"
        );

        // Check connection
        if ($conn === false) {
            die("ERROR: Could not connect. "
                . mysqli_connect_error());
        }

        // geting values from form data
        $user_name1 = $_REQUEST['user_name1'];
        $user_email = $_REQUEST['user_email'];
        $message = $_REQUEST['message'];
    
        $sql = "INSERT INTO messages  VALUES ('$user_name1',
			'$user_email','$message')";

        if (mysqli_query($conn, $sql)) {
            echo "<h3>data stored in a database successfully."
                . " Please browse your localhost php my admin"
                . " to view the updated data</h3>";

            echo nl2br("\n $user_name1\n "
                . "$user_email\n $message\n $datetime");
        } else {
            echo "ERROR: oops! Sorry $sql. "
                . mysqli_error($conn);
        }

        mysqli_close($conn);
        ?>
    </center>
</body>

</html>