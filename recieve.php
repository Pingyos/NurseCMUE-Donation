<?php
$input = file_get_contents('php://input');
$request = json_decode($input, true);
$invoice = isset($request['billPaymentRef1']) ? $request['billPaymentRef1'] : '';
$customer = isset($request['billPaymentRef2']) ? $request['billPaymentRef2'] : '';
$amount = isset($request['amount']) ? $request['amount'] : 0;
$date = isset($request['tranactionDateandTime']) ? strtotime($request['tranactionDateandTime']) : '';
$transactionId = isset($request['transactionId']) ? $request['transactionId']: '';
?>