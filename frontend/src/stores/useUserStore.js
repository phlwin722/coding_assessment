import { defineStore } from 'pinia';

export const useUserStore = defineStore('user', {
  state: () => ({
    user: null,
    isLoggedIn: false,
    accessToken: null, 
  }),

  actions: {
    setUser(userData, rememberMe, token) {
      this.user = userData;
      this.isLoggedIn = true;
      this.accessToken = token;

      if (rememberMe) {
        localStorage.setItem('access_token', token);
      } else {
        sessionStorage.setItem('access_token', token);
      }
    },

    clearUser() {
      this.user = null;
      this.isLoggedIn = false;
      this.accessToken = null;
      localStorage.removeItem('access_token');
      sessionStorage.removeItem('access_token');
    },

    loadUserFromLocalStorage() {
      const storedUser = localStorage.getItem('user');
      const storedToken = localStorage.getItem('access_token');

      if (storedUser && storedToken) {
        this.user = JSON.parse(storedUser);
        this.isLoggedIn = true;
        this.accessToken = storedToken; 

        axios.defaults.headers.common['Authorization'] = `Bearer ${this.accessToken}`;
      }
    },
  },

  getters: {
    isAuthenticated(state) {
      return state.isLoggedIn;
    },
    
    getUser(state) {
      return state.user;
    },

    getAccessToken(state) {
      return state.accessToken;
    },
  },
});
