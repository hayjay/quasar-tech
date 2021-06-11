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
        return response.data;
    } catch (error) {
        console.log('error')
        return error;
    }
};

export const deleteTodo = async ({ dispatch }, todo_id) => {
    try {
        const response = await api.delete(`api/list/delete/${todo_id}`)
        return response.data;
    } catch (error) {
        return error;
    }
};

export const updateTodo = async ({ dispatch }, formData) => {
    try {
        const response = await api.put('api/list/update', formData)
        console.log(response);
        return response.data;
    } catch (error) {
        return error;
    }
};