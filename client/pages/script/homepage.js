import { RELATIVE_URL } from "../../consts/consts.js";
import { mailService } from "../../api/mailService.js";;
import { Cookie } from "../../util/cookies.js";
import { bodoviService } from "../../api/bodoviService.js";

const sendMailButton = document.getElementById("send-mail-button");
const fSendMail = () => {
    const mailObj = {};
    const recipient = document.getElementById('input-recipient').value;
    const subject = document.getElementById('input-subject').value;
    const content = document.getElementById('input-content').value;

    mailObj.sender = Cookie.get("username") + '@mimail.org';
    mailObj.recipient = recipient;
    mailObj.subject = subject;
    mailObj.body = content;

    if (!(recipient === "" || subject === "" || content === "")) {
        mailService.sendMail(mailObj)
            .then((response) => {
                console.log(response);
            }).catch((error) => {
                console.error(error);
            });
    }
}
sendMailButton.addEventListener("click", fSendMail);
let isMailFetched = false;
const fGetAllMail = () => {

    if (!isMailFetched) {
        const inbox = document.getElementById('option_inbox');
        const arr = [];
        mailService.getAllMail().then((response) => {
            for (const mail of response) {
                const mailDiv = document.createElement('div');
                mailDiv.id = mail.id;
                mailDiv.innerHTML = mail.subject;
                mailDiv.addEventListener('click', (e) => fGetMail(e))
                inbox.appendChild(mailDiv);
            }
        })
        isMailFetched = true;

    }
}
const fGetMail = (e) => {
    const id = e.target.id;
    mailService.getMail(parseInt(id)).then((response) => {
        const inputContainer = document.getElementById('input-container');
        inputContainer.className = 'hidden';
        const mailContainer = document.getElementById('mail-container');
        mailContainer.innerHTML = '';
        mailContainer.className = "mail-container";
        const fromDiv = document.createElement('div');
        const subjectDiv = document.createElement('div');
        const contentDiv = document.createElement('div');
        const spanFromDiv = document.createElement('span');
        const spanSubjectDiv = document.createElement('span');
        const spanContentDiv = document.createElement('span');
        fromDiv.id = 'from-div';
        subjectDiv.id = 'subject-div';
        contentDiv.id = 'content-div';
        spanFromDiv.innerHTML = 'Od: ';
        spanSubjectDiv.innerHTML = 'Predmet:';
        spanContentDiv.innerHTML = 'Sadržaj:'
        fromDiv.innerHTML = response.from;
        subjectDiv.innerHTML = response.subject;
        contentDiv.innerHTML = response.content;
        mailContainer.appendChild(spanFromDiv);
        spanFromDiv.appendChild(fromDiv);
        mailContainer.appendChild(spanSubjectDiv);
        spanSubjectDiv.appendChild(subjectDiv);
        mailContainer.appendChild(spanContentDiv);
        spanContentDiv.appendChild(contentDiv);

    })

}
const inbox = document.getElementById('option_inbox');
inbox.addEventListener('click', fGetAllMail);

const fShowComposeMail = () => {
    const inputContainer = document.getElementById('input-container');
    inputContainer.className = "input-container";
    const mailContainer = document.getElementById('mail-container');
    mailContainer.className = 'hidden';
}

const composeMail = document.getElementById('compose-mail');
composeMail.addEventListener('click', fShowComposeMail);

bodoviService.getClientIp().then(res=>{
    console.log(res);
    Cookie.set("ip", res.ip);
})

bodoviService.getClientCountry(Cookie.get("ip")).then(res=>{
    console.log(res);
})
