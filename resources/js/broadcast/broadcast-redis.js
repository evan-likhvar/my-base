window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
import Echo from "laravel-echo";
window.io = require('socket.io-client');
//console.error(window.io);

let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found.');
}

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: 'http://my-base' + ':60001'
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
        window.Echo.private('private_chanel.'+res.data)
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

document.getElementById('axios-post1').addEventListener('click', ()=>{axios.post('/broadcast-redis/push-something-to-public-chanel')}, false);
document.getElementById('axios-post2').addEventListener('click', ()=>{axios.post('/broadcast-redis/push-something-to-private-chanel')}, false);
document.getElementById('axios-post3').addEventListener('click', ()=>{axios.post('/broadcast-redis/push-something-to-presence-chanel')}, false);

