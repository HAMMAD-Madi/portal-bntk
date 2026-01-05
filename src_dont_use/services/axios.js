import axios from 'axios'
import Cookies from 'js-cookie';
import router from '../router'
import { useAuthStore } from '../stores/auth';
import eventBus from '@/eventBus';

const baseUrl = `${import.meta.env.VITE_BASE_API_URL}`;
const options = {};
// options.baseURL = baseUrl;
options.withCredentials = true
options.withXSRFToken = true;


const instance = axios.create(options);


function clearAllCookies() {
    var cookies = document.cookie.split(";");

    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i];
        var eqPos = cookie.indexOf("=");
        var name = eqPos > -1 ? cookie.substring(0, eqPos) : cookie; // changed from 'substr' to 'substring'
        document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/; samesite=strict";
    }
}
instance.interceptors.request.use((config) => {
  return config;
})


instance.interceptors.response.use(function (response) {
    // Any status code that lie within the range of 2xx cause this function to trigger
    // Do something with response data
    if(response.status == 429)  {
      return Promise.reject('too many requests');
    }
    return response;
  }, function (error) {
    console.log(error)
    if(error.response.status == 401)  {
      const auth = useAuthStore();
      auth.user = null 
      localStorage.removeItem('user')
      router.push('/login')

      return Promise.reject(error);
    }


    if(error.response.status == 403)  {
      
      eventBus.emit('show-snackbar', {
        message: 'Geen toegang',
        color: 'error',
      });
      //localStorage.removeItem('user')
      //router.push('/login')

      return Promise.reject(error);
    }


    if(error.response.status == 404)  {

      router.push('/niet-gevonden')
      return
    }

    clearAllCookies()
    const auth = useAuthStore();
    localStorage.removeItem('user')

    //auth.logout()
    // router.push('/login')

    return Promise.reject(error);
  });

export default instance