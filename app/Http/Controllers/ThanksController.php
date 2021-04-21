<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ThanksController extends Controller
{
    public function index()
    {
        $htmlCode = "<p>109級&nbsp;資管系&nbsp;徐國邦&nbsp;
                    109級&nbsp;流管系&nbsp;羅雅平&nbsp;</p>
                    <p>指導老師:&nbsp;楊淑玲老師&nbsp;林文祥老師</p>";
        Alert::html('致謝名單', $htmlCode, 'info')->persistent(true, false);
        return redirect()->back();
    }
}
