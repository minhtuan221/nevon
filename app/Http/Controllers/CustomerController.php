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
        //todo find customer by Name : name,
        // lay tren url ten va tim theo ten neu ko co ten thi hien ra all khach hang
        // tim theo ki tu neu co ki tu do tren url 

        //todo them page va page size dang bien,page mac dinh la 1, neu co truyen vao thi lay theo so truyen vao
        // pagesize mac dinh la fa-rotate-27
        //todo tim name co offset va limit dua theo page va pagesize 
        $customer = Customer::paginate(10);
        return $customer;
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
    public static function isValidName(String $name): Bool
    {
        if (strlen($name) < 6 || strlen($name) > 128) {
            return False;
        }
        return True;
    }

    //todo viet function isValid email,phone,password 
    public function store(Request $request)
    {
        //TODO CONVERT ALL VARIABLES INTO STRINGS: dung strval() biến có thể là thuộc kiểu chuỗi, số nguyên, float hoặc các đối tượng( Object)
        $name = strval(trim($request->input('name'))); // todo: kiem tra name xoa khoang trang dang trc va sau bien name

        if (!$name || !$this::isValidName($name)) {
            return response()->json(['error' => 'name is missing or too short (<6 char) or too long (>128 char)', 400]);
        }

        $email = trim(strtolower($request->input('email'))); //todo xoa khoang trang, 
        // todo check dinh dang email theo bieu thuc chinh quy (REGEX)
        /*
        $email = "john.doe@example.com";
// Remove all illegal characters from email
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
// Validate e-mail
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo("$email is a valid email address");
} else {
    echo("$email is not a valid email address");
}
*/
        $reg = "/^[A-Za-z0-9_.]{6,32}@([a-zA-Z0-9]{2,12})(.[a-zA-Z]{2,12})+$/";

        if (!$email || !$this::isValidName($email)) {
            return response()->json(['error' => 'email is missing or too short (<6 char) or too long (>128 char)'], 400);
        }
        if (!preg_match($reg, $email)) {
            return response()->json(["error" => "wrong email format"], 400);
        }
        // check password 
        $password = $request->input('password');
        $reg_pass = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/";


        if (!$password || !$this::isValidName($password)) {
            return response()->json(['error' => 'password is missing or too short (<6 char) or too long (>128 char)', 400]);
        }
        //todo check password phai co it nhat 1 trong cac ki tu dac biet @,$,#,%,&
        //todo password phai co it nhat 1 chu viet hoa va 1chu viet thuong
        //todo ma hoa password ( hash password ) 
        if (!preg_match($reg_pass, $password)) {
            return response()->json(["error" => "wrong password format"], 400);
        }

        $phone = $request->input('phone');

        if (!$phone) {
            return response()->json(['error' => 'phone is missing'], 400);
        }
        //todo check dung dinh dang so dien thoai do dai >= 8 ki tu so
        if (!preg_match("/^[0-9]{8,}+$/", $phone)) {
            return response()->json(['error' => 'wrong phone format'], 400);
        }

        # find email
        // Retrieve the first model matching the query constraints..., return if not found
        $customer = Customer::where('email', $email)->first();
        // error_log(gettype($customer));
        if ($customer) {
            return response()->json(['error' => 'email already exist'], 400);
        }
        //TODO gui email confirm customers 

        $customer = Customer::create([
            "name" => $name,
            "email" => $email,
            "password" => $password,
            "phone" => $phone
        ]);

        return response()->json($customer, 201);
    }

    public function update(Request $request, Customer $customer)
    {
        //todo validate cac truong giong ben tren phan create 
        $update_arr = array();
        $phone = $request->input('phone');

        if ($phone) {
            if (!preg_match("/^[0-9]{8,}+$/", $phone)) {
                return response()->json(['error' => 'wrong format phone '], 400);
            }
            $update_arr['phone'] = $phone;
        }

        $name = $request->input('name');

        if ($name) {
            if (!$this::isValidName($name)) {
                return response()->json(['error' => 'name is missing or too short (<6 char) or too long (>128 char)', 400]);
            }
            $update_arr['name'] = $name;
        }
        if (count($update_arr) > 0) {
            $customer->update($update_arr);
        }

        return response()->json($customer, 200);
    }

    public function delete(Customer $customer)
    {
        //todo  convert hard delete into soft delete

        $customer->delete();
        return response()->json(null, 204);
    }
}
