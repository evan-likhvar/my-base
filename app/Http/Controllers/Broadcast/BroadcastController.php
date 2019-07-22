<?php

namespace App\Http\Controllers\Broadcast;

use App\Events\MessageToPrivateChanelEvent;
use App\Events\MessageToPublicChanelEvent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BroadcastController extends Controller
{
    public function index()
    {
        return view(config('site-settings.theme-views-base').'.broadcast.layout');
    }


    public function pushSomethingToPublicChanel(Request $request)
    {
        event(new MessageToPublicChanelEvent('Public chanel '.Str::random(10)));
        return response()->json(['pushSomethingToPublicChanel']);
    }

    public function pushSomethingToPrivateChanel(Request $request)
    {
        event(new MessageToPrivateChanelEvent('Private chanel '.Str::random(10)));
        return response()->json(['pushSomethingToPrivateChanel']);
    }

    public function pushSomethingToPresenceChanel(Request $request)
    {
        event(new MessageToPresenceChanelEvent('Presence chanel '.Str::random(10)));
        return response()->json(['pushSomethingToPresenceChanel']);
    }

    public function getWSToken()
    {
        $user = Auth::user();
        if (!$user) abort(403);

        $user->ws_token = Str::random(50);
        $user->save();

        return response()->json([$user->ws_token]);
    }
}
