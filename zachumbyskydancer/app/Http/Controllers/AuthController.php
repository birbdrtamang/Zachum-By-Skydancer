<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Customer;
use App\Models\Manager;

use App\Models\User;
use App\Models\Menu;
use App\Models\Events;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Reservation;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;


class AuthController extends Controller
{

    protected $table = 'users';

    public function getHomepage() {
        // Fetch the last 4 rows from the table using Eloquent
        $items = Menu::orderBy('menu_id', 'desc')->take(4)->get();
        $event = Events::orderBy('event_id', 'desc')->first();
    
        // Initialize the cart if it doesn't exist
        if (!session()->has('cart')) {
            session()->put('cart', []);
        }
    
        // Retrieve the cart from the session
        $cart = session()->get('cart');
    
        // Check if the user is authenticated
        if (auth()->check()) {
            $currentUser = auth()->user(); // Get the currently authenticated user
            $role = $currentUser->role; // Assuming the User model has a 'role' attribute
    
            // Redirect based on the user's role
            if ($role === 'Manager') {
                return redirect()->route('zdashboard'); // Redirect to manager dashboard
            } elseif ($role === 'Customer' || is_null($role)) {
                // Navigate to user homepage
                return view('homepage', compact('items', 'event', 'cart'));
            }
        }
        // Default case: navigate to user homepage
        return view('homepage', compact('items','event','cart'));
    }
    

    function login(){
        if(Auth::check()){
                // Initialize the cart if it doesn't exist
            if (!session()->has('cart')) {
                session()->put('cart', []);
            }

            $response = Http::get('http://localhost:8000/api/menus');
            $items = $response->json();
            
            // Retrieve the cart from the session
            $cart = session()->get('cart');
            // $items = Menu::orderBy('menu_id')->take(4)->get();
            return redirect(route('homepage',compact('items','cart')));
        }
        return view('login');
    }

    function loginPost(Request $request){
        $request->validate([
            'phoneNo'=>'required',
            'password'=>'required'
        ]);
        $phoneNo = $request->input('phoneNo');

        $user = User::where('phoneNo', $phoneNo)->first();
        // dd($user);
        $credentials = $request->only('phoneNo','password');

        if(Auth::attempt($credentials)){
            $currentUser = [
                'name' => $user->name,
                'customer_id' => $user->id,
                'phoneNo' =>$phoneNo
            ];
            Session::put('currentUser', $currentUser);
            $customer = User::get();

            return redirect()->route('homepage')->with('success','Login Successful!');
        }
        if(!$user){
            return redirect()->route('login')->with("error", "Please enter a valid phone number.");
        }else{
            return redirect()->route('login')->with("error", "Please enter a correct password.");
        }
    }

    function registration(){
        if(Auth::check()){
            // Initialize the cart if it doesn't exist
            if (!session()->has('cart')) {
                session()->put('cart', []);
            }

            // Retrieve the cart from the session
            $cart = session()->get('cart');
            $items = Menu::orderBy('menu_id')->take(4)->get();
            return redirect(route('homepage',compact('items','cart')));
        }
        return view('registration');
    }

    public function registrationPost(Request $request){
        $request->validate([
                'name'=>'required',
                'email' => ['required', 'email', 'unique:customer', 'regex:/@gmail\.com$/i'],
                'phoneNo'=>['required', 'regex:/^(17|77)\d{6}$/', 'size:8','unique:customer'],
                'password' => ['required', 'string', 'min:8', 'confirmed','regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'],
            ],
            [
                'email.regex' => 'The email must be in the format "@gmail.com"',
                'phoneNo.regex' => 'Please enter a valid phone number',
            ]
        );  

        $user['name'] = $request->name;
        $user['email'] = $request->email;
        $user['phoneNo'] = $request->phoneNo;
        $user['password'] = Hash::make($request->password);
        $user['role'] = 'Customer';
        
        $user = User::create($user);

        $newUser = User::where('phoneNo', $request->phoneNo)->first();
        
        $data['customer_id'] = $newUser->id;
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phoneNo'] = $request->phoneNo;
        $data['password'] = Hash::make($request->password);

        $customer = Customer::create($data);


        if($customer && $user){
            return redirect()->back()->with("success", "Registration Successful!");
        } else {
            return redirect()->back()->with('error', 'Registration failed, please try again.');
        }
    }

    function forgetPassword(){
        return view('forgetpassword');
    }
    function forgetManagerPassword(){
        return view('manager.forgetMangerPassword');
    }

