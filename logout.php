<?php
session_start();
/**
 * Created by PhpStorm.
 * User: olatundeowokoniran
 * Date: 12/22/16
 * Time: 10:37 PM
 */

if(session_destroy()) // Destroying All Sessions
{
    header("Location: index.php"); // Redirecting To Home Page
}
?>