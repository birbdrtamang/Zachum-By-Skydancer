<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
            <form action="{{route('sendOtp')}}" method="POST" class="registerform">
                @csrf
                <span class="info">Please Enter your phone number to reset your password.</span>
                <div class="form-group">
                    <input placeholder="+975 - " inputmode="numeric" maxlength="8" oninput="this.value = this.value.slice(0, 8)" type="number" name="recipient" class="bg-gray-100 border border-gray-600 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="phoneNumber">
                </div>
                <button type="submit" class="py-2.5 px-5 mt-2 me-2 mb-2 text-white text-sm font-medium text-white-900 focus:outline-none bg-blue-800 rounded-full border border-gray-200 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Send</button>
            </form>
</body>
</html>