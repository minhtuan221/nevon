<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Jobs\SendEmail;
use Illuminate\Auth\Events\Registered;
use App\Jobs\SendVerificationEmail;

class JwtAuthController extends Controller
{
    // public function __construct() {
    //     $this->middleware('auth:api',['except' =>['login', 'register']]);
    // }
    /**
     * Get a JWT via given credentials.
    */
    protected function create(array $data){

        return Customer::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'phone' => $data['name'],
            'email_token'=>base64_encode($data['email'])
            ]);
    }


    protected function generateToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60,
            'customer' => auth()->user()
        ]);
    }
    
    public function login(Request $request){
       
    	$req = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:5'
        ]);

        if ($req->fails()) {
            return response()->json($req->errors(), 422);
        }

        if (!$token = Auth::attempt($req->validated())) { // co the Auth:: dc viet la auth() nhuwng se bao loi 
            return response()->json(['Auth error' => "invalid_email_or_password"], 401);
        }

        return $this->generateToken($token);
    }

    /**
     * Sign up.
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request) {
        $req = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
            'phone' => 'required|string',
        ]);
        // $req= $this->validator($request->all())->validate();
        if($req->fails()){
            return response()->json($req->errors()->toJson(),400);
        }

        $user = Customer::create(array_merge(
                    $req->validated(),
                    ['password' => bcrypt($request->password),
                    'email_token' => base64_encode($request->email)
                    ]
                ));
             event(new Registered($user));
              
     $job = new SendVerificationEmail($user);
     dispatch($job);
//todo o day : dang ki khach hang rui xem co tao ra dc email_token ko?
//todo 2: 
        return response()->json([
            'message' => 'User signed up',
            'user' => $user,
        ], 201);
       
    }

    public function verify($token){
        $user = Customer::where('email_token',$token)->first();
        $user->verified = 1; // THÊM TRƯỜNG VERYFIED trong bảng customer
        if($user->save()){
            return view('emailconfirm',['user'=>$user]);
            //  redirect('/login');
        }
    }
    









    
    public function logout() {
        Auth::logout();
        return response()->json(['message' => 'User loged out']);
    }

    /**
     * Token refresh
    */
    // public function refresh() {
    //     return $this->generateToken(Auth::refresh());
    // }

    /**
     * User
    */
    // public function user() {
    //     return response()->json(auth()->user());
    // }

    /**
     * Generate token
    */
   

}
