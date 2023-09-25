import { remoteService } from "./remoteService.js";

const bodoviService = {
    getClientIp: async () => {
        try {
            const res = await remoteService.sendRequest('GET',"https://api.ipify.org?format=json");
            return await res.json();
        } catch (e) {
            console.error(e);
        }
    },
    getClientCountry: async (ip) => {
        try {
            const res = await remoteService.sendRequest('GET',`https://api.country.is/${ip}`);
            return await res.json();
        } catch (e) {
            console.error(e);
        }
    }
}

export { bodoviService }