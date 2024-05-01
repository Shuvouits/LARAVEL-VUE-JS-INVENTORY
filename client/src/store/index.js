import { createStore } from 'vuex';

export default createStore({
  state: {
    token: localStorage.getItem('token') || '', // Retrieve token from localStorage
    phone: localStorage.getItem('phone') || ''
  },
  mutations: {
    SET_USER_DATA(state, userData) {
      state.token = userData.token;
      state.phone = userData.phone;
      localStorage.setItem('token', userData.token);
      localStorage.setItem('phone', userData.phone) // Store token in localStorage
    }
  },
  actions: {
    storeUserData({ commit }, userData) {
      commit('SET_USER_DATA', userData);
    }
  }
});
