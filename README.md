

## 概要
このプログラムは、CSVファイル形式のデータに基づいて、軽減税率（8%）および通常税率（10%）を考慮し、商品の税込合計金額を計算するものです。

CSVフォーマット：
商品名,軽減税率対象かどうか,単価

## 実行環境

- **paiza.io 上で動作確認済み**
- ファイル名：`Main.php`

## ソースコード（Main.php）

```php
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
```

## 入力ファイル（items.csv）

```
おにぎり,非対象,120  
醤油,対象,300  
味噌,対象,250  
白菜,対象,150  
葱,対象,80
```

## 出力例

```
合計金額: 974 円
```

## 補足

- 軽減税率の判定はCSVの2列目（「対象」「非対象」）で行っています。
- 税込み価格の計算は、`floor()` による切り捨て処理を行っています。
- `items.csv` ファイルは `Main.php` と同じディレクトリに配置してください。

## デモ実行手順（paiza.io 推奨）

1. [paiza.io](https://paiza.io/ja/projects/new?language=php) にアクセス  
2. `Main.php` にコードを貼り付け  
3. 右側の「ファイルを追加」から `items.csv` をアップロード  
4. 実行して、「合計金額: ○○円」が表示されることを確認！

## 参考資料
- [PHP: fopen - ファイルを開く](https://www.php.net/manual/ja/function.fopen.php)  
- [PHP: fgetcsv - CSV ファイルの 1 行を取得する](https://www.php.net/manual/ja/function.fgetcsv.php)  

