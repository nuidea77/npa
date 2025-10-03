<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use TCG\Voyager\Facades\Voyager;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        // 1. Админ самбараас (Voyager settings) хэлний тохиргоог авах
        $defaultLocale = Voyager::setting('site.locale', 'mn');

        // 2. Session эсвэл Query параметрээс хэл авах
        $locale = $request->query('lang', Session::get('locale', $defaultLocale));

        // 3. Зөвшөөрөгдсөн хэл мөн эсэхийг шалгах
        if (!in_array($locale, ['mn', 'en'])) {
            $locale = $defaultLocale;
        }

        // 4. Хэл солих
        App::setLocale($locale);
        Session::put('locale', $locale);

        return $next($request);
    }
}
