<?php
/**
 * Created by PhpStorm.
 * User: saifeddine
 * Date: 2019-02-18
 * Time: 16:03
 */

require "./header.php";

if(isset($_GET['message'])) {
    $message = $_GET['message'];
}

?>

<div class="form">
    <h1> Welcome </h1>

    <form action='includes/registration.php' method='POST' class="register-form">
        <span class="registration-message"><?php echo $message ?></span>

        <input type="text" name="fname" placeholder="First name" maxlength="50"/>
        <input type="text" name='lname' placeholder="Last name" maxlength="50"/>
        <input type="password" name='password' placeholder="password" maxlength="50"/>
        <input type="email" name='email' placeholder="Email address" maxlength="50"/>
        <label> <input type="radio" name="gender" value="male"> Male</label>
        <label> <input type="radio" name="gender" value="female"> Female</label>

        <input type="text" name='city' placeholder="City" maxlength="50"/>
        <input type="text" name='street' placeholder="Street/Number" maxlength="50"/>
        <input type="text" name='postal' placeholder="XXXX00" maxlength="36"/>


        <button type="submit">Register</button>
        <p class="message">Already registered? <a id="login-toggle">Sign In</a></p>
    </form>

    <form class="login-form">
        <span class="login-message"><?php echo 'none'; ?></span>
        <input type="text" placeholder="Username"/>
        <input type="password" placeholder="Password"/>
        <button>Login</button>
        <p class="message">Not registered? <a id="login-toggle">Create an account</a></p>
    </form>
</div>

<?php

require "./footer.php";

?>
