<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\PseudoTypes\False_;
use phpDocumentor\Reflection\PseudoTypes\True_;
use PhpParser\Node\Expr\Cast\Bool_;

use function PHPSTORM_META\type;

class CustomerController extends Controller
{
    public function index()
    {
        return Customer::all();
    }

    public function show(Customer $customer)
    {
        return $customer;
    }

    /**
     * @param String $name
     * 
     * @return Bool
     */
    public static function isValidName(String $name):Bool
    {
        if (strlen($name)<6 || strlen($name)>128) {
            return False;
        }
        return True;
    }

    public function store(Request $request)
    {
        
        $name = $request->input('name');

        if (!$name || !$this::isValidName($name)) {
            return response()->json(['error'=>'name is missing or too short (<6 char) or too long (>128 char)', 400]);
        }


        $email = strtolower($request->input('email'));
        
        if (!$email || !$this::isValidName($email)) {
            return response()->json(['error'=>'email is missing or too short (<6 char) or too long (>128 char)'], 400);
        }

        $password = $request->input('password');

        if (!$password || !$this::isValidName($password)) {
            return response()->json(['error'=>'password is missing or too short (<6 char) or too long (>128 char)', 400]);
        }
        $phone = $request->input('phone');
        if (!$phone) {
            return response()->json(['error'=>'phone is missing'], 400);
        }

        # find email
        // Retrieve the first model matching the query constraints..., return if not found
        $customer = Customer::where('email', $email)->first();
        // error_log(gettype($customer));
        if ($customer) {
            return response()->json(['error'=>'email already exist'], 400);
        }

        $customer = Customer::create([
            "name"=> $name,
            "email"=> $email,
            "password"=> $password,
            "phone"=> $phone
        ]);

        return response()->json($customer, 201);
    }

    public function update(Request $request, Customer $customer)
    {   
        $update_arr = array();
        $phone = $request->input('phone');
        
        if ($phone) {
            $update_arr['phone'] = $phone;
        }

        $name = $request->input('name');

        if ($name) {
            if (!$this::isValidName($name)) {
                return response()->json(['error'=>'name is missing or too short (<6 char) or too long (>128 char)', 400]);
            }
            $update_arr['name'] = $name;
        }
        if (count($update_arr)>0) {
            $customer->update($update_arr);
        }

        return response()->json($customer, 200);
    }

    public function delete(Customer $customer)
    {
        $customer->delete();

        return response()->json(null, 204);
    }
}
