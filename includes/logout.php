<?php
/**
 * User: saifeddine
 * Date: 2019-03-25
 * Time: 15:09
 */

include '../classes/user.php';

$user = new User;

$user->logoutUser();

echo "<script> location.href='../home.php?title=Home'; </script>";
