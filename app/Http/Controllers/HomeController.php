<?php

namespace App\Http\Controllers;

use App\Borrow;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index(Request $request)
  {
    return view('home', [
      'borroweds' => Borrow::where('from_id', $request->user()->id)->get(),
      'users' => User::all()
    ]);
  }
}
