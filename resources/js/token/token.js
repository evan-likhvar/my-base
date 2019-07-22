window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found.');
}
console.log(token, token.content);
console.log(token.content);

const button = document.getElementById('axios-post');

function sendAxiosPost() {
    const profile = {};
    profile['someData'] = 'some data';

    axios.post('/token/post-form-json', profile)
        .then(res => {
            console.log('old token    '+res.data.old_token);
            console.log('new token    '+res.data.new_token);

            window.axios.defaults.headers.common['X-CSRF-TOKEN'] = res.data.new_token;

            axios.post('/token/post-form-json2', profile)
                .then(res => {
                    console.log('current token    '+res.data.current_token);
                })
        })
        .then(

        );



}

button.addEventListener('click', sendAxiosPost, false);


