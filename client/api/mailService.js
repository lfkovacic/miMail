import ajaxService from "./ajaxService.js";

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
            const response = [{ id: 'test1', content: 'content 1' }, { id: 'test2', content: 'content 2' }];
            return response;
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
