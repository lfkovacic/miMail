import ajaxService from "./ajaxService.js";

const loginService = {
  getUserData: async () => {
    const response = { username: "pperic", password: "perozdero123" };
    const response2 = ["kruška", "jabuka", "šljiva"];
    response2[0];
    return response;
    //re
  },
  getToken: () => {
    //TODO: AJAX
  },
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
      return response;
    }
    catch (error) {
      throw new Error(`Greška u autentifikaciji: ${error.message}`);
    }
  }
}

export { loginService };