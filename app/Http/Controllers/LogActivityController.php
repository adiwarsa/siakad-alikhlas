<?php

namespace App\Http\Controllers;

use App\Models\LogActivity;
use Illuminate\Http\Request;

class LogActivityController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $data['pageTitle'] = 'Log Activity';
        $data['activity'] = LogActivity::whereNotNull('event')->latest()->get();

        return view('log.index', $data);
    }
}
