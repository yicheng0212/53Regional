<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['selectedCells'])) {
    $selectedCells = $_POST['selectedCells'];

    if (isValidPattern($selectedCells)) {
        echo 'success';
    } else {
        echo 'fail';
    }
}

function isValidPattern($selectedCells) {
    // 检查是否形成直线
    $lines = [
        [0, 1, 2], [3, 4, 5], [6, 7, 8], // 水平线
        [0, 3, 6], [1, 4, 7], [2, 5, 8], // 垂直线
        [0, 4, 8], [2, 4, 6]            // 对角线
    ];

    foreach ($lines as $line) {
        if (count(array_intersect($line, $selectedCells)) === count($line)) {
            return true; // 找到匹配的直线
        }
    }

    return false; // 未找到匹配的直线
}
?>
