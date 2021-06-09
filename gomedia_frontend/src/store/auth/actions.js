import { api } from 'boot/axios'

export const signIn = async ({ dispatch }, userData) => {
    try {
        const response = await Promise.all([
            api.get('sanctum/csrf-cookie/'),
            api.post('login', userData)
        ]);
        dispatch('me');
        return response;
    } catch (error) {
        console.error(error.message);
        return error;
    }
};

export function me ({ commit }) {
    return api.get('/api/user').then((response) => {
        commit('SET_AUTHENTICATED', true);
        commit('SET_USER', response.data);
    }).catch(() => {
        commit('SET_AUTHENTICATED', false);
        commit('SET_USER', null);
    })
}

export const signOut = async ({ dispatch }) => {
    await api.get('logout')

    return dispatch('me')
}

