<?php

namespace App\Http\Controllers;
use App\Models\Menu;
use Illuminate\Http\Request;
use App\Services\SmsService;
use Illuminate\Support\Facades\Log;


class APIController extends Controller
{

    public function sendSms(Request $request, SmsService $smsService)
    {
        $this->validate($request, [
            'recipient' => 'required|string',
            'message' => 'required|string',
        ]);

        // $recipient = $request->input('recipient');
        // $message = "This is the trail message";

        // $recipient = "77382796";
        // $message = "Hello this is the trial message";

        // Retrieve recipient and message from the request
        $recipient = $request->input('recipient');
        $message = $request->input('message');

        $result = $smsService->sendSms($recipient, $message);
    // Return appropriate response based on result
        if ($result) {
            return response()->json(['message' => 'SMS sent successfully'], 200);
        } else {
            return response()->json(['message' => 'Failed to send SMS'], 500);
        }
        // return response()->json(['message' => 'SMS sent successfully'], 200);
    }

    public function getAllMenus()
    {
        $menus = Menu::orderBy('menu_id')->take(4)->get();
        return response()->json($menus);
    }

    public function getEvent()
    {
        $menus = Events::get();
        return response()->json($menus);
    }


}
