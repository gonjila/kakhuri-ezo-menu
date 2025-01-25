<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    function index(Request $request) {
        try {
            $lang = $request->input('lang');

            if (in_array($lang, ['en', 'ka'])) {
                App::setLocale($lang);
                Session::put('locale', $lang);
            }

            return redirect()->back();
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Language change failed!',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