    function forgetPasswordPost(Request $request){
        $request->validate([
            'phoneNo'=>'required',
        ]);

        $data =$request->input('phoneNo');
        $phoneNo = encrypt($data);

        $user = User::where('phoneNo', $data)->first();
        $customer = Customer::where('phoneNo', $data)->first();

        if(!$user && !$customer){
            return redirect()->back()->with("error", "Incorrect phone number. Please try again.");
        }else{
            return redirect(route('resetPassword',['phoneNo' => $phoneNo]));
        }
    }

    function forgetManagerPasswordPost(Request $request) {
        $request->validate([
            'phoneNo' => 'required',
        ]);
    
        $data = $request->input('phoneNo');
        $phoneNo = encrypt($data);
    
        $user = User::where('phoneNo', $data)
                    ->where('role', 'Manager')
                    ->first();
    
        $manager = null;
        if ($user) {
            $manager = Manager::where('manager_id', $user->id)->first();
        }
    
        if (!$user && !$manager) {
            return redirect()->back()->with("error", "Incorrect phone number. Please try again.");
        } else {
            return redirect(route('resetManagerPassword', ['phoneNo' => $phoneNo]));
        }
    }
    

    function resetPassword($phoneNo){
        return view('resetPassword',compact('phoneNo'));
    }
    function resetManagerPassword($phoneNo){
        return view('manager.resetManagerPassword',compact('phoneNo'));
    }

    function resetPasswordPost(Request $request, $phoneNo){
        $request->validate([
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'
            ],
        ]);
    
        $newPassword = $request->input('password');
        $decryptedData = decrypt($phoneNo);
    
        $user = User::where('phoneNo', $decryptedData)->first();
        $customer = null;
    
        if ($user) {
            $customer = Customer::where('customer_id', $user->id)->first();
        }
    
        if (!$user && !$customer) {
            return redirect()->back()->with("error", "Phone number not found. Please try again.");
        }
    
        if ($user) {
            $user->password = Hash::make($newPassword);
            $user->save();
        }
    
        if ($customer) {
            $customer->password = Hash::make($newPassword);
            $customer->save();
        }
    
