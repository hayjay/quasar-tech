import { api } from 'boot/axios'

export const all = async ({ dispatch }) => {
    try {
        const response = await api.get('api/transaction/all')
        console.log('irr',response)
        return response.data;
    } catch (error) {
        return error;
    }
};