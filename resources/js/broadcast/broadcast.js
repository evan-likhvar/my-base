window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
import Echo from "laravel-echo";
window.Pusher = require('pusher-js');

let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found.');
}

console.log('broadcast page start');



window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 'e92f54d4a4b930cd3585',
    cluster: 'eu',
    encrypted: true
});

console.log('load echo and pusher');


window.Echo.channel('public-chanel')
    .listen('MessageToPublicChanelEvent', (data) => {
        console.log(data.publicMessages);
        const el =  document.createElement("p");
        el.innerText = 'publicMessages: '+data.publicMessages;
        document.getElementById('public_chanel_data').prepend(el);
    });



const button1 = document.getElementById('axios-post1');

function sendAxiosPost() {
    const profile = {};
    profile['someData'] = 'some data';

    axios.post('/broadcast/push-something-to-public-chanel', profile)
        .then(res => {
            console.log('axios-post1  '+res.data);
        })
}

button1.addEventListener('click', sendAxiosPost, false);