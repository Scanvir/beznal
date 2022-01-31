<?php

$smtp_hostname = 'tls://mail.bilaromashka.com.ua';
$tls = substr($smtp_hostname, 0, 3) == 'tls';
$hostname = $tls ? substr($smtp_hostname, 6) : $smtp_hostname;


echo $smtp_hostname . '<br>';
echo $hostname . '<br>';
echo $tls . '<br>';
echo getenv('SERVER_NAME') . '<br>';
echo gethostname();


$handle = fsockopen($hostname, 465, $errno, $errstr, 5);
echo fgets($handle, 515);
echo $errno;
echo $errstr;

fputs($handle, 'EHLO ' . getenv('SERVER_NAME') . "\r\n");
echo fgets($handle, 515);

fputs($handle, 'STARTTLS' . "\r\n");
echo fgets($handle, 515);

stream_socket_enable_crypto($handle, true, STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT);

fputs($handle, 'EHLO ' . getenv('SERVER_NAME') . "\r\n");
echo fgets($handle, 515);


fputs($handle, 'AUTH LOGIN' . "\r\n");
echo fgets($handle, 515);

fputs($handle, base64_encode('info@electrohub.com.ua') . "\r\n");
fputs($handle, base64_encode('0536637724Sv') . "\r\n");
fputs($handle, 'RCPT TO: <vitaliy@skalnyy.com>' . "\r\n");
fputs($handle, 'DATA' . "\r\n");
fputs($handle, 'bla bla bla' . "\r\n");
fputs($handle, '.' . "\r\n");


fputs($handle, 'QUIT' . "\r\n");
echo fgets($handle, 515);