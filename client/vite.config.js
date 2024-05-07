import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'

// https://vitejs.dev/config/
export default defineConfig({

  devServer : {
    proxy : "http://localhost:8000/api"

  },
  plugins: [vue()],

})
