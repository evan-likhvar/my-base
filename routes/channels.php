<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

/*Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});*/

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('private-chanel.{wsToken}', function ($user, $wsToken) {
    return $user->ws_token == $wsToken;
});

Broadcast::channel('chat.{roomId}', function ($user, $roomId) {
    if ($user->ws_chat == $roomId) {
        return ['name' => $user->name];
    }
});