<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoggedInSessionManager extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sessions = DB::table('sessions')
            ->where('user_id', auth()->user()->id)
            ->get()->reverse();

        return view('logout-other-browser-sessions-form', compact('sessions'))->with('current_session_id', session()->getId());
    }

    /**
     * Logout a session based on session id.
     *
     * @return \Illuminate\Http\Response
     */
    public function logoutDevice(Request $request, $device_id)
    {

        DB::table('sessions')->where('id', $device_id)->delete();
        return back();
    }



    /**
     * Logouts a user from all other devices except the current one.
     *
     * @return \Illuminate\Http\Response
     */
    public function logoutOtherBrowser(Request $request)
    {
        DB::table('sessions')
            ->where('user_id', auth()->user()->id)
            ->where('id', '!=', session()->getId())->delete();
        return back();
    }
}
