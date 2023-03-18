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
            <form>
                <div class="input-container">
                    <label for="input-username">Username</label><br>
                    <input id="input-username" name="username" type="text" />
                </div>
                <div>
                    <label for="input-password">Password</label><br>
                    <input id="input-password" name="password" type="password" />
                </div>
                <div class="btns-container">
                    <button id="login-button" type="button" onClick={fLogin()}>Login</button>
                    <button type="button" onClick={fRegister()}>Register</button>
                </div>
            </form>
        </div>
        <?php include('../elements/footer.php'); ?>
    </div>
    <script type="module" src="./script/login.js" defer></script>

</body>

</html>