import { Cookie } from "../util/cookies.js";
const ajaxService = {};

ajaxService.sendRequest = function (method, url, data, headers = {},
  responseType = 'application/json') {
  return new Promise((resolve, reject) => {
    const xhr = new XMLHttpRequest();

    xhr.open(method, url);

    for (let key in headers) {
      xhr.setRequestHeader(key, headers[key]);
    }

    xhr.responseType = responseType;
    const token = Cookie.get('token').trim();
    xhr.setRequestHeader('Authorization', 'Bearer '+token);

    xhr.onload = function () {
      if (xhr.status === 200) {
        resolve(xhr.response);
      } else {
        reject(xhr.statusText);
      }
    };

    xhr.onerror = function () {
      reject("Network Error");
    };

    if (method === 'GET') { //Provjera i parsiranje data objekta
      if (data instanceof Object) {
        const queryParams = new URLSearchParams();
        for (const key in data) {
          if (Object.prototype.hasOwnProperty.call(data, key)) {
            queryParams.append(key, data[key]);
          }
        }
        url = url + '?' + queryParams.toString();
      }
      xhr.send();
    } else if (method === 'POST') {
      xhr.setRequestHeader('Content-Type', 'application/json');
      xhr.send(JSON.stringify(data));
    }
  });
};

export default ajaxService;
