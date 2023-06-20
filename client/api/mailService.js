import ajaxService from "./ajaxService.js";

const mailService = {
    sendMail: async (mailObj) => {
        try {
            const response = await ajaxService.sendRequest('POST', '/api/mail/sendMail', mailObj)
            return response;
        } catch (e) {
            console.error(e);
        }
    }
}
export {mailService};