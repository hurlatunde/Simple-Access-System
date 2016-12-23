<?php
/**
 * Created by PhpStorm.
 * User: olatundeowokoniran
 * Date: 12/23/16
 * Time: 5:54 AM
 */
session_start();// Starting Session
include_once("inc/database_connection.php"); //database connection
include_once("inc/prep_functions.php");

$error = array(); // Variable To Store Error Message

if (isset($_POST['submit'])) {
    /**
     * This is to check if that data given is empty
     *
     * It's not strong but it will get the job done for now
     */
    if (empty($_POST['full_name']) || !isset($_POST['full_name'])) {
        $error[] = "Please enter a valid letter";
    }

    if (empty($_POST['email']) || !isset($_POST['email'])) {
        $error[] = "Email is invalid";
    }

    if (empty($_POST['password']) || !isset($_POST['password'])) {
        $error[] = "password need";
    }

    /**
     * One more level of error check
     */
    if (empty($error)) {

        $full_name = mysqli_real_escape_string($conn, stripslashes($_POST['full_name']));
        /**
         * trim
         * trim — Strip whitespace (or other characters) from the beginning and end of a string
         * http://php.net/manual/en/function.trim.php
         *
         * stripslashes
         * stripslashes — Un-quotes a quoted string
         * http://php.net/manual/en/function.stripslashes.php
         */
        $email = mysqli_real_escape_string($conn, stripslashes(trim($_POST['email'])));
        $password = mysqli_real_escape_string($conn, stripslashes(trim($_POST['password'])));

        /**
         * This is the best time to check if the user email is already on the system
         */
        $query = "SELECT * FROM users WHERE email='" . $email . "'";
        $result = mysqli_query($conn, $query);
        $rows = mysqli_num_rows($result);
        if ($rows != 1) {

            /**
             * getting the current datatime
             */
            $now = date("Y-m-d H:i:s");

            /**
             * this means that all is fine no error
             * and we can save the new user
             *
             * read more on SQL insert
             * http://www.w3schools.com/php/php_mysql_insert.asp
             */

            $sql = "INSERT INTO users (full_name, email, password, created) VALUES ('" . $full_name . "', '" . $email . "', '" . $password . "', '" . $now . "')";
            $result = mysqli_query($conn, $sql);
            //$rows = mysqli_num_rows($result);
            if ($result == 1) {
                $_SESSION['login_user'] = $email; // Initializing Session
                header('Location: profile.php'); // Redirecting To Home Page
            } else {
                $error[] = "Error saving user data";
            }
        } else {
            /**
             * this means that the email is already on the system
             */
            $error[] = "User with this email ( " . $email . " ) already exist on the system";
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

        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <!--
            showing error.

            trying to display error from anything that happens in the form below
            -->
                <?php if ($error && !empty($error)) { ?>
                    <div class="alert text-center">
                        <div class="alert alert-warning">
                            <?php foreach ($error as $e) {
                                echo $e;
                            } ?>
                        </div>
                    </div>
                <?php } ?>

                <form action="" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Full Name</label>
                        <input type="text" name="full_name" class="form-control" id="exampleInputEmail1" required
                               placeholder="User Full Name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" required
                               placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                               required placeholder="Password">
                    </div>
                    <input type="submit" name="submit" class="btn btn-default" value="Create account">
                </form>
            </div>
        </div>

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