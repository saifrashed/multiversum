<?php
/**
 * User: saifeddine
 * Date: 2019-03-25
 * Time: 15:09
 */

include '../classes/user.php';
$user = new User();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($_POST['gender'] == 'male') {
        $_POST['gender'] = 0;
    } else {
        $_POST['gender'] = 1;
    }
    $firstName = cleanse($_POST['fname']);
    $lastName  = cleanse($_POST['lname']);
    $password  = cleanse($_POST['password']);
    $email     = cleanse($_POST['email']);
    $gender    = cleanse($_POST['gender']);
    $city      = cleanse($_POST['city']);
    $street    = cleanse($_POST['street']);
    $postal    = cleanse($_POST['postal']);
}

/**
 * Used to clean data.
 *
 * @param $data
 * @return string
 */
function cleanse($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    if ($data != $_POST['password']) {
        $data = strtolower($data);
    }

    return $data;
}


$user->createUser($firstName, $lastName, $password, $email, (int)$gender, $city, $street, $postal);


