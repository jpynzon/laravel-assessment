import { ref } from 'vue';

const isLoggedIn = ref(false);
const user = ref(null);

const setAuth = (authUser, token) => {
    user.value = authUser;
    isLoggedIn.value = true;
    localStorage.setItem('authToken', token);
};

const logout = () => {
    user.value = null;
    isLoggedIn.value = false;
    localStorage.removeItem('authToken');
};

export { isLoggedIn, user, setAuth, logout };
