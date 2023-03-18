<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="styles/login.css">
    <link rel="stylesheet" href="styles/common.css">
    <script src="script/login.js"></script>
    <title>Login</title>
</head>

<body>
    <div class="content">
        <?php include('../elements/header.php'); ?>
        <div class="form-container">
            <form>
                <div class="input-container">
                    <label for="input-username">Username</label>
                    <input id="input-username" name="username" type="text" />
                </div>
                <div>
                    <label for="input-password">Password</label>
                    <input id="input-password" name="password" type="password" />
                </div>
                <div class="btns-container">
                    <button type="button" onClick={fLogin()}>Login</button>
                    <button type="button" onClick={fRegister()}>Register</button>
                </div>
            </form>
        </div>
        <?php include('../elements/footer.php'); ?>
    </div>
</body>

</html>