<?php

namespace App\Http\Controllers;

use App\Borrow;
use Illuminate\Http\Request;

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
      'borroweds' => Borrow::where('user_id', $request->user()->id)->get()
    ]);
  }
}
