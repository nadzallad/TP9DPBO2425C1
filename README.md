//Janji

Saya Nadzalla Diva Asmara Sutedja dengan Nim 2408095 mengerjakan Tugas Praktikum 9 dalam mata kuliah Desain dan Pemrograman Berorientasi Objek untuk keberkahan-Nya maka saya tidak akan melakukan kecurangan seperti yang telah di spesifikasikan

//Desain Program 
Struktur program ini dibagi menjadi beberapa folder, yaitu folder models, folder views, folder presenters.Dalam folder models, terdapat class seperti PembalapModel.php dan SirkuitModel.php. Keduanya bertanggung jawab melakukan operasi data ke database menggunakan bantuan DB.php. Setiap model memiliki pola fungsi yang konsisten dan terdapat Kontrak Model, yaitu KontrakModelPembalap.php dan KontrakModelSirkuit.php. Interface ini menentukan fungsi-fungsi dasar seperti getAll(), getById(), add(), update(), dan delete() yang harus dimiliki. Selain model database, folder ini juga berisi class entitas seperti Pembalap.php dan Sirkuit.php yang merepresentasikan satu objek data lengkap dengan property serta getter dan setter.
Dalam folder views, terdapat class ViewPembalap.php dan ViewSirkuit.php. Folder ini bertugas menyiapkan bagian tampilan berupa HTML. View menerima data dari Presenter lalu menyisipkannya ke dalam template seperti skin.html, skin_sirkuit.html, form_pembalap.html, atau form_sirkuit.html. View tidak memproses logika apa pun; tugasnya hanya membentuk tampilan final yang akan diberikan ke browser. Untuk mencegah data berbahaya, view menggunakan fungsi seperti htmlspecialchars() sehingga setiap output aman dari injeksi.
Pada folder presenters, terdapat class PresenterPembalap.php dan PresenterSirkuit.php. Presenteri. Presenter memanggil model untuk mengambil data, membuat objek entitas, menyimpannya dalam list internal, dan menjalankan operasi tambah, ubah, maupun hapus. Ketika data berubah, Presenter memperbarui database melalui model lalu mengatur ulang list objek agar tetap sesuai. Setelah data siap ditampilkan, Presenter memanggil view untuk membuat tampilan dalam bentuk HTML. Agar struktur presenter tetap seragam, terdapat interface seperti KontrakPresenterPembalap.php dan KontrakPresenterSirkuit.php yang mendefinisikan fungsi wajib seperti menampilkan data, menampilkan form, serta operasi CRUD.
Di luar folder-folder tersebut, terdapat file penting yaitu index.php. File ini berfungsi sebagai pusat alur aplikasi. Saat halaman dibuka, index.php membuat objek Model, View, dan Presenter untuk pembalap dan sirkuit. File ini juga membaca parameter GET dan POST untuk menentukan apakah pengguna ingin melihat list, membuka form tambah/ubah, atau melakukan aksi CRUD. Index.php kemudian mengarahkan permintaan tersebut ke presenter yang sesuai. Setelah presenter menghasilkan HTML melalui view, index.php memasukkan tampilan tersebut ke dalam template utama seperti index.html agar seluruh halaman memiliki gaya yang sama, termasuk pengaturan tab aktif (pembalap atau sirkuit).



//Alur Program
Alur program dimulai ketika membuka halaman index.php, yang bertindak sebagai pengendali request. File ini memuat seluruh Model, View, Presenter, serta template HTML utama. Setelah semua class di-load, sistem menginisialisasi Presenter untuk Pembalap dan Sirkuit. Pada tahap ini Presenter otomatis mengambil data dari Model dan menyimpannya dalam list internal sebagai representasi awal data yang siap ditampilkan.

Setelah inisialisasi selesai, index.php menentukan tampilan aktif berdasarkan parameter GET, misalnya ?tab=pembalap atau ?tab=sirkuit. Jika tab pembalap aktif, maka semua perintah seperti add, edit, update, atau delete akan diteruskan ke PresenterPembalap. Begitu pula jika tab sirkuit aktif, maka request diarahkan ke PresenterSirkuit. Jika pengguna menekan tombol tambah atau mengklik tombol edit, Presenter mengirimkan data ke View untuk ditampilkan dalam bentuk form HTML yang siap diisi. Jika ada request POST, seperti saat menambah atau mengubah data, Presenter membaca input tersebut dan memanggil Model untuk menjalankan query SQL, kemudian memperbarui list datanya sendiri agar tampilan tetap sinkron dengan database.

Jika tidak ada aksi khusus, Presenter akan menghasilkan tampilan daftar data, yang kemudian dilewatkan ke template utama index.html melalui fungsi wrapWithTemplate(). Template ini bertugas memberikan struktur UI, seperti header, tab navigasi, dan area konten. Tab yang sedang aktif diberi penanda visual melalui highlight agar pengguna tahu mereka sedang berada di modul Pembalap atau modul Sirkuit. Setelah template diproses, HTML final dikirim ke browser untuk ditampilkan kepada pengguna.

Alur ini berlangsung setiap kali melakukan aksi apa pun: klik tab, klik tambah, submit form, menghapus data, atau menyegarkan halaman. Seluruh alur memastikan bahwa Presenter menjadi pusat logika, View hanya bertugas menampilkan, Model menangani database, dan index.php mengatur perpindahan data dari satu bagian ke bagian lainnya.


//Dokumentasi
1.  Dokumentasi aksi CRUD tabel Pembalap
2.  Dokumentasi aksi CRUD table Sirkuit
3.  
