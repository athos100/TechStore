/**
 * Vamos carregar a biblioteca HTTP axios, que permite enviar requisicoes facilmente
 * para o back-end Laravel. Esta biblioteca lida automaticamente com o envio do
 * token CSRF no cabecalho com base no valor do cookie de token "XSRF".
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * O Echo fornece uma API expressiva para se inscrever em canais e ouvir
 * eventos transmitidos pelo Laravel. O Echo e a transmissao de eventos
 * permitem que sua equipe construa aplicacoes web em tempo real com robustez.
 */

// import Echo from 'laravel-echo';

// import Pusher from 'pusher-js';
// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
//     wsHost: import.meta.env.VITE_PUSHER_HOST ? import.meta.env.VITE_PUSHER_HOST : `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// });
