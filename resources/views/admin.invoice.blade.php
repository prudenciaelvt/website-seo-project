<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <div class="login-container">
        <img src="{{ asset('assets/picture/pic_logoImersa.png') }}" alt="Logo IMERSA" class="logo">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Generate Invoice</title>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto my-10">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h1 class="text-2xl font-bold text-center mb-4">Generate Invoice</h1>
            <form>
                <div class="mb-4">
                    <label class="block text-gray-700">Email</label>
                    <input type="email" class="mt-1 p-2 w-full border border-gray-300 rounded" placeholder="Masukkan Email">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Penerima Invoice</label>
                    <textarea class="mt-1 p-2 w-full border border-gray-300 rounded" placeholder="Ex. PT Allena Corporation..."></textarea>
                </div>

                <p class="font-semibold mb-2">Produk atau jasa yang diambil (Pertama)</p>
                <div class="flex mb-4">
                    <label class="mr-4"><input type="radio" name="package1" value="Paket SEO"> Paket SEO</label>
                    <label class="mr-4"><input type="radio" name="package1" value="Paket Leads"> Paket Leads</label>
                    <label class="mr-4"><input type="radio" name="package1" value="Paket Iklan"> Paket Iklan</label>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Jumlah dari paket pertama</label>
                    <input type="number" class="mt-1 p-2 w-full border border-gray-300 rounded">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Harga paket pertama</label>
                    <input type="text" class="mt-1 p-2 w-full border border-gray-300 rounded">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Total harga paket pertama</label>
                    <input type="text" class="mt-1 p-2 w-full border border-gray-300 rounded">
                </div>

                <button type="button" class="bg-blue-600 text-white p-2 rounded">+ Tambah Paket</button>

                <div class="mb-4">
                    <label class="block text-gray-700">Total harga semua paket yang diambil client</label>
                    <input type="text" class="mt-1 p-2 w-full border border-gray-300 rounded">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Grand Total</label>
                    <input type="text" class="mt-1 p-2 w-full border border-gray-300 rounded">
                </div>

                <button type="submit" class="bg-green-600 text-white w-full p-2 rounded">Generate Invoice</button>
            </form>
        </div>
    </div>
</body>
</html>
