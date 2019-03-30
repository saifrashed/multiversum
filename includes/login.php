<?php
/**
 * User: saifeddine
 * Date: 2019-03-25
 * Time: 15:09
 */

session_start();


include '../classes/user.php';
$user = new User();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = cleanse($_POST['email']);
    $password  = cleanse($_POST['password']);
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


/**
 * Form validation
 */

$user->loginUser($email, $password);
