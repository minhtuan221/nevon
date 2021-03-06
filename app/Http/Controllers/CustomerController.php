<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
// use phpDocumentor\Reflection\PseudoTypes\False_;
// use phpDocumentor\Reflection\PseudoTypes\True_;
// use PhpParser\Node\Expr\Cast\Bool_;
// use function PHPSTORM_META\type;
use Illuminate\Support\Facades\Auth;

use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Repositories\Customer\CustomerRepositoryInterface;
use JWTAuthException;
use Tymon\JWTAuth\Claims\Custom;

// todo tim hieu lam the nao bao ve cac api bang middle ware authentication 
// todo tim hieu phan quyen cho cac api 
// todo confirm email sau khi dang ki
// todo lambooking 
// todo doc ban event trong eloquent 
class CustomerController extends Controller
{

    protected $customerRepo;

    public function __construct(CustomerRepositoryInterface $customerRepo)
    {
        $this->customerRepo = $customerRepo;
    }

    public function getAll()
    {
        $customer = $this->customerRepo->getAll(); 

        return $customer;
    }

    // get all customers
    public function index(Request $request)
    {
        //todo find customer by Name : name,
        // $name= trim($request->name) ;
        // if(!$name){
        // $customer = Customer::paginate(10);
        // return $customer;
        // } else{
        //     $customer= Customer:: where('name','LIKE','%'.$name.'%')->paginate(10);
        //     return $customer ;
        // } 
        $customer = Customer::all(); // lay ra tat ca ca truong trong bang customer
        $customer = Customer::select('name', 'phone')->get()->toArray();

        return false;
        return  $customer;

        dd();
        // $customer = Customer::with(['bookings'])->get(); //dung method all() sẽ lỗi,vi all() ko cho dieu kien di kem vao dc
        // $customer= Customer:: all()->load(['bookings']) ; // lazy eager loading
        // return $customer->toJson();
        $customer = Customer::find(1);
        $customer = $customer->bookings()->get(); // hoac la: Customer::with(['bookings'])
        $customer = Customer::withCount('bookings')->whereNull('deleted_at')->get(); // whereNull loc doi tuong co delete_at =null

        // $customer= Customer::pluck('name'); //   thao tac voi 1 collection dung method all()
        $customer = Customer::all()->pluck('name')->toArray(); // pluck  thao tac voi 1 collection tra ve 1 collection 
        // $customer= Customer:: whereRaw("name=? and id=?",['nguyen viet hung',5])->get();
        // $customer= Customer::where(["name"=>"nguyen viet hung",
        // 'id'=>'>=3'])->get();
        /* withCount()
        Nếu bạn muốn đếm số lượng các kết quả từ 1 relationship mà không load chúng,
        bạn có thể sử dụng withCount method, bạn sẽ đặt cột {relation}_count trên result model của bạn
        */
        return ($customer); // ->count();  dem so luong ban ghi 
    }
    
    public function show(Customer $customer)
    {
        $customer = Customer::with('bookings')->find($customer->id);

        return $customer; // Binding ngầm (Implicit binding)Laravel:
        // type-hint và khai báo biến có tên trùng với tên tham số.
        // http://localhost:8000/api/user/1 chẳng hạn thì một model object sẽ được khởi tạo với ID bằng 1 từ database,
        // sau đó inject vào route và trả về $user->email.Nếu không tồn tại user với ID bằng 1, thì ta sẽ nhận kết quả là lỗi 404.
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
        // lay gia tri input bang cach nay nua $name=$request->name ;
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
            return response()->json(
                ["error" => "wrong email format"],
                400
            );
        }
        // check password 
        $password = $request->input('password');
        $reg_pass = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/";


        if (!$password || !$this::isValidName($password)) {
            return response()->json(['error' => 'password is missing or too short (<6 char) or too long (>128 char)', 400]);
        }

        if (!preg_match($reg_pass, $password)) {
            return response()->json(["error" => "wrong password format"], 400);
        }
        //todo ma hoa password ( hash password )
        // hashpassword sau khi validate xong ; 
        $password = Hash::make($password);
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

        $customer = new Customer();
        $customer->name = $name;
        $customer->email = $email;
        $customer->password = $password;
        $customer->phone = $phone;
        $customer->save(); // luu vao trong database 

        return 200;
        $customer = Customer::create([
            "name" => $name,
            "email" => $email,
            "password" => $password,
            "phone" => $phone
        ]);


        return response()->json($customer, 201);

        return redirect()->action('Admin\AdminNewsController@create'); // Sau khi thực hiện xong, gọi lại function create của Controller AdminNewsController, 
        //nội dung fuction này là hiển thị lại trang view insert.

    }
    // update 
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
    //delete
    public function delete(Customer $customer)
    {
        //todo  convert hard delete into soft delete

        $customer->delete();
        return response()->json(null, 204);
    }
}
