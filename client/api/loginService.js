import ajaxService from "./ajaxService.js";

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
      const response = await ajaxService.sendRequest ("POST", '/api/UserDetails/getUserDetails', UID);
      console.log (response);
      return response;

    } catch (error) {
      throw new Error (`Greška kod dohvaćanja detalja korisnika: ${error.message}`);

    }
  },
  
  insertUserDetails: async (userDetailsObj) => {
    try {
      const response = await ajaxService.sendRequest ('POST','/api/UserDetails/insertUserDetails', userDetailsObj);
      console.log(response);
      return response;
      
    } catch (error) {
      throw new Error (`Greška kod upisivanja detalja korisnika: ${error.message}`);
    }
  }
}

export { loginService };