        return redirect()->route('login')->with('success', 'Password reset successful!');
    }

    function resetManagerPasswordPost(Request $request, $phoneNo){
        $request->validate([
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'
            ],
        ]);
    
        $newPassword = $request->input('password');
        $decryptedData = decrypt($phoneNo);
    
        $user = User::where('phoneNo', $decryptedData)->first();
        $manager = null;
    
        if ($user) {
            $manager = Manager::where('manager_id', $user->id)->first();
        }
    
        if (!$user && !$manager) {
            return redirect()->back()->with("error", "Phone number not found. Please try again.");
        }
    
        if ($user) {
            $user->password = Hash::make($newPassword);
            $user->save();
        }
    
        if ($manager) {
            $manager->password = Hash::make($newPassword);
            $manager->save();
        }
    
        return redirect()->route('managerlogin')->with('success', 'Password reset successful!');
    }
    
    

    function aboutUs(){
          // Initialize the cart if it doesn't exist
        if (!session()->has('cart')) {
            session()->put('cart', []);
        }
        // Retrieve the cart from the session
        $cart = session()->get('cart');
        $event = Events::orderBy('event_id')->first();
        return view('aboutUs',compact('cart','event'));
    }

    function reservation(){
        if(Auth::check()){
              // Initialize the cart if it doesn't exist
            if (!session()->has('cart')) {
                session()->put('cart', []);
            }
            // Retrieve the cart from the session
            $cart = session()->get('cart');
            $event = Events::orderBy('event_id')->first();
            return view('reservation',compact('cart','event'));
        }else{
            return redirect(route('login'));
        }
    }

    function reservationPost(Request $request){
        $request->validate([
            'date'=>'required',
            'time'=>'required',
            'description'=>'required',
        ]);  

        $currentUserId = $request->user()->id;
        $formattedTime = date('h:i A', strtotime($request->time));

        $data['customer_id'] = $currentUserId;
        $data['date'] = $request->date;
        $data['time'] = $formattedTime;
        $data['description'] = $request->description;

        // dd($currentUserId);
        $reservation = Reservation::create($data);

        if($reservation){
            return redirect()->back()->with("success", "Reservation Successful! Kindly wait for a call for confirmation.");
        } else {
            return redirect()->back()->with('error', 'Reservation failed, please try again.');
        }

    }

    function menu(){
        // Initialize the cart if it doesn't exist
        if (!session()->has('cart')) {
            session()->put('cart', []);
        }
        // Retrieve the cart from the session
        $cart = session()->get('cart');
        $event = Events::orderBy('event_id')->first();

        $menu = Menu::where('status', 'Active')->orderBy('menu_id')->get();

        return view('menu',compact('cart','event','menu'));
    }

    function cart(){
        // Initialize the cart if it doesn't exist
        if (!session()->has('cart')) {
            session()->put('cart', []);
        }

        // Retrieve the cart from the session
        $cart = session()->get('cart');

        $total = 0;

        foreach ($cart as $item) {
            // Add the price of each item to the total
            $total += $item['price'] * $item['quantity'];
        }
        // Pass the cart data to the view
        return view('cart',compact('cart','total'));
    }

    function updatecart(Request $request,$menu_id){
        $quantity = $request->input('quantity');
         // Retrieve the existing cart or initialize it as an empty array
         $cart = session()->get('cart', []);
        // If product already exists in cart, update the quantity
        if(isset($cart[$menu_id])) {
            $cart[$menu_id]['quantity'] = $quantity;
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product quantity updated in cart successfully!');
        }
    }

    public function removeFromCart($menu_id){
        // Retrieve the cart from the session
        $cart = session()->get('cart', []);

        // Check if the product exists in the cart
        if(isset($cart[$menu_id])) {
            // Remove the product from the cart
            unset($cart[$menu_id]);
            // Update the cart session
            session()->put('cart', $cart);
            // Redirect back with a success message
            return redirect()->back()->with('success', 'Product removed from cart successfully!');
        }

        // If the product doesn't exist in the cart, redirect back with an error message
        return redirect()->back()->with('error', 'Product not found in cart.');
    }

    // logout
    function logout(){
        Session::flush();
        Auth::logout();
        $items = Menu::orderBy('menu_id')->take(4)->get();
        // Initialize the cart if it doesn't exist
        if (!session()->has('cart')) {
            session()->put('cart', []);
        }

        // Retrieve the cart from the session
        $cart = session()->get('cart');
        return redirect(route('homepage',compact('items','cart')));
    }

    
    public function addToCart($menu_id)
    {
        // Initialize the cart if it doesn't exist
        if (!session()->has('cart')) {
            session()->put('cart', []);
        }
        $product = Menu::where('menu_id', $menu_id)->first();

        if(!$product) {
            return redirect()->back()->with('error', 'Item not found.');
        }

        $cart = session()->get('cart');

        // If cart is empty, initialize it
        if(!$cart) {
            $cart = [
                $menu_id => [
                    'menu_name' => $product->menu_name,
                    'quantity' => 1,
                    'price' => $product->price,
                    'image' => $product->image
                ]
            ];
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Item added to cart successfully!');
        }

        // If product doesn't exist in cart, add it to cart
        $cart[$menu_id] = [
            'menu_name' => $product->menu_name,
            'quantity' => 1,
            'price' => $product->price,
            'image' => $product->image
        ];

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Item added to cart successfully!');
    }

    function getInvoice(){
        if (!session()->has('cart')) {
            session()->put('cart', []);
        }
        // Retrieve the cart from the session
        $cart = session()->get('cart');

        // Calculate the total price for each item and then sum them up
        $totalSum = collect($cart)->map(function ($item) {
            return $item['price'] * $item['quantity'];
        })->sum();

        $grandTotal = $totalSum + 25 +25;

        return view('invoice',compact('cart','totalSum','grandTotal'));
    }

    public function submitDeliveryOrder(Request $request){
        $request->validate([
            'location'=>'required',
            'message',
            'paymentmethod'=>'required',
        ]);  
        $currentUserId = $request->user()->id;
        $phoneNo = $request->user()->phoneNo;
        date_default_timezone_set('Asia/Thimphu');
        
        $date = Carbon::now();
        $formattedDate = $date->format('M j, g:i A');

        $cartItems = session('cart', []);

        $menuIds = [];

        foreach ($cartItems as $menu_id => $item) {
            if (is_array($item) && isset($item['quantity'])) {
                $menuIds[$menu_id] = $item['quantity'];
            } else {
                // Handle error or unexpected structure
                echo "Error: Invalid item structure for menu_id $menu_id\n";
            }
        }
        
        // payment 

        $cart = session()->get('cart');
         // Calculate the total price for each item and then sum them up
         $totalSum = collect($cart)->map(function ($item) {
            return $item['price'] * $item['quantity'];
        })->sum();

        $grandTotal = $totalSum + 25 +25;

        // generate the random payment_id
        $payment_id = random_int(1, 100);

        $paymentData['payment_id'] = $payment_id;
        $paymentData['customer_id'] = $currentUserId;
        $paymentData['grand_total'] = $grandTotal;
        $paymentData['payment_method'] = $request->paymentmethod;
        $paymentData['date'] = $formattedDate;

        $payment = Payment::create($paymentData);

        // order 
        $data['order_date'] = $formattedDate;
        $data['payment_id'] = $payment_id;
        $data['customer_id'] = $currentUserId;
        $data['customer_address'] = $request->location;
        $data['additional_notes'] = $request->message;
        $data['item_ids'] = json_encode($menuIds);
        $data['contactNo'] = $phoneNo;
        $order = Order::create($data);

        // clear the cart 
        session(['cart' => []]);
        return redirect(route('homepage'))->with('success','Order placed successfully!');
    }

    function submitOnlineOrder(Request $request){
        $request->validate([
            'location'=>'required',
            'message',
            'paymentmethod'=>'required',
        ]);  
        $currentUserId = $request->user()->id;
        $phoneNo = $request->user()->phoneNo;
        date_default_timezone_set('Asia/Thimphu');
        
        $date = Carbon::now();
        $formattedDate = $date->format('M j, g:i A');

        $cartItems = session('cart', []);

        $menuIds = [];

        foreach ($cartItems as $menu_id => $item) {
            if (is_array($item) && isset($item['quantity'])) {
                $menuIds[$menu_id] = $item['quantity'];
            } else {
                // Handle error or unexpected structure
                echo "Error: Invalid item structure for menu_id $menu_id\n";
            }
        }
        
        // order 
        $data['order_date'] = $formattedDate;
        $data['customer_id'] = $currentUserId;
        $data['customer_address'] = $request->location;
        $data['additional_notes'] = $request->message;
        $data['item_ids'] = json_encode($menuIds);
        $data['contactNo'] = $phoneNo;

        // payment 

        $cart = session()->get('cart');
         // Calculate the total price for each item and then sum them up
         $totalSum = collect($cart)->map(function ($item) {
            return $item['price'] * $item['quantity'];
        })->sum();

        $grandTotal = $totalSum + 25 +25;

        $paymentData['customer_id'] = $currentUserId;
        $paymentData['grand_total'] = $grandTotal;
        $paymentData['payment_status'] = "Completed!";
        $paymentData['payment_method'] = $request->paymentmethod;
        $paymentData['date'] = $formattedDate;

        // $order = Order::create($data);
        // $payment = Payment::create($paymentData);

        // clear the cart
        session(['cart' => []]); 
        return view('QRCode',compact('data','paymentData'));
    }

    public function handleQrForm(Request $request) {
        // Retrieve the data from the form
        $data = $request->only([
            'order_date', 
            'customer_id',
            'customer_address', 
            'additional_notes', 
            'item_ids', 
            'contactNo',
            'payment_customer_id',
            'grand_total',
            'payment_status',
            'payment_method',
            'payment_date',
            'jrlNo'
        ]);

        // generate the random number 
        $payment_id = random_int(1, 100);
    
         // Example: Save payment data
         $paymentData = [
            'payment_id' => $payment_id,
            'customer_id' => $data['payment_customer_id'],
            'grand_total' => $data['grand_total'],
            'Jrl_No' => $data['jrlNo'],
            'payment_status' => $data['payment_status'],
            'payment_method' => $data['payment_method'],
            'date' => $data['payment_date'],
        ];
    
        // Save payment data (assuming Payment is a model)
        $payment = Payment::create($paymentData);
        
        // Perform necessary actions with the data, e.g., save to database
        // Example: Save order data
        $orderData = [
            'order_date' => $data['order_date'],
            'customer_id' => $data['customer_id'],
            'payment_id' => $payment_id,
            'customer_address' => $data['customer_address'],
            'additional_notes' => $data['additional_notes'],
            'item_ids' => $data['item_ids'],
            'contactNo' => $data['contactNo'],
        ];
    
        // Save order data (assuming Order is a model)
        $order = Order::create($orderData);
    
       
    
        // Redirect or perform another action after processing
        return redirect()->route('homepage')->with('success', 'Order Placed Successfully!');
    }
    








    // manager auth 
    function managerlogin(){
        if(Auth::check()){
            $items = Menu::orderBy('menu_id')->get();
            return redirect(route('zdashboard',compact('items')));
        }
        return view('manager.login');
    }

    function managerloginPost(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);
        $email = $request->input('email');

        $user = User::where('email', $email)->first();
        $credentials = $request->only('email','password');


        if(Auth::attempt($credentials)){
            $currentUser = $user->name;
            Session::put('currentUser', $currentUser);
            $customer = User::get();
            $items = Menu::orderBy('menu_id')->get();
            return redirect()->route('zdashboard',compact('items'))->with('success','Login Successful!');
        }
        if(!$user){
            return redirect()->route('managerlogin')->with("error", "Please enter the registered email.");
        }else{
            return redirect()->route('managerlogin')->with("error", "Please enter a correct password.");
        }
    }

     // logout
     function managerlogout(){
        Session::flush();
        Auth::logout();
        return redirect(route('managerlogin'));
    }
}
