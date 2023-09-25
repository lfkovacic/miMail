export const remoteService = {
    sendRequest: async (method, url, _data, headers) => {
        try {
            const response = await fetch(url, {
                mode: "cors",
                method: method,
                body: _data,
                headers: headers
            });
            return response;
        } catch (e) {
            console.error(e);
        }
    }
};
