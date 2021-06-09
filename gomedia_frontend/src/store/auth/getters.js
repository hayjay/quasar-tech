export function authenticated (state) {
    return state.authenticated
}

export function user (state) {
    return state.user
}

export function getUserName (state) {
    return state.user ? state.user.name : '';
}