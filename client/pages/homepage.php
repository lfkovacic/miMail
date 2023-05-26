<!DOCTYPE html>
<html></html>

<head><link rel="stylesheet" href="styles/homepage.css">
    <link rel="stylesheet" href="styles/common.css">
    <title>Homepage</title>
</head>

<body>
    <div class="menu"></div> 
    <div class="content">
        <?php include('../elements/header.php'); ?>
        <div class="filter"></div>
        <div class="prikaz"></div>
        <?php include('../elements/footer.php'); ?> 
    </div>
    <div class="sidebar">
        <select>
            <option value="option1">A</option>
            <option value="option2">B</option>
            <option value="option3">C</option>
        </select>
    </div>

    <div class="content">
        <?php include('../elements/header.php'); ?>
        <div class="filter"></div>
        <div class="prikaz"></div>
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
    <div class="content">
        <?php include('../elements/header.php'); ?>
        <div class="filter"></div>
        <div class="prikaz"></div>
        <?php include('../elements/footer.php'); ?>
    </div>

    
</body>
        