import { createStore } from 'vuex';

export default createStore({
  state: {
    token: localStorage.getItem('token') || '', // Retrieve token from localStorage
    phone: localStorage.getItem('phone') || '',

    name: localStorage.getItem('name') || '', 
    address: localStorage.getItem('address') || '',
    email: localStorage.getItem('email') || '',
    avatar: localStorage.getItem('avatar') || '',
  
    
  },
  mutations: {
    SET_USER_DATA(state, userData) {
      state.token = userData.token;
      state.phone = userData.phone;
      
      state.email = userData.email || ''; // Handle missing fields
      state.address = userData.address || '';
      state.name = userData.name || '';
      state.avatar = userData.avatar || '';


      localStorage.setItem('token', userData.token);
      localStorage.setItem('phone', userData.phone);
      localStorage.setItem('email', userData.email); // Store even if empty
      localStorage.setItem('address', userData.address);
      localStorage.setItem('name', userData.name);
      localStorage.setItem('avatar', userData.avatar);
  
      

    }
  },
  actions: {
    storeUserData({ commit }, userData) {
      commit('SET_USER_DATA', userData);
    }
  }
});
