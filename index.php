<?php
/**
 * Created by PhpStorm.
 * User: olatundeowokoniran
 * Date: 12/21/16
 * Time: 10:44 PM
 *
 * session as to com first
 */
session_start();// Starting Session
include_once("inc/database_connection.php"); //database connection
include_once("inc/prep_functions.php");
/**
 * Using “isset”
 *You can use the “isset” function on any variable to determine if it has been set or not.
 * You can use this function on the $_POST array to determine if the variable was posted or not.
 * This is often applied to the submit button value, but can be applied to any variable.
 */

$error = ''; // Variable To Store Error Message

if (isset($_POST['submit'])) {
    if (empty($_POST['email']) || empty($_POST['email'])) {
        $error = "Email or Password is invalid";
    } else {
        // Define $username and $password
        $email = $_POST['email'];
        $password = $_POST['password'];

    //    echo("First name: " . $_POST['email'] . "<br />\n");
    //    echo("Last name: " . $_POST['password'] . "<br />\n");

        // To protect MySQL injection for Security purpose
        $email = stripslashes($email);
        $password = stripslashes($password);
        $username = mysqli_real_escape_string($conn, $email);
        $password = mysqli_real_escape_string($conn, $password);

        // SQL query to fetch information of registerd users and finds user match.
        $query = "SELECT * FROM users WHERE password='".$password."' AND email='".$email."'";
        $result = mysqli_query($conn, $query);
        $rows = mysqli_num_rows($result);

        if ($rows == 1) {
            $_SESSION['login_user'] = $email; // Initializing Session
            header("location: profile.php"); // Redirecting To Other Page
        } else {
            $error = "Email or Password is invalid";
        }
    }
}

?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Bootstrap 101 Template</title>

        <!-- Bootstrap -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/css/style.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
    <div class="container">

        <!--
        login system.

        form action is "" just because i wanted it to post to the same page
        and method is set to POST
        -->
        <form class="form-signin" action="" method="post">

            <!--
            showing error.

            trying to display error from anything that happens in the form below
            -->
            <?php if ($error && !empty($error)) { ?>
                <div class="alert text-center">
                    <div class="alert alert-warning">
                        <?php echo $error; ?>
                    </div>
                </div>
            <?php } ?>

            <h2 class="form-signin-heading">Please sign in</h2>
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address"
                   required=""
                   autofocus="">
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" name="password" class="form-control" placeholder="**********"
                   required="">

            <input type="submit" name="submit" class="btn btn-lg btn-primary btn-block" value="Sign in"/>
            <p>need an account? <a href="create_account.php" >Sign Up</a> </p>
        </form>

        <!--    login system-->

    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/js/bootstrap.min.js"></script>
    </body>
    </html>


<?php
/**
 * This most be done after database MYSQL as been opened it also needs to be closed
 */
$conn->close();
?>