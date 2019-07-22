<?php

namespace Elikh\LocaleMiddleware;

use Closure;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class SetLocaleMiddleware
{

    private $siteLocales;
    /** @var Session $session */
    private $session;
    private $requestSegments;
    private $localeSessionKey;
    /**
     * Handle an incoming request.
     * set site locale and redirect request to localized version
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->session = $request->getSession();
        $this->requestSegments = $request->segments();
        $this->localeSessionKey = config('site-locales.LocaleSessionKey');
        $this->siteLocales = config('site-locales.SiteLocales');

        if (!$this->session->has($this->localeSessionKey)) {
            // get from url
            if (!$this->getLocaleFromURL($this->requestSegments))
                // get from browser prefer language
                if (!$this->getLocaleFromBrowser($request))
                    //set default locale
                    $this->session->put($this->localeSessionKey, config('site-locales.DefaultLocale'));
        }

        // set locales for this request
        app()->setLocale($this->session->get($this->localeSessionKey));

        // redirect home page to localized version
        if (empty($this->requestSegments)) { // home page
            return redirect('/' . $this->session->get($this->localeSessionKey));
        }

        // redirect secondary pages to localized version
        if ($request->getMethod() == 'GET'
            && in_array(end($this->requestSegments),$this->siteLocales)  // last segment is a locale
            && end($this->requestSegments) != $this->session->get($this->localeSessionKey)) { // need redirect to another locale
            array_pop($this->requestSegments);
            array_push($this->requestSegments,$this->session->get($this->localeSessionKey));
            return redirect('/' . implode('/',$this->requestSegments));
        }
        // redirect secondary pages to localized version if request url hasn't the locale suffix
        if ($request->getMethod() == 'GET' && !in_array(end($this->requestSegments),$this->siteLocales)) {
            array_push($this->requestSegments,$this->session->get($this->localeSessionKey));
            return redirect('/' . implode('/',$this->requestSegments));
        }
        return $next($request);
    }

    private function getLocaleFromURL(array $segments): bool
    {
        $langCandidate = end($segments);

        if (in_array($langCandidate, $this->siteLocales)) {
            $this->session->put(config('site-locales.LocaleSessionKey'), $langCandidate);
            return true;
        }
        return false;
    }

    private function getLocaleFromBrowser(Request $request): bool
    {
        $langCandidate = $request->getPreferredLanguage(config('site-locales.SiteLocales'));

        if ($langCandidate) {
            $this->session->put(config('site-locales.LocaleSessionKey'), $langCandidate);
            return true;
        }
        return false;
    }
}
