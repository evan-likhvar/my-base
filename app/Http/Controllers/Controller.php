<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Throwable;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $template;
    protected $user;
    protected $settings;
    protected $siteConstant;

    protected $vars;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            $this->vars = Arr::add($this->vars,'locale',app()->getLocale());
            return $next($request);
        });
        $this->settings = config('site-settings');
        $this->siteConstant = config('site-constants');
    }

    protected function renderOut()
    {
        $this->vars = Arr::add($this->vars, 'siteLocales', $this->siteLocales());
        $this->vars=Arr::add($this->vars,'settings',$this->settings);
        $this->vars=Arr::add($this->vars,'siteConstant',$this->siteConstant);

        return view($this->template)->with($this->vars);
    }


    final protected function siteLocales()
    {
        try {
            return view($this->settings['theme-views-base'].'.includes.site-locales.select-locales')->with('locales',config('site-locales.SiteLocales'))->render();
        } catch (Exception $exception) {
            Log::channel('site')->info($exception->getMessage());
            return '';
        } catch (Throwable $exception) {
            Log::channel('site')->info($exception->getMessage());
            return '';
        }
    }
}
