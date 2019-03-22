<?php
/**
 * Created by PhpStorm.
 * User: saifeddine
 * Date: 2019-02-18
 * Time: 16:03
 */

require "./header.php";

?>


<h1> This feature is coming soon! </h1>

<div class="form">
    <form class="register-form">
        <input type="text" placeholder="name"/>
        <input type="password" placeholder="password"/>
        <input type="text" placeholder="email address"/>
        <button>create</button>
        <p class="message">Already registered? <a href="#">Sign In</a></p>
    </form>
    <form class="login-form">
        <input type="text" placeholder="username"/>
        <input type="password" placeholder="password"/>
        <button>login</button>
        <p class="message">Not registered? <a href="#">Create an account</a></p>
    </form>
</div>

<?php

require "./footer.php";

?>
