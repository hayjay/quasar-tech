import Vue from 'vue'
import axios from 'axios'
axios.defaults.withCredentials = true;


Vue.prototype.$axios = axios

const api = axios.create({ 
  baseURL: process.env.API_URL.replace(/['"]+/g, '') || 'http://localhost:8000' 
})
Vue.prototype.$api = api

export { axios, api }