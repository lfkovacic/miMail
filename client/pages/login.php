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
            </form>
        </div>
        <?php include('../elements/footer.php'); ?>
    </div>
</body>

</html>