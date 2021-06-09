export default {
    actions: {
        async signIn({ dispatch }, userData) {
            await this.$axios.get('sanctum/srf-cookie');
            await this.$axios.post('login', userData);
            
            return dispatch('me');
        },

        me ({ commit }) {
            return this.$axios.get('/api/user').then((response) {
                commit('SET_AUTHENTICATED', true);
                commit('SET_USER', response.data);
            }).catch(() => {
                commit('SET_AUTHENTICATED', false);
                commit('SET_USER', null);
            })
        }
    }
}
