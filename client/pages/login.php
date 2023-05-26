<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="styles/login.css">
    <link rel="stylesheet" href="styles/common.css">
    <title>Login</title>
</head>

<body>
    <div class="content">
        <?php include('../elements/header.php'); ?>
        <div class="form-container">
            <form id="login-form">
                <div class="input-container">
                    <label for="input-username">Username</label>
                    <input id="input-username" name="username" type="text" />
                </div>
                <div class="input-container">
                    <label for="input-password">Password</label>
                    <input id="input-password" name="password" type="password" />
                </div>
                <div id="btns-container" class="btns-container">
                    <button id="login-button" type="button">Login</button>
                    <button id="register-button" type="button">Register</button>
                </div>
            </form>
        </div>
        <?php include('../elements/footer.php'); ?>
    </div>
    <script type="module" src="./script/login.js" defer></script>

    


</body>

</html>