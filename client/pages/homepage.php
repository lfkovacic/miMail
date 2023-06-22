<!DOCTYPE html>
<html>

</html>

<head>
    <link rel="stylesheet" href="styles/homepage.css">
    <link rel="stylesheet" href="styles/common.css">
    <title>Homepage</title>
</head>

<body>
    <div class="main-wrapper">

        <div class="sidebar">
            <h3>ODABIR:</h3>
            <select>
                <option value="option1">A</option>
                <option value="option2">B</option>
                <option value="option3">C</option>
            </select>
        </div>
        <div class="content">


            <?php include('../elements/header.php'); ?>
            <div class="filter"></div>
            <div class="prikaz">
                <form>
                    <div class="input-container">
                        <div class="input-container">
                            <label for="input-recipient">Primatelj</label>
                            <input id="input-recipient" name="recipient" type="text" value="">
                        </div>
                        <div class="input-container">
                            <label for="input-subject">Subjekt</label>
                            <input id="input-subject" name="subject" type="text" value="">
                        </div>
                        <div class="input-container">
                            <label for="input-content">Sadržaj</label>
                            <textarea id="input-content" name="content" rows="20" cols="50"></textarea>
                        </div>
                        <div class="input-container">
                            <button id="send-mail-button" type="button">Pošalji</button>
                        </div>
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
            <div class="sub-menu">
                <a href="#" class="sub-menu-button">Povijest</a><br>
                <a href="#" class="sub-menu-button">Vizija</a><br>
                <a href="#" class="sub-menu-button">Ideja</a><br>
                <a href="#" class="sub-menu-button">Kontakt</a><br>
            </div>
        </div>
    </div>
    <script type="module" src="./script/homepage.js" defer></script>



</body>