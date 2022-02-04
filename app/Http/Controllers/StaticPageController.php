<?php

namespace App\Http\Controllers;

class StaticPageController extends Controller
{
    /**
     * Display the about view.
     *
     * @return \Illuminate\View\View
     */
    public function about()
    {
        return view('static-page.about');
    }
}
