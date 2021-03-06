<?php

namespace App\Http\Controllers\ApiV2;

use Auth;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('jwt.refresh')->only('refresh');
        $this->middleware('auth:api', ['except' => ['login','register','logout','refresh']]);
    }

    /**
     * Register
     *
     * @param Request $request
     * @return void
     */
    public function register(Request $request)
        {
                $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6s',
            ]);

            if($validator->fails()){
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $user = User::create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password')),
            ]);
            $user->userData()->create([
                'user_id' => $user->id,
                'name' => $user->name,
            ]);

            $token = Auth::guard('api')->attempt($request->only(['email','password']));

            return response()->json([
                'success' => true,
                'data' => $user,
                'token' => $token,
            ], 200);
        }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = Auth::guard('api')->attempt($credentials)) {
            return response()->json([
                'success' => false,
                'errors' => [
                    'email' => 'Неправильный Email или пароль'
                ]
            ], 422);
        }  
        
        if (!Auth::guard('api')->user()->isAdmin()){
            return response()->json([
                'success' => false,
                'errors' => [
                    'email' => 'Неправильный Email или пароль'
                ]
            ],422);
        } else {
            //return $this->respondWithToken($token);
            return response()->json([
                'success' => true,
                'data' => Auth::guard('api')->user(),
                'token' => [
                    'access_token' => $token,
                    'token_type' => 'bearer',
                    'expires_in' =>Auth::guard('api')->factory()->getTTL() * 60
                ],
            ], 200);

        }
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json([
            'success' => true,
            'data' => Auth::guard('api')->user(),
        ]);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(Auth::guard('api')->refresh());
    }


    public function payload() 
    {
        return Auth::guard('api')->payload();
    }

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
            'expires_in' => Auth::guard('api')->factory()->getTTL() * 60
        ]);
    }
}
