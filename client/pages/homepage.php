<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="styles/homepage.css">
    <link rel="stylesheet" href="styles/common.css">
    <title>Homepage</title>
</head>

<body>
    <div class="main-wrapper">
        <div class="sidebar">
            <h3>ODABIR:</h3>
            <div class="table select" id="compose-mail">Novi mail</div>
            <div class="table select" id="select_mail">
                <div class="inbox option" id="option_inbox">Inbox</div>
                <div class="outbox option" id="option_outbox">Outbox</div>
                <div class="delete option" id="option_delete">Delete</div>

            </div>
        </div>

        <div class="content">
            <?php include('../elements/header.php'); ?>
            <div class="filter"></div>
            <div class="prikaz">  
                <button id="button-obrisi" type="button">Obriši</button>
                <form>
                    <div class="input-container" id="input-container">
                        <div class="input-container input-recipient">
                            <label for="input-recepient">Primatelj</label>
                            <input id="input-recepient" name="recepient" type="text" value="">
                        </div>
                        <div class="input-container input-subject">
                            <label for="input-subject">Subjekt</label>
                            <input id="input-subject" name="subject" type="text" value="">
                        </div>
                        <div class="input-container input-content">
                            <label for="input-content">Sadržaj</label>
                            <textarea id="input-content" name="content" rows="20" cols="50"></textarea>
                        </div>
                        <div class="input-container input-button">
                            <button id="send-mail-button" type="button">Pošalji</button>
                        </div>
                    </div>
                    <div class="hidden" id="mail-container">
                    </div>

                </form>
            </div>
            <?php include('../elements/footer.php'); ?>
        </div>

        <div class="sidebarMenu">

            <a href="/client/pages/login.php" class="menu-button">Povratak na prijavu</a><br><br>

            <a href="/client/pages/userMenu.php" class="menu-button">Korisnik</a>

        </div>
    </div>
    </div>

    <script type="module" src="./script/homepage.js" defer></script>
</body>