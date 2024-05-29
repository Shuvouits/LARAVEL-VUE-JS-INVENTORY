import { createStore } from 'vuex';

export default createStore({
  state: {
    token: localStorage.getItem('token') || '', // Retrieve token from localStorage
    phone: localStorage.getItem('phone') || '',

    name: localStorage.getItem('name') || '', 
    address: localStorage.getItem('address') || '',
    email: localStorage.getItem('email') || '',
    avatar: localStorage.getItem('avatar') || '',

    top_customer: JSON.parse(localStorage.getItem('top_customer') || '[]'),
    out_of_stock: JSON.parse(localStorage.getItem('out_of_stock') || '[]'),

 
  
    
  },
  mutations: {
    SET_USER_DATA(state, userData) {
      state.token = userData.token;
      state.phone = userData.phone;
      
      state.email = userData.email || ''; // Handle missing fields
      state.address = userData.address || '';
      state.name = userData.name || '';
      state.avatar = userData.avatar || '';

      state.top_customer = userData.top_customer || '';
      state.out_of_stock = userData.out_of_stock || '';
      
     


      localStorage.setItem('token', userData.token);
      localStorage.setItem('phone', userData.phone);
      localStorage.setItem('email', userData.email); // Store even if empty
      localStorage.setItem('address', userData.address);
      localStorage.setItem('name', userData.name);
      localStorage.setItem('avatar', userData.avatar);

      localStorage.setItem('top_customer', JSON.stringify(userData.top_customer));
      localStorage.setItem('out_of_stock', JSON.stringify(userData.out_of_stock));

    
  
      

    }
  },
  actions: {
    storeUserData({ commit }, userData) {
      commit('SET_USER_DATA', userData);
    }
  }
});
