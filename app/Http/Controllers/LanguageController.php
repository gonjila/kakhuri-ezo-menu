<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    function index(Request $request) {
        $lang = $request->input('lang');

        if (in_array($lang, ['en', 'ka'])) { // Adjust available locales as needed
            App::setLocale($lang);
            Session::put('locale', $lang); // Store the locale in session
        }

        return redirect()->back();  // Set a cookie for 30 days
    }
}
