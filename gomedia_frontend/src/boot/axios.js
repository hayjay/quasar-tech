import axios from 'axios'
axios.defaults.withCredentials = true;
const axiosInstance = axios.create({ 
  baseURL: process.env.API_URL.replace(/['"]+/g, '')
})
export default ({ Vue }) => {
  Vue.prototype.$axios = axiosInstance
}
export { axiosInstance }