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
use App\Models\Order;

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('App.Order.{id}', function ($user, $id) {
    return (int) $user->id === (int) Order::findOrNew($id)->uid;
});

Broadcast::channel('App.admin', function ($user) {
    return (int) $user->group === 0;
});

Broadcast::channel('App.Chat.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});