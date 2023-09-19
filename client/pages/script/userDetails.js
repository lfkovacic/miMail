import { RELATIVE_URL } from "../../consts/consts.js";
import { loginService } from "../../api/loginService.js";
import { uploadFile } from "../../util/helper.js";

const detailsTable = document.getElementById("table-data-container");

const userDetailsData = await loginService.getUserDetails(await loginService.getUserId());

const userDetailsArr = [];
for (const key in userDetailsData) userDetailsArr.push(userDetailsData[0][key]);
console.log(userDetailsArr);
const row = document.createElement("tr");
detailsTable.appendChild(row)
for (const value of userDetailsArr) {
    const column = document.createElement("td");
    column.innerHTML = value;
    row.appendChild(column);
}

const upisiButton = document.getElementById("upisi-button");
const fSubmit = async () => {
    try {
        const userId = await loginService.getUserId();
        const fileInput = document.getElementById("input-image");
        const file = fileInput.files[0];

        const base64Str = await uploadFile("test", "jpg", file);
        console.log(userId);

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
        console.log(userObj);
        const res = await loginService.insertUserDetails(userObj);
        console.log(res);
    }

    catch (error) {
        console.error(error);
    }

}

upisiButton.addEventListener("click", fSubmit);
const getValueFromInput = (id) => {
    console.log(id);
    const input = document.getElementById(id);
    return input.value;
}

