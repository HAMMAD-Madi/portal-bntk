import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

export default {
    install: (app, options) => {


        
        const echo = new Echo({
            cluster: 'mt1',
            encrypted: true,
            broadcaster: 'pusher',
            key: '123',
            wsHost: 'basictoys.pcman.nl',
            wsPort: 443,
            wssPort: 443,
            forceTLS: true,
            disableStats: true,
        });

        //app.config.globalProperties.$echo = echo

        app.provide("echo", { echo: echo });

    }
  }
