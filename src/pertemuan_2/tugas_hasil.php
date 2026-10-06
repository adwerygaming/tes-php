<?php
// take data from frontend
$customer_name = $_POST['customer_name'];
$product_name = $_POST['product_name'];
$transaction_date = $_POST['transaction_date'];
$product_category = $_POST['product_category'];
$product_price = $_POST['product_price'];
$product_quantity = $_POST['product_quantity'];
$customer_money = $_POST['customer_money'];
$payment_method = $_POST['payment_method'];

$total_price = $product_price * $product_quantity;
$exchange = $customer_money - $total_price;
$discount = $total_price * 0.10
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembayaran</title>

    <link rel="stylesheet" href="./styles/tugas.css">

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body>
    <div class="min-h-screen flex flex-col items-center justify-center">
        <div class="flex flex-col gap-4 p-6 bg-slate-100 w-md font-mono">
            <div class="text-center flex flex-col gap-1 py-12">
                <p>***********************************</p>
                <h4 class="text-2xl font-semibold">Struk Belanja</h4>
                <p>***********************************</p>
            </div>

            <div class="flex flex-col gap-1">
                <div class="flex flex-row justify-between">
                    <p class="font-bold">Nama Customer</p>
                    <p><?= htmlspecialchars($customer_name) ?></p>
                </div>

                <div class="flex flex-row justify-between">
                    <p class="font-bold">Nama Produk</p>
                    <p><?= htmlspecialchars($product_name) ?></p>
                </div>

                <div class="flex flex-row justify-between">
                    <p class="font-bold">Tanggal Transaksi</p>
                    <p><?= htmlspecialchars($transaction_date) ?></p>
                </div>

                <div class="flex flex-row justify-between">
                    <p class="font-bold">Kategori</p>
                    <p><?= htmlspecialchars($product_category) ?></p>
                </div>

                <div class="flex flex-row justify-between">
                    <p class="font-bold">Harga Barang (1x)</p>
                    <p>Rp<?= number_format($product_price, 0, ',', '.') ?></p>
                </div>

                <div class="flex flex-row justify-between">
                    <p class="font-bold">Qty</p>
                    <p><?= htmlspecialchars($product_quantity) ?>x</p>
                </div>
            </div>

            <div class="flex flex-col gap-1">
                <div class="flex flex-row justify-between">
                    <p class="font-bold">Uang Anda</p>
                    <p>Rp<?= number_format($customer_money, 0, ',', '.') ?></p>
                </div>

                <div class="flex flex-row justify-between">
                    <p class="font-bold">Metode Pembayaran</p>
                    <p><?= htmlspecialchars($payment_method) ?></p>
                </div>

                <div class="flex flex-row justify-between">
                    <p class="font-bold">Diskon</p>
                    <p>-Rp<?= number_format($discount, 0, ',', '.') ?></p>
                </div>

                <div class="flex flex-row justify-between">
                    <p class="font-bold">Total Harga</p>
                    <p>Rp<?= number_format($total_price, 0, ',', '.') ?></p>
                </div>
            </div>

            <div class="flex flex-col gap-1 items-center text-center text-sm">
                <p>Terima kasih telah berbelanja!</p>
                <p class="italic">Thanks for shopping with us!</p>
            </div>
        </div>
    </div>
</body>

</html>