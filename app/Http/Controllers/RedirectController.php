<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RedirectController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $user = \Auth::user();
        if($user->hasRole([1]) && request()->has('userTest') == null) {
            return redirect()->route('admin.dashboard');
        }
        return view('principal.pages.user.index');
    }
}
