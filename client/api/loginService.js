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
          const queryParams = new URLSearchParams();
          queryParams.append('username', userObj.username);
          queryParams.append('password', userObj.password);
          const response = await ajaxService.sendRequest('GET', `/api/login/echouser?${queryParams.toString()}`);
          return response;
        } catch (error) {
          throw new Error(`Failed to register user: ${error.message}`);
        }
      }
}

export {loginService};