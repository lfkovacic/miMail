import { RELATIVE_URL } from "../../consts/consts.js";
import { mailService } from "../../api/mailService.js";
import { Cookie } from "../../util/cookies.js";

const sendMailButton = document.getElementById("send-mail-button");
const fSendMail = () => {
    const mailObj = {};
    const recipient = document.getElementById('input-recipient').value;
    const subject = document.getElementById('input-subject').value;
    const content = document.getElementById('input-content').value;

    mailObj.sender = Cookie.get("username")+'@mimail.org';
    mailObj.recipient = recipient;
    mailObj.subject = subject;
    mailObj.content = content;    

    if (!(recipient === "" || subject === "" || content === "")) {
        mailService.sendMail(mailObj)
            .then((response) => {
                console.log(response);
            }).catch((error) => {
                console.log(error);
            });
    }    
}
sendMailButton.addEventListener("click", fSendMail);