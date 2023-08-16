import ajaxService from "./ajaxService.js";
import { Cookie } from "../util/cookies.js";

const mailService = {
    sendMail: async (mailObj) => {
        try {
            const response = await ajaxService.sendRequest('POST', '/api/mail/sendMail', mailObj)
            return JSON.parse(response);
        } catch (e) {
            console.error(e);
        }
    },
    getAllMail: async () => {
        try {
            const username = Cookie.get('username');
            const response = await ajaxService.sendRequest('GET', `/api/mail/getAllMail?username=${username}`);
            return JSON.parse(response);
        }
        catch (e) {
            console.error(e);
        }
    },
    getMail: async (id) => {
        try {
            const response = await ajaxService.sendRequest('GET', `/api/mail/getMail?id=${id}`);
            return JSON.parse(response);
        } catch (e) {
            console.error(e);
        }
    }
}

export { mailService };
