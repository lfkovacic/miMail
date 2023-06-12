import { RELATIVE_URL } from "../../consts/consts.js";
import { mailService } from "../../api/mailService.js";

const sendMailButton = document.getElementById("send-mail-button");
const fSendMail = () => {
    const mailObj = {};
    const recipient = document.getElementById('input-recipient').value;
    const subject = document.getElementById('input-subject').value;
    const content = document.getElementById('input-content').value;

    mailObj.recipient = recipient;
    mailObj.subject = subject;
    mailObj.content = content;
    //TODO: impelentirati username
    mailObj.headers = "From: test@mimail.org";

    console.log(mailObj);

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