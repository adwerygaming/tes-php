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

$payment_method_string = $payment_method === 'cash' ? 'Tunai' : 'QRIS';
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
        <div class="drop-shadow-md">
            <svg class="w-full h-3 text-white fill-slate-100 block" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="zigzag-top" width="16" height="12" patternUnits="userSpaceOnUse">
                        <polygon points="0,12 8,0 16,12"></polygon>
                    </pattern>
                </defs>
                <rect width="100%" height="12" fill="url(#zigzag-top)"></rect>
            </svg>

            <div class="flex flex-col gap-4 p-6 bg-slate-100 max-w-md font-mono">
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
                        <p><?= htmlspecialchars($payment_method_string) ?></p>
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

            <svg class="w-full h-3 text-white fill-slate-100 block" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="zigzag-bottom" width="16" height="12" patternUnits="userSpaceOnUse">
                        <!-- Triangle pointing down -->
                        <polygon points="0,0 8,12 16,0"></polygon>
                    </pattern>
                </defs>
                <rect width="100%" height="12" fill="url(#zigzag-bottom)"></rect>
            </svg>
        </div>
    </div>
</body>

</html>