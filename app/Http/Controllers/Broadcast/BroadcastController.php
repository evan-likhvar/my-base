<?php

namespace App\Http\Controllers\Broadcast;

use App\Events\MessageToPublicChanelEvent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class BroadcastController extends Controller
{
    public function index()
    {
        return view(config('site-settings.theme-views-base').'.broadcast.layout');

    }


    public function pushSomethingToPublicChanel(Request $request)
    {

        event(new MessageToPublicChanelEvent(Str::random(30)));

        return ['pushSomethingToPublicChanel'];
    }

    public function pushSomethingToPrivateChanel(Request $request)
    {

        event(new MessageToPublicChanelEvent(Str::random(30)));

        return ['pushSomethingToPublicChanel'];
    }
}
