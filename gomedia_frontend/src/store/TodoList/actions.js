import { api } from 'boot/axios'

export const create = async ({ dispatch }, formData) => {
    try {
        let response = await api.post('api/list/create', formData)
        return response;
    } catch (error) {
        return error;
    }
};

export const all = async ({ dispatch }) => {
    try {
        const response = await api.get('api/list/all')
        // console.log(response);
        return response.data;
    } catch (error) {
        return error;
    }
};