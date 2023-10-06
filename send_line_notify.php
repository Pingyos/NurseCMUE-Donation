<?php
function sendLineNotification($message)
{
    $lineNotifyToken = '6GxKHxqMlBcaPv1ufWmDiJNDucPJSWPQ42sJwPOsQQL'; // แทนค่าด้วย Line Notify Token ของคุณ
    $lineNotifyAPI = 'https://notify-api.line.me/api/notify';

    $data = [
        'message' => $message,
    ];

    $options = [
        'http' => [
            'header' => "Authorization: Bearer $lineNotifyToken",
            'method' => 'POST',
            'content' => http_build_query($data),
        ],
    ];

    $context = stream_context_create($options);
    $result = file_get_contents($lineNotifyAPI, false, $context);

    if ($result === false) {
        // มีข้อผิดพลาดในการส่ง LINE Notify
        error_log("LINE Notify Error: " . print_r(error_get_last(), true));
    } else {
        // ส่ง LINE Notify สำเร็จ
        error_log("LINE Notify Successful");
    }
}
