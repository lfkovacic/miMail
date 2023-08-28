import ajaxService from "./ajaxService.js";
import { remoteService } from "./remoteService.js";

const bodoviService = {
    getClientIp: async () => {
        try {
            const res = remoteService.sendRequest("https://api.ipify.org?format=json");
            return res;
        } catch (e) {
            console.error(e);
        }
    },
    getClientCountry: async (ip) => {
        try {
            const res = remoteService.sendRequest(`https://api.country.is/${ip}`);
            return res;
        } catch (e) {
            console.error(e);
        }
    }
}

export { bodoviService }