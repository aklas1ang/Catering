<?php

namespace App\Http\Controllers;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $limit = $request->limit ?? 10;
        $log_nav = 'active';
        $logs = Log::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate($limit);
        return view('user.logs', compact('logs', 'log_nav'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function store($type, $message, $user_id=null)
    {
        $user_id = $user_id ? $user_id : Auth::user()->id;
        Log::create([
            'type' => $type,
            'message' => $message,
            'user_id' => $user_id,
        ]);
    }
}
