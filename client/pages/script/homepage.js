
import { mailService } from "../../api/mailService.js";;
import { Cookie } from "../../util/cookies.js";
import { bodoviService } from "../../api/bodoviService.js";
import { getValueFromInput } from "../../util/helper.js";
import { loginService } from "../../api/loginService.js";
const sendMailButton = document.getElementById("send-mail-button");
const fSendMail = () => {
    const mailObj = {};

    const recipient = getValueFromInput("input-recepient");
    const subject = getValueFromInput("input-subject");
    const content = getValueFromInput("input-content");

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
const displayMailList = (res) => {
    const inbox = document.getElementById('option_inbox');
    inbox.innerHTML = "";

    for (const mail of res) {
        const mailDiv = document.createElement('div');
        mailDiv.id = mail.id;
        mailDiv.innerHTML = mail.subject;
        mailDiv.addEventListener('click', (e) => fGetMail(e))
        inbox.appendChild(mailDiv);
    }

}
const fGetAllMail = () => {

    if (!isMailFetched) {
        mailService.getAllMail().then((response) => {
            displayMailList(response);
        })
        isMailFetched = true;

    }
}
const fGetMail = (e) => {
    const id = e.target.id;
    Cookie.set('mail-id', id, 1);
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

bodoviService.getClientIp().then(res => {
    Cookie.set("ip", res.ip);
})


const fObrisi = () => {
    const id = Cookie.get('mail-id');
    console.log(mailService);
    if (id === undefined || !id) throw new Error('mail nije označen');
    else mailService.deleteMail(parseInt(id)).then(response => { console.log(response) })
}

const fPretrazi = () => {
    loginService.getUserId().then(id => {
        const keyword = getValueFromInput('input-keyword');
        console.log(`id:${id}, keyword:${keyword}`);
        const res = mailService.getMailByKeyWord(id, keyword).then(response => {
            displayMailList(response);
        });
    })
}

const obrisiButton = document.getElementById('button-obrisi');
obrisiButton.addEventListener('click', fObrisi);

const pretraziButton = document.getElementById('button-pretrazi');
pretraziButton.addEventListener('click', fPretrazi);


