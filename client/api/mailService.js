import ajaxService from "./ajaxService.js";

const mailService = {
    sendMail: async (mailObj) => {
        try {
            const response = await ajaxService.sendRequest('POST', '/api/mail/sendMail', mailObj)
            console.log(response);
        } catch (e) {
            console.error(e);
        }
    }

}
export {mailService};