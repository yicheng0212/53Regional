<?php
session_start();

function generateRandomCaptcha($length = 4) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

$captcha = generateRandomCaptcha();
$_SESSION['captcha'] = strtolower($captcha);

header("Content-type: image/png");
$im = imagecreatetruecolor(100, 30);
$bg = imagecolorallocate($im, 22, 86, 165); // 背景顏色
$fg = imagecolorallocate($im, 255, 255, 255); // 文字顏色
imagefill($im, 0, 0, $bg);
imagestring($im, 5, 5, 5,  $captcha, $fg);
imagepng($im);
imagedestroy($im);
?>
