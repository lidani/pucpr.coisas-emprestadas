<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'description', 'user_id', 'from_id',
  ];

  public function from()
  {
    return $this->hasOne(\App\User::class, 'id', 'from_id');
  }
}
