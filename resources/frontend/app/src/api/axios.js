import axios from "axios";
import {getItem} from "@/helpers/persistanceStorage";




axios.defaults.baseURL = 'http://laravel-vue-spa-portfolio.loc/api/v1'

const token = getItem('accessToken')
axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
axios.defaults.headers.common['Accept'] = 'application/json';


/*axios.interceptors.request.use(config => {
    const token = getItem('accessToken')
    config.headers.Authorization = token ? `Bearer ${token}` : ''
    // console.log('authorizationToken', authorizationToken)
    return config
})*/

export default axios


// Bearer

