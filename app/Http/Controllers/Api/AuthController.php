<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;

class AuthController extends Controller
{
  /**
   * Create a new AuthController instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth:api', ['except' => ['login']]);
  }

  /**
   * Get a JWT via given credentials.
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function login(Request $request)
  {

    $data = json_decode($request->getContent(), true);

    $validator = Validator::make(
      $data,
      [
        'email' => 'required',
        'password' => 'required',
      ]
    );

    if ($validator->fails()) {
      $messages = $validator->messages();
      return response()->json([$messages], 400);
    }

    if (!$token = auth('api')->attempt($data)) {
      return response()->json(['error' => 'Unauthorized'], 401);
    }

    return $this->respondWithToken($token);
  }

  // /**
  //  * Get the authenticated User.
  //  *
  //  * @return \Illuminate\Http\JsonResponse
  //  */
  // public function me()
  // {
  //     return response()->json(auth()->user());
  // }

  // /**
  //  * Log the user out (Invalidate the token).
  //  *
  //  * @return \Illuminate\Http\JsonResponse
  //  */
  // public function logout()
  // {
  //     auth()->logout();

  //     return response()->json(['message' => 'Successfully logged out']);
  // }

  // /**
  //  * Refresh a token.
  //  *
  //  * @return \Illuminate\Http\JsonResponse
  //  */
  // public function refresh()
  // {
  //     return $this->respondWithToken(auth()->refresh());
  // }

  /**
   * Get the token array structure.
   *
   * @param  string $token
   *
   * @return \Illuminate\Http\JsonResponse
   */
  protected function respondWithToken($token)
  {
    return response()->json([
      'access_token' => $token,
      'token_type' => 'bearer',
      'expires_in' => auth('api')->factory()->getTTL() * 60,
      'user' => auth('api')->user()
    ]);
  }
}
