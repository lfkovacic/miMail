const ajaxService = {};

ajaxService.sendRequest = function(method, url, data, headers={}, responseType='json') {
  if (method === 'GET' && data instanceof Object) {
    const queryParams = new URLSearchParams();
    for (const key in data) {
      if (Object.prototype.hasOwnProperty.call(data, key)) {
        queryParams.append(key, data[key]);
      }
    }
    url = url + '?' + queryParams.toString();
  }
  
  return new Promise((resolve, reject) => {
    const xhr = new XMLHttpRequest();

    xhr.open(method, url);

    for (let key in headers) {
      xhr.setRequestHeader(key, headers[key]);
    }

    xhr.responseType = responseType;

    xhr.onload = function() {
      if (xhr.status === 200) {
        resolve(xhr.response);
      } else {
        reject(xhr.statusText);
      }
    };

    xhr.onerror = function() {
      reject("Network Error");
    };

    xhr.send(method === 'GET' ? null : data);
  });
};
export default ajaxService;