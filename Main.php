<?php
$filename = "items.csv";
$total = 0;

// ファイルの存在とオープン確認
if (!file_exists($filename)) {
    die("エラー: ファイルが存在しません。");
}

$file = fopen($filename, "r");

// CSVを1行ずつ読み込み、税込価格を加算
while (($line = fgetcsv($file)) !== false) {
    $price = (int)$line[2];
    $rate = ($line[1] === '対象') ? 0.08 : 0.10;
    $total += floor($price * (1 + $rate));
}

fclose($file);
echo "合計金額: {$total} 円";
?>
