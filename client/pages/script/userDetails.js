import { RELATIVE_URL } from "../../consts/consts.js";
import { loginService } from "../../api/loginService.js";
import { processPassword, getPasswordArray } from "../../util/util.js";
import { Cookie } from "../../util/cookies.js";
import { uploadFile } from "../../util/helper.js";

const upisiButton = document.getElementById("upisi-button");
const fSubmit = async () => {
    try {
        const userId = await loginService.getUserId();
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
        image: uploadFile("test", "png", document.getElementById("input-image").files[0])
    };
    console.log (userObj);
    const res = await loginService.insertUserDetails(userObj);
    console.log (res);
}

catch (error) {
    console.error (error);
}

}

upisiButton.addEventListener("click", fSubmit);
const getValueFromInput = (id) => {
    console.log (id);
    const input = document.getElementById (id);
    return input.value;
}

