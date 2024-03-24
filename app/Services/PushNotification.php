<?php

namespace App\Services;

use Google_Client;

class PushNotification
{
    public function notify(string $token, string $title, string $messageBody)
    {
        try {
            $one = microtime(1);
            $googleClient = new Google_Client;
            $googleClient->useApplicationDefaultCredentials();

            // Use the authentication information you set earlier.
            $googleClient->setAuthConfig(config('firebase.auth'));

            // Add scope to access FCM.
            $googleClient->addScope('https://www.googleapis.com/auth/firebase.messaging');

            // Get authenticated HTTP client here.
            $httpClient = $googleClient->authorize();

            // The body of the message to send.
            $data = [
                'message' => [
                    // Target person (only valid for one person).
                    'token' => $token,
                    'notification' => [
                        'body' => now()->toString(),
                        'title' => "Test push notification",
                    ],
                    'data' => [
                        'data' => json_encode([
                            'sender' => 'tan.le',
                            'data' => [
                                'test' => 'ok',
                                'timestamp' => now()->getTimestamp()
                            ]
                        ])
                    ],
                    'apns' => [
                        'headers' => [
                            "apns-priority" => "10", // Specify 10 to send the notification immediately.
                            "apns-expiration" => "0",
                        ],
                        'payload' => [
                            'aps' => [
                                'alert' => [
                                    'title' => $title,
                                    'body' => $messageBody
                                ]
                            ]
                        ]
                    ],
                    "android" => [
                        "priority" => "high",
                        "ttl" => '0', // immediately, not store in FCM
                        "notification" => [
                            "sound" => "default",
                        ]
                    ],
                ]
            ];

            // Send a POST request to FCM.
            $httpClient->post(config('firebase.push_api'), ['json' => $data]);
            $two = microtime(1);
            $str = 'Total Request time: ' . ($two - $one);

            return $str;
        } catch (\Throwable $th) {
            \Log::debug($th);
        }
    }
}
