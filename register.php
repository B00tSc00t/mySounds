<?php
require("includes/config.php");
require("includes/classes/Account.php");
require("includes/classes/Constants.php");

$account = new Account($conn);

require("includes/handlers/register_handler.php");
require("includes/handlers/login_handler.php");

function getInputValue($name) {
    if(isset($_POST[$name])) {
        echo $_POST[$name];
    }
}

?>

<html>
<head>
  <title>Welcome to MySounds!</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="assets/css/register.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="assets/js/register.js"></script>
</head>
<body>
    <?php
    if(isset($_POST['registerButton'])) {
        echo '<script>
                $(document).ready(function() {
                    $("#loginForm").hide();
                    $("#registerForm").show();
                });
            </script>';
    } else {
        echo '<script>
                $(document).ready(function() {
                    $("#loginForm").show();
                    $("#registerForm").hide();
                });
            </script>';
    }
    ?>

    <div id="background">
        <div id="loginContainer">
            <div id="inputContainer">
                <form id="loginForm" action="register.php" method="post">
                    <h2>Login to your account</h2>
                    <p>
                        <?php echo $account->getError(Constants::$loginFailed); ?>
                        <label for="loginUsername">Username: </label>
                        <input id="loginUsername" name="loginUsername" type="text" placeholder="e.g. Bootscoot" value="<?php getInputValue('loginUsername'); ?>" autofocus="autofocus" required>
                    </p>
                    <p>
                        <label for="loginPassword">Password: </label>
                        <input id="loginPassword" name="loginPassword" type="password"  placeholder="Your password" required>
                    </p>

                    <button type="submit" name="loginButton">Log In</button>

                    <div class="hasAccountText">
                        <span id="hideLogin">Already have an account yet? Login here.</span>
                    </div>
                </form>

                <form id="registerForm" action="register.php" method="post">
                    <h2>Create your free account</h2>
                    <p>
                        <?php echo $account->getError(Constants::$usernameLength); ?>
                        <?php echo $account->getError(Constants::$usernameTaken); ?>
                        <label for="username">Username: </label>
                        <input id="username" name="username" type="text" placeholder="e.g. Bootscoot" value="<?php getInputValue('username'); ?>" required>
                    </p>

                    <p>
                        <?php echo $account->getError(Constants::$firstNameLength); ?>
                        <label for="firstName">First name: </label>
                        <input id="firstName" name="firstName" type="text" placeholder="e.g. Boot" value="<?php getInputValue('firstName'); ?>"required>
                    </p>

                    <p>
                        <?php echo $account->getError(Constants::$lastNameLength); ?>
                        <label for="lastName">Last name: </label>
                        <input id="lastName" name="lastName" type="text" placeholder="e.g. Scoot" value="<?php getInputValue('lastName'); ?>"required>
                    </p>

                    <p>
                        <?php echo $account->getError(Constants::$emailMatch); ?>
                        <?php echo $account->getError(Constants::$emailInvalid); ?>
                        <?php echo $account->getError(Constants::$emailTaken); ?>
                        <label for="email">Email: </label>
                        <input id="email" name="email" type="email" placeholder="e.g. bootscoot@gmail.com" value="<?php getInputValue('email'); ?>"required>
                    </p>

                    <p>
                        <label for="email2">Confirm email: </label>
                        <input id="email2" name="email2" type="email" placeholder="e.g. bootscoot@gmail.com" value="<?php getInputValue('email2'); ?>"required>
                    </p>

                    <p>
                        <?php echo $account->getError(Constants::$passwordsDoNotMatch); ?>
                        <?php echo $account->getError(Constants::$passwordNotAlphanumeric); ?>
                        <?php echo $account->getError(Constants::$passwordLength); ?>
                        <label for="password">Password: </label>
                        <input id="password" name="password" type="password"  placeholder="Your password" required>
                    </p>

                    <p>
                        <label for="password2">Confirm password: </label>
                        <input id="password2" name="password2" type="password" placeholder="Your password" required>
                    </p>

                    <button type="submit" name="registerButton">Sign Up!</button>

                    <div class="hasAccountText">
                        <span id="hideRegister">Don't have an account yet? Signup here.</span>
                    </div>
                </form>
            </div>
            
            <div id="loginText">
                <h1>
                    Get great music!
                </h1>
                <h2>
                    Listen to songs for free!
                </h2>
                <ul>
                    <li>Discover music</li>
                    <li>Create your own playlist</li>
                    <li>Follow artists</li>
                </ul>
            </div>
        </div>
    </div>

</body>
</html>