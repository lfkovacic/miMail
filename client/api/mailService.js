import ajaxService from "./ajaxService.js";
import { Cookie } from "../util/cookies.js";

const mailService = {
    sendMail: async (mailObj) => {
        try {
            const response = await ajaxService.sendRequest('POST', '/api/mail/sendMail', mailObj)
            return response;
        } catch (e) {
            console.error(e);
        }
    },
    getAllMail: async () => {
        try {
            const username = Cookie.get('username');
            const response = await ajaxService.sendRequest('GET', `/api/mail/getAllMail?username=${username}`);
            console.log (response);
            return response;
        }
        catch (e) {
            console.error(e);
        }
    },
    getMail: async (id) => {
        try {
            const response = ajaxService.sendRequest('GET', `/api/mail/getAllMail?id=${id}`);
            return response;

        } catch (error) {

        }
    }
}

export { mailService };
