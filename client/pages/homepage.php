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
            <div class = "table select" id = "compose-mail">Novi mail</div>
            <div class="table select" id="select_mail">
                <div class="inbox option" id="option_inbox">Inbox</div>
            </div>
        </div>

        <div class="content">
            <?php include('../elements/header.php'); ?>
            <div class="filter"></div>
            <div class="prikaz">
                <form>
                    <div class="input-container" id = "input-container"> 
                        <div class="input-container input-recipient">
                            <label for="input-recipient">Primatelj</label>
                            <input id="input-recipient" name="recipient" type="text" value="">
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
                    <div class = "hidden" id = "mail-container">
                    </div>
                </form>
            </div>
            <?php include('../elements/footer.php'); ?>
        </div>

        <div class="sidebarMenu">
            <a href="#" class="menu-button">Početna</a>
            <div class="sub-menu">
                <a href="#" class="sub-menu-button">O nama</a><br>
                <a href="#" class="sub-menu-button">Pretraga</a><br>
                <a href="#" class="sub-menu-button">Pomoć</a><br>
            </div>
            <a href="#" class="menu-button">Korisnik</a>
            <div class="sub-menu">
                <a href="#" class="sub-menu-button">Ispis</a><br>
                <a href="#" class="sub-menu-button">Spremi</a><br>
            </div>
            <a href="#" class="menu-button">O nama</a>
            <div class="sub-menu" id="inbox-submenu">
                <a href="#" class="sub-menu-button">Inbox</a><br>
            </div>
            <div class="sub-menu">
                <a href="#" class="sub-menu-button">Povijest</a><br>
                <a href="#" class="sub-menu-button">Vizija</a><br>
                <a href="#" class="sub-menu-button">Ideja</a><br>
                <a href="#" class="sub-menu-button">Kontakt</a><br>
            </div>
        </div>
    </div>

    <script type="module" src="./script/homepage.js" defer></script>
    <script>
        const optionSelect = document.getElementById("option-select");
        const inboxSubmenu = document.getElementById("inbox-submenu");