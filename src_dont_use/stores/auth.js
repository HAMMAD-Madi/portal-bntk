import { defineStore } from 'pinia';
import axios from '../services/axios'
import router  from '../router';

function clearAllCookies() {
    var cookies = document.cookie.split(";");

    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i];
        var eqPos = cookie.indexOf("=");
        var name = eqPos > -1 ? cookie.substring(0, eqPos) : cookie; // changed from 'substr' to 'substring'
        document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/; samesite=strict";
    }
}

export const useAuthStore = defineStore('auth', {
    state: () => ({
        // initialize state from local storage to enable user to stay logged in
        user: JSON.parse(localStorage.getItem('user') || null),
        returnUrl: null
    }),
    actions: {
        async login(email, password) {
            return new Promise(async (resolve, reject) => {
                try {
                    await axios.get('/sanctum/csrf-cookie')
    
                    const response = await axios.post('/api/login', { email, password });
    
                    if(response.status != 200) {
                        return reject('Authentication failed.')
                    }
    
                    if(response.data.status == '__LOGIN_BAD_CREDENTIALS__') {
                        return reject('Bad credentials')
                    }
    
                    const user = response.data.user
                    // update pinia state
                    this.user = user
        
                    // store user details and jwt in local storage to keep user logged in between page refreshes
                    localStorage.setItem('user', JSON.stringify(user))
        
                    // redirect to previous url or default to home page
                    router.push(this.returnUrl || '/')
                } catch(e) {
                    console.log(e)
                    reject('Authentication failed.')
                }
            } )
           

        },
        async logout() {
            await axios.get('/sanctum/csrf-cookie')
            await axios.get('/api/logout');
            clearAllCookies()
            this.user = null
            localStorage.removeItem('user')
            router.push('/login')
        }
    }
});