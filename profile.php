<?php
include('inc/session.php');
/**
 * Created by PhpStorm.
 * User: olatundeowokoniran
 * Date: 12/22/16
 * Time: 10:23 PM
 */

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

        <?php if (!$userDetails) { ?>
            <!-- a small check -->
        <?php } else { ?>
            <address>
                <strong><?php echo $userDetails['full_name']; ?>, Inc.</strong><br>
                1355 Market Street, Suite 900<br>
                San Francisco, CA 94103<br>
                <abbr title="Phone">@:</abbr> <?php echo $userDetails['email']; ?> <br>
                <abbr title="Phone">*:</abbr> <?php echo $userDetails['password']; ?>
                <hr>
                <!--
                Date format

                http://php.net/manual/en/function.date.php
                -->
                <abbr title="Phone">*Created:</abbr> <?php echo date("F j, Y, g:i a", strtotime($userDetails['created'])); ?> <br>
            </address>
            <!-- Indicates a dangerous or potentially negative action -->
            <a href="/logout.php" class="btn btn-danger">Logout</a>
        <?php } ?>

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