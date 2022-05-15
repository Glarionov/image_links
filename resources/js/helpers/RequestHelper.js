export default class RequestHelper {
    baseUrl = '';
    baseRequestUrl = this.baseUrl + '/api/';

    /**
     * Performs a request, using base URL
     * @param path
     * @param verb
     * @param data
     * @returns {Promise<*>}
     */
    async handleRequest(path, verb, data = {}) {
        let params = [this.baseRequestUrl + path];
        if (['post', 'patch'].includes(verb)) {
            params.push(data);
        }

        let result = await axios[verb](...params)
            .then(function (response) {
                return response;
            })
            .catch(function (response, data) {
                return response;
            });

        return result;
    }

    async get(path) {
        return await this.handleRequest(path, 'get');
    }

    async delete(path) {
        return await this.handleRequest(path, 'delete');
    }

    async post(path, data = {}) {
        return await this.handleRequest(path, 'post', data);
    }

    async patch(path, data = {}) {
        return await this.handleRequest(path, 'patch', data);
    }

}
