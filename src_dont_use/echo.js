import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

let echo = new Echo({
    cluster: 'mt1',
    encrypted: true,
    broadcaster: 'pusher',
    key: '123',
    wsHost: window.location.hostname,
    wsPort: 6001,
    forceTLS: false,
    disableStats: true,
});

export default echo;