import soapService from "./soapService.js";
import { remoteService } from "./remoteService.js";

const bodoviService = {
    getClientIp: async () => {
        try {
            const res = await remoteService.sendRequest('GET', "https://api.ipify.org?format=json");
            return await res.json();
        } catch (e) {
            console.error(e);
        }
    },
    getClientCountry: async (ip) => {
        try {
            const res = await remoteService.sendRequest('GET', `https://api.country.is/${ip}`);
            return await res.json();
        } catch (e) {
            console.error(e);
        }
    },
    getListOfCountries: async () => {
        try {
            const response = await soapService.sendRequest('POST',
                'http://webservices.oorsprong.org/websamples.countryinfo/CountryInfoService.wso/ListOfCountryNamesByName',
                {
                    ListOfCountryNamesByName: {
                        attributes:
                            { xmlns: "http://www.oorsprong.org/websamples.countryinfo" }
                        , text: null
                    }
                },
                { 'Content-Type': 'application/x-www-form-urlencoded', Accept: "*/*" })
            return response;
        } catch (error) {
            console.error(error);
        }
    }
}

export { bodoviService }