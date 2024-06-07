<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pay Online</title>
    <link rel="stylesheet" href="{{asset('css/qrcode.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />

</head>
<body>
    <div class="qrcontainer">
        <img height=340 width=300 src="{{asset('img/QRCode.jpeg')}}" alt="QR code generating...">
        <form action="{{ route('submit.qr.form') }}" method="POST">
            @csrf
            <div class="mb-6">
                <input name="jrlNo" placeholder="Enter the journal number" type="number" id="default-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            <input type="hidden" name="order_date" value="{{ $data['order_date'] }}">
            <input type="hidden" name="customer_id" value="{{ $data['customer_id'] }}">
            <input type="hidden" name="customer_address" value="{{ $data['customer_address'] }}">
            <input type="hidden" name="additional_notes" value="{{ $data['additional_notes'] }}">
            <input type="hidden" name="item_ids" value="{{ $data['item_ids'] }}">
            <input type="hidden" name="contactNo" value="{{ $data['contactNo'] }}">

            <input type="hidden" name="payment_customer_id" value="{{ $paymentData['customer_id'] }}">
            <input type="hidden" name="grand_total" value="{{ $paymentData['grand_total'] }}">
            <input type="hidden" name="payment_status" value="{{ $paymentData['payment_status'] }}">
            <input type="hidden" name="payment_method" value="{{ $paymentData['payment_method'] }}">
            <input type="hidden" name="payment_date" value="{{ $paymentData['date'] }}">            

            <button style="border-radius:20px;background-color:#0F5061" type="submit" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Submit</button>
        </form>
    </div>
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

</html>