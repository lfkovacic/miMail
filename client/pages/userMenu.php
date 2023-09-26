<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="styles/homepage.css">
    <link rel="stylesheet" href="styles/common.css">
    <title>Homepage</title>
</head>

<body>
    <<div class="content">
        <?php include('../elements/header.php'); ?>
        <div class="table-container">
            <table id="table-user-detail">
                <tbody>
                    <tr>
                        <th>Korisničko ime</th>
                        <th>Adresa stanovanja</th>
                        <th>Broj telefona</th>
                        <th>E-mail adresa</th>
                        <th>OIB</th>
                        <th>Slika</th>
                    </tr>
                    <tr class="table-data-container" id="table-data-container"></tr>
                </tbody>
            </table>
        </div>
        <div class="form-container">
            <form id="login-form" enctype="multipart/form-data">
                <div class="input-container">
                    <label for="input-drzava">drzava</label>
                    <select id="input-drzava" name="drzava">
                        
                    </select>
                </div>
                <div class="input-container">
                    <label for="input-adresa">adresa</label>
                    <input id="input-adresa" name="adresa" type="text" />
                </div>
                <div class="input-container">
                    <label for="input-kucni-broj">kućni broj</label>
                    <input id="input-kucni-broj" name="kucni-broj" type="text" />
                </div>
                <div class="input-container">
                    <label for="input-grad">grad</label>
                    <input id="input-grad" name="grad" type="text" />
                </div>
                <div class="input-container">
                    <label for="input-postanski-broj">poštanski broj</label>
                    <input id="input-postanski-broj" name="postanski-broj" type="text" />
                </div>
                <div class="input-container">
                    <label for="input-broj-telefona">broj telefona</label>
                    <input id="input-broj-telefona" name="broj-telefona" type="text" />
                </div>
                <div class="input-container">
                    <label for="input-email-adresa">e-mail adresa</label>
                    <input id="input-email-adresa" name="email-adresa" type="text" />
                </div>
                <div class="input-container">
                    <label for="input-oib">OIB</label>
                    <input id="input-oib" name="oib" type="text" />
                </div>
                <div class="input-container">
                    <label for="input-image">Učitaj sliku</label>
                    <input id="input-image" name="image" type="file" />
                </div>
                <div id="btns-container" class="btns-container">
                    <button id="upisi-button" type="button">Upiši</button>
                    <button id="odustani-button" type="button">Odustani</button>
                </div>
            </form>
        </div>
        <?php include('../elements/footer.php'); ?>
        </div>
        <script type="module" src="./script/userDetails.js" defer></script>

</body>

</html>