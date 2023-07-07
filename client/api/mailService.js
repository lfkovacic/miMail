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
            const response = await ajaxService.sendRequest('GET', `/api/mail/getAllMail?${username}`);
            console.log (response);
        }
        catch (e) {
            console.error(e);
        }
    },
    getMail: async (id) => {
        try {
            const response = {
                sender: 'test@localhost', subject: 'test', content: 'test'
            };
            return response;

        } catch (error) {

        }
    }
}

export { mailService };
