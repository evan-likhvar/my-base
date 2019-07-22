<?php

namespace App\Http\Controllers\Unrestricted;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SiteLocaleController extends Controller
{
    public function changeLocale(Request $request)
    {
        //todo validate URL and locale

        $request->session()->put(config('site-locales.LocaleSessionKey'), $request->input('locale'));
        app()->setLocale($request->input('locale'));

        return redirect()->back();
    }
}
