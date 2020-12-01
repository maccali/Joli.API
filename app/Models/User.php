<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements JWTSubject
{
  use SoftDeletes;
  protected $table = "sec_users";
  protected $primaryKey = "userId";
  protected $fillable = [
    'name',
    'email',
    'password',
    'sociedade'
  ];
  protected $hidden = [
    'password',
  ];

  protected $casts = [
    'sociedade' => 'array'
  ];
  /**
   * Get the identifier that will be stored in the subject claim of the JWT.
   *
   * @return mixed
   */
  public function getJWTIdentifier()
  {
    return $this->getKey();
  }

  /**
   * Return a key value array, containing any custom claims to be added to the JWT.
   *
   * @return array
   */
  public function getJWTCustomClaims()
  {
    return [];
  }
}
