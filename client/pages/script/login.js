import { RELATIVE_URL } from "../../consts/consts.js";
import { loginService } from "../../api/loginService.js";


let registerMode = false;

const loginButton = document.getElementById("login-button");
const fLogin = () => {
  console.log("test");
  window.location.href = RELATIVE_URL + "/homepage.php";
}
loginButton.addEventListener("click", fLogin);

const registerButton = document.getElementById("register-button");
console.log("registerButton:", registerButton);
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
  userObj.username = username;
  userObj.password = password;

  loginService.submitUserRegister(userObj)
    .then((response) => {
      console.log(response);
    })
    .catch((error) => {
      console.error(error);
    });
}

registerButton.addEventListener("click", fRegister);