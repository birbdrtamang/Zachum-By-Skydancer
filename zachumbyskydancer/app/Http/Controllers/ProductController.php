<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\User;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Manager;
use App\Models\Events;
use App\Models\Reservation;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;


class ProductController extends Controller
{
    // zachum controller below this
    public function zdashboard(){
        $items = Menu::orderBy('menu_id')->get();
        return view('manager.admindashboard',compact('items'));
    }

    public function zcreatemenu(){
        return view('manager.createmenu');
    }

    // create menu 
    function menuPost(Request $request){
        $request->validate([
            'name'=>'required',
            'description'=>'required',
            'category'=>'required',
            'price'=>'required',
            'image'=>'required',
            'status'=>'required',
        ]); 

        // dd($request->name);

        $filename = time().'.'.$request->image->getClientOriginalExtension();
        $request->image->move('menu_img',$filename);
        // $image= file_get_contents($request->file('image')->getRealPath());

        $data['menu_name'] = $request->name;
        $data['description'] = $request->description;
        $data['type'] = $request->category;
        $data['price'] = $request->price;
        $data['image'] = $filename;
        $data['status'] = $request->status;
        // dd($data);

        try {
            // Your database operation here
            $menu = Menu::create($data);

        } catch (QueryException $e) {
            Log::error('QueryException: ' . $e->getMessage());
            // Handle the exception gracefully, such as displaying an error message to the user
            // and possibly rolling back any database transactions
        }

        // dd($menu);
        if($menu){
            return redirect()->back()->with("success","The item added successfully!");
        }else{
            return redirect()->back()->with("error","Failed to add item. Please try again.");
        }
    }

    function showUpdateMenu($menu_id){
        $items = Menu::where('menu_id', $menu_id)->first();
        return view('manager.updateMenu',compact('items'));
    }

    function updateItem(Request $request, $id){
        $item = Menu::find($id);
        // dd($menu_id);

        $request->validate([
            'name' => 'sometimes',
            'description' => 'sometimes',
            'type' => 'sometimes',
            'price' => 'sometimes|numeric',
            'image' => 'sometimes|image', // Assuming image is optional
            'status' => 'sometimes',
        ]); 

        if ($request->has('name')) {
            $item->menu_name = $request->name;
        }
        if ($request->has('description')) {
            $item->description = $request->description;
        }
        if ($request->has('type')) {
            $item->type = $request->type;
        }
        if ($request->has('price')) {
            $item->price = $request->price;
        }
        if ($request->has('status')) {
            $item->status = $request->status;
        }
    
        // Handle image upload if provided
        if ($request->hasFile('image')) {
            $filename = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move('menu_img', $filename);
            $item->image = $filename;
        }

        try {
            $item->save(); // Save the updated item
            return redirect()->back()->with("success","The item updated successfully!");
        } catch (\Exception $e) {
            return redirect()->back()->with("error","Failed to update item. Please try again.");
        }


    }
    


    public function zevents(){
        $events = Events::orderBy('event_id')->get();
        return view('manager.events',compact('events'));
    }

    public function zcreateEvent(){
        return view('manager.createEvent');
    }

    function eventPost(Request $request){
        $request->validate([
            'eventTitle'=>'required',
            'description'=>'required',
            'image'=>'required',
        ]); 

        // dd($request->name);
        // $image= file_get_contents($request->file('image')->getRealPath());

        $filename = time().'.'.$request->image->getClientOriginalExtension();
        $request->image->move('event_img',$filename);

        $data['event_name'] = $request->eventTitle;
        $data['description'] = $request->description;
        $data['image'] = $filename;

        // dd($data);
        $event = Events::create($data);
        // dd($menu);
        if($event){
            return redirect()->back()->with("success","The event created successfully!");
        }else{
            return redirect()->back()->with("error","Failed to create event. Please try again.");
        }
    }
    public function zreservation(){
        $items = Reservation::orderBy('reservation_id')->get();

        // $customer = Customer::where('id', $items->customer_id)->first();
        return view('manager.reservation',compact('items'));
    }
    public function zreservationPreview($customer_id,$reservation_id){
        $customers = Customer::where('customer_id', $customer_id)->first();
        $reservation = Reservation::where('reservation_id', $reservation_id)->first();

        return view('manager.reservationPreview',compact('customers','reservation'));
    }
    public function zcustomers(){
        $customers = Customer::orderBy('customer_id')->get();
        $count = Customer::orderBy('customer_id')->count();
        return view('manager.customers',compact('customers','count'));
    }
    public function zorders(){
        $orders = Order::orderBy('order_id')->get();
        
        return view('manager.orders',compact('orders'));
    }
    public function zpayment(){
        $payment = Payment::orderBy('payment_id')->get();
        
        return view('manager.payment',compact('payment'));
    }

