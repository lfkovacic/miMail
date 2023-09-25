import { RELATIVE_URL } from "../../consts/consts.js";
import XML from "../../util/XML.js";
import { loginService } from "../../api/loginService.js";
import { uploadFile, getImageFromBase64String } from "../../util/helper.js";
import { bodoviService } from "../../api/bodoviService.js";

const countryOptions = await bodoviService.getListOfCountries();
const countrySelect = document.getElementById('input-drzava');
for (const option of countryOptions.getElementsByTagName('tCountryCodeAndName')) {
    const name = option.getElementsByTagName('sName')[0].innerHTML;
    const code = option.getElementsByTagName('sISOCode')[0].innerHTML;
    const optionInput = document.createElement('option');
    optionInput.value = code;
    optionInput.innerHTML = name;
    countrySelect.appendChild(optionInput);
}

const getUserDetails = async () => {
    try {

        const detailsTable = document.getElementById("table-data-container");
        const userId = await loginService.getUserId();

        const res = await loginService.getUserDetails(userId);
        const userDetailsData = res;

        const userDetailsArr = [
            userDetailsData.USERNAME,
            userDetailsData.DRZAVA,
            userDetailsData.ADRESA_STANOVANJA,
            userDetailsData.KUCNI_BROJ==0?null:userDetailsData.KUCNI_BROJ,
            userDetailsData.GRAD,
            userDetailsData.POSTANSKI_BROJ==0?null:userDetailsData.POSTANSKI_BROJ,
            userDetailsData.BROJ_TELEFONA==0?null:userDetailsData.BROJ_TELEFONA,
            userDetailsData.E_MAIL_ADRESA,
            userDetailsData.OIB==0?null:userDetailsData.OIB,
            `<img src="${getImageFromBase64String(userDetailsData.IMAGE_BLOB)}"/>`
        ];
        for (const value of userDetailsArr) {
            const column = document.createElement("td");
            column.innerHTML = value;
            detailsTable.appendChild(column);
        }
    } catch (e) { console.error(e) }
}
getUserDetails();

const upisiButton = document.getElementById("upisi-button");
const fSubmit = async () => {
    try {
        const userId = await loginService.getUserId();
        const fileInput = document.getElementById("input-image");
        const file = fileInput.files[0];

        const base64Str = await uploadFile("test", "jpg", file);

        const userObj = {
            user_id: userId,
            drzava: getValueFromInput("input-drzava"),
            adresa: getValueFromInput("input-adresa"),
            kucni_broj: getValueFromInput("input-kucni-broj"),
            grad: getValueFromInput("input-grad"),
            postanski_broj: getValueFromInput("input-postanski-broj"),
            broj_telefona: getValueFromInput("input-broj-telefona"),
            email_adresa: getValueFromInput("input-email-adresa"),
            oib: getValueFromInput("input-oib"),
            image: base64Str
        };
        const res = await loginService.insertUserDetails(userObj);
    }

    catch (error) {
        console.error(error);
    }

}

upisiButton.addEventListener("click", fSubmit);
const getValueFromInput = (id) => {
    const input = document.getElementById(id);
    return input.value;
}

