'use strict';
let app = require('express')();
let server = require('http').Server(app);
let io = require('socket.io')(server);
require('dotenv').config();

console.log(process.env);

let redisPort = process.env.REDIS_PORT;
let redisHost = process.env.REDIS_HOST;

console.log(process.env.REDIS_PORT,process.env.REDIS_HOST,process.env.REDIS_PASSWORD);

let ioRedis = require('ioredis');
let redis = new ioRedis({
    port: process.env.REDIS_PORT, // Redis port
    host: process.env.REDIS_HOST, // Redis host
    family: 4, // 4 (IPv4) or 6 (IPv6)
    password: process.env.REDIS_PASSWORD,
    db: 0
});
redis.subscribe('public-chanel');
redis.on('message', function (channel, message) {
    message  = JSON.parse(message);
    console.log(message);
    console.log(channel);
    io.emit(channel + ':' + message.event, message.data);
});

let broadcastPort = process.env.BROADCAST_PORT;
server.listen(broadcastPort, function () {
    console.log('Socket server is running.');
});