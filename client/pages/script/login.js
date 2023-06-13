import { RELATIVE_URL } from "../../consts/consts.js";
import { loginService } from "../../api/loginService.js";
import { processPassword, getPasswordArray } from "../../util/util.js";
import { Cookie } from "../../util/cookies.js";


let registerMode = false;

const loginButton = document.getElementById("login-button");
const fLogin = async () => {
  const userObj = {};
  const username = document.getElementById('input-username').value;
  Cookie.set("username", username, 1);
  let password = document.getElementById('input-password').value;

  if (!(username === "" || password === "")) {
    userObj.username = username;
    userObj.passwordArr = await getPasswordArray(password);
    const response = await loginService.authenticateUser(userObj);
    if (response) {      
      Cookie.set("token", response, 1);
      window.location.href = RELATIVE_URL + "/homepage.php";          
    }
    else throw new Error("Pogrešni korisnički podatci!");

  }


  // window.location.href = RELATIVE_URL + "/homepage.php";
}
loginButton.addEventListener("click", fLogin);

const registerButton = document.getElementById("register-button");
const fRegister = () => {
  if (!registerMode) {
    let form = document.getElementById('login-form');
    let inputContainer = document.createElement('div');
    inputContainer.setAttribute('class', 'input-container');

    let inputRepeatPasswordLabel = document.createElement('label');
    inputRepeatPasswordLabel.setAttribute('for', 'input-repeat-password');
    inputRepeatPasswordLabel.innerHTML = "Repeat password";

    inputContainer.appendChild(inputRepeatPasswordLabel);

    let inputRepeatPassword = document.createElement('input');
    inputRepeatPassword.setAttribute('id', 'input-repeat-password');
    inputRepeatPassword.setAttribute('name', 'repeat-password');
    inputRepeatPassword.setAttribute('type', 'password');

    inputContainer.appendChild(inputRepeatPassword);

    form.appendChild(inputContainer);

    let buttons = document.getElementById('btns-container');
    form.removeChild(buttons);
    form.appendChild(buttons);

    registerMode = !registerMode;

  } else {
    console.log("Submitting form!");
    fSubmitRegister();
  }
}

const fSubmitRegister = async () => {
  const userObj = {};
  const username = document.getElementById('input-username').value;
  const password = document.getElementById('input-password').value;
  const password2 = document.getElementById('input-repeat-password').value;

  if (!(username === "" || password === "" || password2 === "") && (password === password2)) {
    userObj.username = username;
    userObj.password = await processPassword(password);
    loginService.submitUserRegister(userObj)
      .then((response) => {
        console.log(response);
      })
      .catch((error) => {
        console.error(error);
      });
  }
  else if (!(password === password2))

    console.error('Lozinke se ne poklapaju!');
  else
    console.error("Molimo popuniti sve podatke!")
}

registerButton.addEventListener("click", fRegister);