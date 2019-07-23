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

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 'e92f54d4a4b930cd3585',
    cluster: 'eu',
    encrypted: true
});

// connect to public chanel
window.Echo.channel('public-chanel')
    .listen('MessageToPublicChanelEvent', (data) => {
        let el = document.createElement("p");
        el.innerText = 'publicMessages: '+data.publicMessages;
        document.getElementById('public_chanel_data').prepend(el);
    });

// connect to private chanel
axios.post('/broadcast/set-connection')
    .then(res => {
        window.Echo.private('private-chanel.'+res.data)
            .listen('MessageToPrivateChanelEvent', (data) => {
                let el = document.createElement("p");
                el.innerText = 'privateMessages: '+data.privateMessages;
                document.getElementById('private_chanel_data').prepend(el);
            });
    });

// connect to Presence chanel
let chatUsers;
function drawUsers(){
    let usersList = '';
    chatUsers.forEach((chatUser)=>{
        usersList = usersList+`<a href="#" class="uk-button uk-button-text">${chatUser.name}</a>;   `;
    });
    document.getElementById('chat_users').innerHTML = usersList;
}

window.Echo.join(`chat.1`)
    .here((users) => {
        chatUsers = users;
        drawUsers()
    })
    .joining((user) => {
        chatUsers.push(user);
        drawUsers()
    })
    .leaving((user) => {
        let i = chatUsers.findIndex((chatUser)=>{
            return chatUser.name === user.name
        });
        chatUsers.splice(i,1);
        drawUsers()
    })
    .listen('MessageToPresenceChanelEvent', (data) => {
        const el =  document.createElement("li");
        el.innerHTML = `<strong>${data.userName}</strong> say: ${data.presenceMessages}`;
        document.getElementById('presence_chanel_data').prepend(el);
    });
/*
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

    axios.post('/broadcast/push-something-to-presence-chanel', profile)
        .then(res => {
            console.log('axios-post3  '+res.data);
        })
}

button1.addEventListener('click', sendAxiosPost, false);
button2.addEventListener('click', sendAxiosPost2, false);
button3.addEventListener('click', sendAxiosPost3, false);

// function pushNotification()
// {
//     chatRoom
//         .whisper('typing', {
//             name: 'aetyeyrur'
//         });
// }
*/
document.getElementById('axios-post1').addEventListener('click', ()=>{axios.post('/broadcast/push-something-to-public-chanel')}, false);
document.getElementById('axios-post2').addEventListener('click', ()=>{axios.post('/broadcast/push-something-to-private-chanel')}, false);
document.getElementById('axios-post3').addEventListener('click', ()=>{axios.post('/broadcast/push-something-to-presence-chanel')}, false);
//document.getElementById('axios-post4').addEventListener('click', pushNotification, false);

