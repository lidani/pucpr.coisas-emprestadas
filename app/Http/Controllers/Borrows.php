<?php

namespace App\Http\Controllers;

use App\Borrow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Borrows extends Controller
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

  public function create(Request $request)
  {
    Log::debug($request->user());
    Borrow::create(array_merge(
      $request->all(),
      [
        'from_id' => $request->user()->id
      ]
    ));

    return redirect()->back();
  }
}
