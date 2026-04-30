import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
// 👉 Agregar Laravel Echo y Pusher
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,   // tu clave en .env
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER, // tu cluster en .env
    forceTLS: true
});
