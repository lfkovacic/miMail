import { RELATIVE_URL } from "../../consts/consts.js";

const loginButton = document.getElementById("login-button");
const fLogin = () => {
  console.log("test");
  window.location.href = RELATIVE_URL+"/homepage.php";
}
loginButton.addEventListener("click", fLogin);