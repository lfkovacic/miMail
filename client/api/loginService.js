import { Cookie } from "../util/cookies.js";
import ajaxService from "./ajaxService.js";
import soapService from "./soapService.js";

const loginService = {
  submitUserRegister: async (userObj) => {
    try {
      const response = await ajaxService.sendRequest('POST', `/api/login/registerUser`, userObj);
      return response;
    } catch (error) {
      throw new Error(`Failed to register user: ${error.message}`);
    }
  },
  authenticateUser: async (userObj) => {
    try {
      const response = await ajaxService.sendRequest('POST', '/api/login/authenticateUser', userObj);
      console.log(response);
      return response;
    }
    catch (error) {
      throw new Error(`Greška u autentifikaciji: ${error.message}`);
    }
  },

  getUserDetails: async (UID) => {
    try {
      const response = await ajaxService.sendRequest("POST", '/api/UserDetails/getUserDetails',
        {
          uid: UID
        }
      );
      console.log(response);
      return JSON.parse(response);

    } catch (error) {
      throw new Error(`Greška kod dohvaćanja detalja korisnika: ${error.message}`);

    }
  },

  insertUserDetails: async (userDetailsObj) => {
    try {
      const response = await ajaxService.sendRequest('POST', '/api/UserDetails/insertUserDetails', userDetailsObj);
      console.log(response);
      return response;

    } catch (error) {
      throw new Error(`Greška kod upisivanja detalja korisnika: ${error.message}`);
    }
  },

  getUserId: async () => {
    try {
      const username = Cookie.get('username');
      const response = await ajaxService.sendRequest('POST', '/api/authentification/getUserId', { 'username': username });
      console.log((response));
      return JSON.parse(response).uid;

    } catch (error) {
      throw new Error(`Greška kod dohvaćanja korisničkog ID-a: ${error.message}`);
    }
  },

  getListOfContinentsByName: async () => {
    try {
      const response = await soapService.sendRequest('POST',
        'http://webservices.oorsprong.org/websamples.countryinfo/CountryInfoService.wso/ListOfContinentsByName',
        {
          listOfContinentsByName: {
            attributes:
              { xmlns:"http://www.oorsprong.org/websamples.countryinfo" }
            , text: null
          }
        },
        {'Content-Type': 'application/x-www-form-urlencoded', Accept: "*/*" })
      console.log(response);
    } catch (error) {
      console.error(error);
    }

  }


}


export { loginService };