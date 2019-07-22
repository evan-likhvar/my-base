<?php

namespace App\Http\Controllers\Token;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TokenController extends Controller
{
    public function index()
    {
        return view(config('site-settings.theme-views-base').'.token.layout');
    }

    public function post(Request $request)
    {

        dd($request->all());

    }

    public function postJson(Request $request)
    {
        $response = $request->all();
        $response['old_token']=csrf_token();
        $request->session()->regenerateToken();
        $response['new_token'] = csrf_token();

        return $response;
    }

    public function postJson2(Request $request)
    {
        $response = $request->all();
        $response['current_token']=csrf_token();

        return $response;
    }
}
