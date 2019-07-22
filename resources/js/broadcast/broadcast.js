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
console.log('loaded echo and pusher');

// connect to public chanel
window.Echo.channel('public-chanel')
    .listen('MessageToPublicChanelEvent', (data) => {
        console.log(data.publicMessages);
        const el =  document.createElement("p");
        el.innerText = 'publicMessages: '+data.publicMessages;
        document.getElementById('public_chanel_data').prepend(el);
    });

// connect to private chanel
axios.post('/broadcast/set-connection')
    .then(res => {
        console.log('set-connection  '+res.data);
        window.Echo.private('private-chanel.'+res.data)
            .listen('MessageToPrivateChanelEvent', (data) => {
                console.log(data);
                const el =  document.createElement("p");
                el.innerText = 'privateMessages: '+data.publicMessages;
                document.getElementById('private_chanel_data').prepend(el);
            });
    });

// connect to public chanel
window.Echo.channel('public-chanel')
    .listen('MessageToPublicChanelEvent', (data) => {
        console.log(data.publicMessages);
        const el =  document.createElement("p");
        el.innerText = 'publicMessages: '+data.publicMessages;
        document.getElementById('public_chanel_data').prepend(el);
    });


const button1 = document.getElementById('axios-post1');
const button2 = document.getElementById('axios-post2');
const button3 = document.getElementById('axios-post3');

function sendAxiosPost() {
    const profile = {};
    profile['someData'] = 'some data';

    axios.post('/broadcast/push-something-to-public-chanel', profile)
        .then(res => {
            console.log('axios-post1  '+res.data);
        })
}

function sendAxiosPost2() {
    const profile = {};
    profile['someData'] = 'some data';

    axios.post('/broadcast/push-something-to-private-chanel', profile)
        .then(res => {
            console.log('axios-post2  '+res.data);
        })
}

function sendAxiosPost3() {
    const profile = {};
    profile['someData'] = 'some data';

    axios.post('/broadcast/push-something-to-private-chanel', profile)
        .then(res => {
            console.log('axios-post2  '+res.data);
        })
}

button1.addEventListener('click', sendAxiosPost, false);
button2.addEventListener('click', sendAxiosPost2, false);
button3.addEventListener('click', sendAxiosPost3, false);

