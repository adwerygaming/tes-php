<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir PHP</title>

    <link rel="stylesheet" href="./styles/tugas.css">

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body>
    <div class="min-h-screen flex flex-col items-center justify-center">
        <div class="p-4 bg-slate-100 rounded-md border border-slate-400 w-md">
            <h4 class="text-2xl font-semibold py-4">Kasir PHP</h4>

            <div class="flex flex-col gap-4">
                <div class="flex flex-col gap-2">
                    <p>Nama Pembeli</p>
                    <input type="text" name="customer_name" placeholder="Masukkan Nama Pembeli" class="p-2 rounded-sm border border-slate-300" />
                </div>

                <div class="flex flex-col gap-2">
                    <p>Nama Produk</p>
                    <input type="text" name="product_name" placeholder="Masukkan Nama Produk" class="p-2 rounded-sm border border-slate-300" />
                </div>

                <div class="flex flex-col gap-2">
                    <p>Tanggal Transaksi</p>
                    <input type="date" name="transaction_date" class="p-2 rounded-sm border border-slate-300" />
                </div>

                <div class="flex flex-col gap-2">
                    <p>Kategori</p>
                    <select name="cars" name="product_category" class="p-2 rounded-sm border border-slate-300">
                        <option value="snack">Snack</option>
                        <option value="minuman">Minuman</option>
                        <option value="makanan">Makanan</option>
                        <option value="bahan_pokok">Bahan Pokok</option>
                    </select>
                </div>

                <div class="flex flex-col gap-2">
                    <p>Harga Barang</p>
                    <input type="number" name="product_price" placeholder="Masukkan Harga Barang" class="p-2 rounded-sm border border-slate-300" />
                </div>

                <div class="flex flex-col gap-2">
                    <p>Jumlah Barang</p>
                    <input type="number" name="product_quantity" placeholder="Masukkan Jumlah Barang" class="p-2 rounded-sm border border-slate-300" />
                </div>

                <div class="flex flex-col gap-2">
                    <p>Uang Bayar</p>
                    <input type="text" name="customer_money" placeholder="Masukkan Uang Bayar" class="p-2 rounded-sm border border-slate-300" />
                </div>

                <div class="flex flex-col gap-2">
                    <p>Metode Pembayaran</p>

                    <div class="flex flex-row gap-2">
                        <div class="flex flex-row gap-2">
                            <input type="radio" name="payment_method" value="cash">
                            <label for="cash">Cash</label><br>
                        </div>

                        <div class="flex flex-row gap-2">
                            <input type="radio" name="payment_method" value="qris">
                            <label for="qris">QRIS</label><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>