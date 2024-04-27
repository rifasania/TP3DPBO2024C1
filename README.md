# TP3DPBO2024C1

# JANJI
Saya Rifa Sania NIM 2206697 mengerjakan Tugas Praktikum 3 dalam mata kuliah Desain Pemrograman Berorientasi Objek
untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin...

# FITUR
1. CRUD Laptop
2. CRUD Merk
3. CRUD RAM
4. Search Laptop

1. Setiap file PHP yang dimulai dengan include digunakan untuk memuat file-file pendukung seperti konfigurasi database, kelas-kelas, dan template.
2. Kemudian, objek-objek dari kelas-kelas yang diperlukan untuk mengelola data (seperti Merk, Ram, dan Laptop) dibuat.
3. Pada file tambahlaptop.php, ketika pengguna menekan tombol "Simpan", data yang diambil dari formulir disimpan ke dalam array $data, kemudian metode addLaptop() dari objek Laptop dipanggil untuk menambahkan data laptop ke database.
4. File tambahmerk.php dan tambahram.php memiliki alur yang serupa dengan tambahlaptop.php, namun untuk menambahkan data merk dan data RAM.
5. File updatelaptop.php, updatemerk.php, dan updateram.php digunakan untuk mengelola proses update data yang sesuai dengan objek yang berkaitan (laptop, merk, atau RAM). Saat tombol "Simpan" ditekan, data yang diambil dari formulir akan disimpan ke dalam array, kemudian metode update() yang sesuai dari objek yang berkaitan dipanggil untuk melakukan pembaruan data di database.
Setelah proses penambahan atau pembaruan selesai, pengguna akan diberi tahu apakah operasi tersebut berhasil atau tidak melalui pesan alert yang ditampilkan.
6. Setiap file PHP yang mengelola proses formulir juga menggunakan template untuk menampilkan tampilan formulir yang sesuai. Template ini diisi dengan data dinamis seperti judul, opsi-opsi pada dropdown, dan tombol-tombol aksi.