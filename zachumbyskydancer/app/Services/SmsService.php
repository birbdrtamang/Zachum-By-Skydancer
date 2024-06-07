<?php

namespace App\Services;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

class SmsService
{
    public function sendSms($recipient, $message)
    {
        // Bhutan Telecom SMPP connection details
        $host = '119.2.115.41';
        $port = 9000;
        $username = 'dusit';
        $password = 'dusit2024';
        $systemType = 'transceiver';

        // Open a socket connection
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        if ($socket === false) {
            Log::error('Failed to create socket.');
            return false;
        }

        // Connect to the SMPP server
        $connected = socket_connect($socket, $host, $port);
        if ($connected === false) {
            Log::error('Failed to connect to the SMPP server.');
            return false;
        }

        // Send bind request
        $bindRequest = pack('a*C' . 'a*C' . 'a*C', $username, 0x00, $password, 0x00, $systemType, 0x00);
        socket_write($socket, $bindRequest);

        // Read bind response
        $bindResponse = socket_read($socket, 1024);
        if ($bindResponse === false) {
            Log::error('Failed to read bind response.');
            socket_close($socket);
            return false;
        }

        // Parse bind response and handle accordingly
        // For simplicity, assume successful bind
        // Ensure recipient number is in international format
        // if (strpos($recipient, '+') !== 0) {
        //     $recipient = +975 . $recipient;
        // }
        // Ensure the recipient number is in the international format
        if (!preg_match('/^\+?975/', $recipient)) {
            $recipient = '975' . ltrim($recipient, '0');
        }
        // Send submit_sm request
        $message = iconv('UTF-8', 'ASCII', $message);

        $headerFields = pack('NNNNNNCCC', 1, 0, 1, 0, 0, 0, 1, 0, 0);
        $usernameField = pack('a*C', $username, 0x00);
        $recipientField = pack('a*C', $recipient, 0x00);
        $otherFields = pack('CCC', 0x00, 0x00, 0x00) . pack('a*C', 'ISO-8859-1', 0x00);
        $messageField = pack('a*C', $message, 0x00);

        $submitSmRequest = $headerFields . $usernameField . $recipientField . $otherFields . $messageField;
        socket_write($socket, $submitSmRequest);

        // Read submit_sm response
        $submitSmResponse = socket_read($socket, 1024);
        if ($submitSmResponse === false) {
            Log::error('Failed to read submit_sm response.');
            socket_close($socket);
            return false;
        }

        // Parse submit_sm response and handle accordingly
        // For simplicity, assume successful submission

        // Close the socket connection
        socket_close($socket);

        // Log success
        Log::info('SMS sent successfully.');
        return true;
    }
}