    public function zpaymentDetail($customer_id){
        $customers = Customer::where('customer_id', $customer_id)->first();
        return view('manager.paymentDetails',compact('customers'));
    }
    public function zprofile(){
        return view('manager.profile');
    }

    function UpdateProfile(Request $request){

        $manager_id = $request->user()->id;
    
        $info = Manager::findOrFail($manager_id);
        $userInfo = User::findOrFail($manager_id);

        // Update the order status
        $info->name = $request->input('name');
        $info->email = $request->input('email');
        $info->phoneNo = $request->input('phoneNo');
        $info->password = Hash::make($request->input('password'));

        // Update the order status
        $userInfo->name = $request->input('name');
        $userInfo->email = $request->input('email');
        $userInfo->phoneNo = $request->input('phoneNo');
        $userInfo->password = Hash::make($request->input('password'));

        // Save the changes
        $info->save();
        $userInfo->save();
        return redirect(route('zprofile'))->with('success','Profile Updated Successfully!');

    }

    function deleteItem($menu_id){
         // Find the product by ID
         $item= Menu::where('menu_id', $menu_id);

         // Check if the product exists
         if ($item) {
             // Delete the product
             $item->delete();
             return redirect()->back()->with("success","Item deleted successfully!");
         } else {
             return redirect()->back()->with("error","Item not found.");
         }
    }

    function deleteEvent($event_id){
        $event= Events::where('event_id', $event_id);

        // Check if the product exists
        if ($event) {
            // Delete the product
            $event->delete();
            return redirect()->back()->with("success","Event deleted successfully!");
        } else {
            return redirect()->back()->with("error","Event not found.");
        }
    }

    function deleteCustomer($customer_id){
        $customer1 = Customer::where('customer_id', $customer_id);
        $customer2 = User::where('id', $customer_id);

        // Check if the product exists
        if ($customer1 && $customer2) {
            // Delete the product
            $customer1->delete();
            $customer2->delete();
            return redirect()->back()->with("success","Customer deleted successfully!");
        } else {
            return redirect()->back()->with("error","Customer not found.");
        }
    }

    function deleteReservation($reservation_id){
        $reservation = Reservation::where('reservation_id', $reservation_id);

        // Check if the product exists
        if ($reservation) {
            // Delete the product
            $reservation->delete();
            return redirect()->back()->with("success","Reservation deleted successfully!");
        } else {
            return redirect()->back()->with("error","Reservation not found.");
        }
    }

    function getOrders(){
        // Retrieve all orders
        $orders = Order::all();
    }

    function OrderInvoice($order_id, $payment_id){
        return view('manager.orderInvoice',compact('order_id','payment_id'));
    }

    function UpdateStatus(Request $request,$order_id,$payment_id){
         // Retrieve the order based on the order_id
        $order = Order::findOrFail($order_id);
        $payment = Payment::findOrFail($payment_id);


        // Update the payment status
        $payment->payment_status = $request->input('paymentStatus');

        // Update the order status
        $order->order_status = $request->input('orderStatus');

        // Save the changes
        $order->save();
        $payment->save();

        // Redirect back or to any specific route after update
        return redirect(route('zorders'))->with('success', 'Status updated successfully.');
    }

    function PaymentInvoice($payment_id,$item_id){
        // Fetch the payment details
        $paymentDetail = Payment::where('payment_id', $payment_id)->first();

        // Decode the URL-encoded JSON string
        $item_id = json_decode(urldecode($item_id), true);

        // Extract the keys (menu IDs) from the associative array
        $menu_ids = array_keys($item_id);

        // Fetch the menu items from the menu table using the menu IDs
        $menuItems = Menu::whereIn('menu_id', $menu_ids)->get();

         // Initialize the total price
        $total_price = 0;

        // Combine the menu items with their quantities and calculate the total price
        $items_with_quantities = $menuItems->map(function ($item) use ($item_id, &$total_price) {
            $item->quantity = $item_id[$item->menu_id];
            $item->total_price = $item->price * $item->quantity; // Calculate total price for this item
            $total_price += $item->total_price; // Add to the running total
            return $item;
        });

        $grandTotal = $total_price + 25 +25;


        // Pass the data to the view
        return view('manager.paymentInvoice', compact('paymentDetail', 'items_with_quantities','total_price','grandTotal'));
    }
    

}
