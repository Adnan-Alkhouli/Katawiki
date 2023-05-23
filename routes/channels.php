<?php

use Illuminate\Support\Facades\Broadcast;

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

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('public-product-liked-{id}', function () {
    return true;
});

Broadcast::channel('public-product-likes-{id}', function () {
    return true;
});

// Broadcast::channel('public-product-viewed-{id}', function () {
//     return true;
// });

// Broadcast::channel('public-product-views-{id}', function () {
//     return true;
// });

Broadcast::channel('public-product-bid-{id}', function () {
    return true;
});

Broadcast::channel('public-product-price-{id}', function () {
    return true;
});

Broadcast::channel('public-product-timer-{id}', function () {
    return true;
});

