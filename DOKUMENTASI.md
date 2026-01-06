# DOKUMENTASI APLIKASI TOKO SEMBAKO

---

## 1. PENDAHULUAN

### 1.1 Latar Belakang

Dalam era digital saat ini, kebutuhan akan sistem manajemen toko yang efisien sangat penting untuk meningkatkan produktivitas dan pelayanan kepada pelanggan. Toko sembako tradisional seringkali menghadapi kendala dalam pencatatan stok, transaksi, dan pengelolaan produk secara manual.

Aplikasi Toko Sembako dikembangkan untuk menjawab tantangan tersebut dengan menyediakan sistem berbasis web yang memungkinkan pengelolaan toko secara digital. Aplikasi ini memfasilitasi admin dalam mengelola kategori produk, inventori barang, dan transaksi penjualan, serta menyediakan platform untuk customer melakukan pemesanan produk secara online.

### 1.2 Tujuan Aplikasi

Tujuan utama dari pengembangan aplikasi ini adalah:

1. **Memudahkan Pengelolaan Inventori**: Sistem yang terstruktur untuk mencatat dan mengelola stok produk, kategori, dan harga secara real-time.

2. **Meningkatkan Efisiensi Transaksi**: Mengotomatisasi proses pencatatan transaksi penjualan dan pengurangan stok secara otomatis.

3. **Menyediakan Platform Pemesanan Online**: Memberikan kemudahan bagi customer untuk melihat katalog produk dan melakukan pemesanan tanpa harus datang ke toko.

4. **Monitoring dan Pelaporan**: Menyediakan dashboard admin untuk monitoring transaksi, stok produk, dan statistik penjualan.

5. **Meningkatkan Pelayanan Customer**: Dengan katalog online yang informatif dan proses checkout yang mudah.

---

## 2. DESKRIPSI SISTEM

### 2.1 Gambaran Singkat Aplikasi

Aplikasi Toko Sembako adalah sistem manajemen toko berbasis web yang dibangun menggunakan framework **Laravel 11**. Aplikasi ini menerapkan arsitektur **MVC (Model-View-Controller)** dan dirancang dengan dua antarmuka utama:

#### **A. Area Admin (Backend)**
Area yang dilindungi dengan autentikasi untuk administrator toko, menyediakan:
- Dashboard dengan statistik penjualan dan stok
- Manajemen kategori produk (CRUD)
- Manajemen produk dengan upload gambar (CRUD)
- Manajemen transaksi penjualan (CRUD)
- Filter dan pencarian data

#### **B. Area Public (Frontend)**
Area yang dapat diakses oleh customer untuk:
- Melihat katalog produk dengan gambar dan informasi detail
- Filter produk berdasarkan kategori
- Pencarian produk
- Melihat detail produk dan produk terkait
- Melakukan checkout dan pemesanan
- Melihat konfirmasi pesanan

### 2.2 Fitur Utama

#### **Fitur Admin**

1. **Autentikasi & Otorisasi**
   - Login admin dengan validasi
   - Logout dan session management
   - Middleware untuk proteksi route admin

2. **Manajemen Kategori**
   - Tambah kategori baru dengan nama dan deskripsi
   - Edit informasi kategori
   - Hapus kategori
   - Lihat daftar produk per kategori
   - Status aktif/non-aktif kategori
   - Pagination dan counter jumlah produk

3. **Manajemen Produk**
   - Tambah produk baru dengan detail lengkap
   - Upload gambar produk
   - Edit informasi produk dan ganti gambar
   - Hapus produk (otomatis hapus gambar)
   - Monitoring stok real-time
   - Set harga, satuan, dan stok
   - Status aktif/non-aktif produk
   - Relasi dengan kategori

4. **Manajemen Transaksi**
   - Tambah transaksi penjualan manual
   - Validasi stok otomatis
   - Pengurangan stok otomatis saat transaksi
   - Lihat detail transaksi dengan info produk
   - Edit status transaksi (pending/selesai/batal)
   - Restore stok saat transaksi dibatalkan
   - Filter transaksi berdasarkan status dan tanggal
   - Pagination dan total harga otomatis

5. **Dashboard**
   - Total kategori, produk, dan transaksi
   - Total pendapatan
   - Produk stok menipis (early warning)
   - Transaksi terbaru
   - Statistik visualisasi

#### **Fitur Customer (Public)**

1. **Katalog Produk**
   - Tampilan grid produk dengan gambar
   - Informasi harga, stok, dan satuan
   - Filter berdasarkan kategori
   - Fitur pencarian produk
   - Pagination

2. **Detail Produk**
   - Informasi lengkap produk
   - Gambar produk ukuran besar
   - Kategori produk
   - Harga dan ketersediaan stok
   - Produk terkait (kategori sama)
   - Tombol checkout langsung

3. **Checkout & Pemesanan**
   - Form order dengan validasi
   - Input nama pembeli, jumlah, alamat, nomor telepon
   - Kalkulasi total harga otomatis
   - Konfirmasi ketersediaan stok
   - Pengurangan stok otomatis

4. **Halaman Sukses**
   - Konfirmasi pesanan berhasil
   - Detail pesanan dan total pembayaran
   - Informasi produk yang dipesan
   - Tombol kembali ke halaman utama

---

## 3. PERANCANGAN

### 3.1 Struktur Tabel & Relasi

Aplikasi ini menggunakan **4 tabel utama** dengan relasi yang terstruktur:

#### **Tabel: users**
Menyimpan data administrator sistem.

| Kolom | Tipe Data | Keterangan |
|-------|-----------|------------|
| id | BIGINT (PK) | Primary Key |
| name | VARCHAR | Nama admin |
| email | VARCHAR (UNIQUE) | Email login |
| email_verified_at | TIMESTAMP | Verifikasi email |
| password | VARCHAR | Password terenkripsi |
| remember_token | VARCHAR | Token remember me |
| created_at | TIMESTAMP | Waktu dibuat |
| updated_at | TIMESTAMP | Waktu diupdate |

---

#### **Tabel: categories**
Menyimpan data kategori produk.

| Kolom | Tipe Data | Keterangan |
|-------|-----------|------------|
| id | BIGINT (PK) | Primary Key |
| nama | VARCHAR | Nama kategori |
| deskripsi | TEXT | Deskripsi kategori |
| aktif | BOOLEAN | Status aktif (default: true) |
| created_at | TIMESTAMP | Waktu dibuat |
| updated_at | TIMESTAMP | Waktu diupdate |

**Relasi:**
- One-to-Many dengan `products` (Satu kategori memiliki banyak produk)

---

#### **Tabel: products**
Menyimpan data produk/barang.

| Kolom | Tipe Data | Keterangan |
|-------|-----------|------------|
| id | BIGINT (PK) | Primary Key |
| category_id | BIGINT (FK) | Foreign Key ke categories |
| nama | VARCHAR | Nama produk |
| deskripsi | TEXT | Deskripsi produk |
| harga | DECIMAL(12,2) | Harga produk |
| stok | INTEGER | Jumlah stok (default: 0) |
| satuan | VARCHAR | Satuan (pcs, kg, liter, dll) |
| gambar | VARCHAR | Path file gambar |
| aktif | BOOLEAN | Status aktif (default: true) |
| created_at | TIMESTAMP | Waktu dibuat |
| updated_at | TIMESTAMP | Waktu diupdate |

**Relasi:**
- BelongsTo dengan `categories` (Produk milik satu kategori)
- One-to-Many dengan `transactions` (Satu produk memiliki banyak transaksi)

**Constraint:**
- Foreign Key `category_id` → `categories.id` (ON DELETE CASCADE)

---

#### **Tabel: transactions**
Menyimpan data transaksi penjualan.

| Kolom | Tipe Data | Keterangan |
|-------|-----------|------------|
| id | BIGINT (PK) | Primary Key |
| product_id | BIGINT (FK) | Foreign Key ke products |
| nama_pembeli | VARCHAR | Nama customer |
| jumlah | INTEGER | Jumlah produk dibeli |
| total_harga | DECIMAL(12,2) | Total harga transaksi |
| status | ENUM | Status: pending/selesai/batal |
| alamat | TEXT | Alamat pengiriman |
| no_telepon | VARCHAR | Nomor telepon customer |
| created_at | TIMESTAMP | Waktu transaksi |
| updated_at | TIMESTAMP | Waktu diupdate |

**Relasi:**
- BelongsTo dengan `products` (Transaksi milik satu produk)

**Constraint:**
- Foreign Key `product_id` → `products.id` (ON DELETE CASCADE)

---

### 3.2 Diagram Relasi (ERD)

```
┌─────────────────┐
│     USERS       │
│─────────────────│
│ id (PK)         │
│ name            │
│ email (UNIQUE)  │
│ password        │
└─────────────────┘

┌─────────────────────┐
│    CATEGORIES       │
│─────────────────────│
│ id (PK)             │
│ nama                │
│ deskripsi           │
│ aktif               │
└──────────┬──────────┘
           │
           │ 1:N
           │
┌──────────▼──────────────────┐
│       PRODUCTS              │
│─────────────────────────────│
│ id (PK)                     │
│ category_id (FK)            │
│ nama                        │
│ deskripsi                   │
│ harga                       │
│ stok                        │
│ satuan                      │
│ gambar                      │
│ aktif                       │
└──────────┬──────────────────┘
           │
           │ 1:N
           │
┌──────────▼──────────────────┐
│     TRANSACTIONS            │
│─────────────────────────────│
│ id (PK)                     │
│ product_id (FK)             │
│ nama_pembeli                │
│ jumlah                      │
│ total_harga                 │
│ status                      │
│ alamat                      │
│ no_telepon                  │
└─────────────────────────────┘
```

---

### 3.3 Controller yang Digunakan

Aplikasi ini menggunakan **5 Controller Utama** yang menangani berbagai fungsi:

#### **1. CategoryController**
**Lokasi:** `app/Http/Controllers/CategoryController.php`

**Fungsi:**
- `index()` - Menampilkan daftar kategori dengan pagination dan counter produk
- `create()` - Menampilkan form tambah kategori
- `store()` - Menyimpan kategori baru ke database
- `show()` - Menampilkan detail kategori dan produk-produknya
- `edit()` - Menampilkan form edit kategori
- `update()` - Mengupdate data kategori
- `destroy()` - Menghapus kategori

**Fitur Khusus:**
- Menggunakan FormRequest (StoreCategoryRequest, UpdateCategoryRequest)
- Menghitung jumlah produk per kategori dengan `withCount()`
- Eager loading relasi products

---

#### **2. ProductController**
**Lokasi:** `app/Http/Controllers/ProductController.php`

**Fungsi:**
- `index()` - Menampilkan daftar produk dengan pagination
- `create()` - Menampilkan form tambah produk dengan dropdown kategori aktif
- `store()` - Menyimpan produk baru dengan upload gambar
- `show()` - Menampilkan detail produk dan riwayat transaksi
- `edit()` - Menampilkan form edit produk
- `update()` - Mengupdate data produk dan replace gambar lama
- `destroy()` - Menghapus produk dan file gambar

**Fitur Khusus:**
- Upload dan delete file gambar di storage public
- Eager loading relasi category dan transactions
- Validasi dengan FormRequest (StoreProductRequest, UpdateProductRequest)
- Otomatis hapus gambar lama saat update atau delete

---

#### **3. TransactionController**
**Lokasi:** `app/Http/Controllers/TransactionController.php`

**Fungsi:**
- `index()` - Menampilkan daftar transaksi dengan filter status dan tanggal
- `create()` - Menampilkan form tambah transaksi dengan dropdown produk tersedia
- `store()` - Menyimpan transaksi dengan validasi stok dan pengurangan stok otomatis
- `show()` - Menampilkan detail transaksi
- `edit()` - Menampilkan form edit status transaksi
- `update()` - Mengupdate status transaksi dengan restore stok jika dibatalkan
- `destroy()` - Menghapus transaksi dengan restore stok

**Fitur Khusus:**
- Database transaction (DB::beginTransaction, commit, rollback)
- Validasi stok sebelum transaksi
- Otomatis menghitung total harga (harga × jumlah)
- Auto-decrement dan increment stok produk
- Filter berdasarkan status dan tanggal
- Eager loading relasi product dan category

---

#### **4. PublicController**
**Lokasi:** `app/Http/Controllers/PublicController.php`

**Fungsi:**
- `index()` - Menampilkan katalog produk untuk customer dengan filter dan search
- `show()` - Menampilkan detail produk dan produk terkait
- `checkout()` - Menampilkan form checkout untuk produk tertentu
- `order()` - Memproses pesanan dari customer dengan validasi stok
- `success()` - Menampilkan halaman konfirmasi pesanan berhasil

**Fitur Khusus:**
- Filter produk berdasarkan kategori dan pencarian
- Hanya menampilkan produk aktif dan stok > 0
- Menampilkan produk terkait (same category)
- Validasi stok real-time sebelum order
- Database transaction untuk keamanan data
- Auto-decrement stok saat order berhasil

---

#### **5. DashboardController**
**Lokasi:** `app/Http/Controllers/DashboardController.php`

**Fungsi:**
- `index()` - Menampilkan dashboard admin dengan statistik

**Fitur Khusus:**
- Total kategori, produk, dan transaksi
- Total pendapatan dari transaksi selesai
- Produk dengan stok menipis (warning alert)
- Transaksi terbaru
- Menggunakan aggregat query (count, sum)

---

#### **6. LoginController**
**Lokasi:** `app/Http/Controllers/Auth/LoginController.php`

**Fungsi:**
- `showLoginForm()` - Menampilkan halaman login admin
- `login()` - Memproses autentikasi admin
- `logout()` - Logout dan destroy session

**Fitur Khusus:**
- Menggunakan Laravel Authentication
- Validasi credentials
- Redirect ke dashboard jika berhasil
- Remember me functionality

---

### 3.4 Routing Structure

Aplikasi menggunakan 3 grup routing:

#### **Public Routes**
```php
GET  /                      → PublicController@index
GET  /produk/{id}           → PublicController@show
GET  /checkout/{id}         → PublicController@checkout
POST /order                 → PublicController@order
GET  /success/{id}          → PublicController@success
```

#### **Authentication Routes**
```php
GET  /login                 → LoginController@showLoginForm
POST /login                 → LoginController@login
POST /logout                → LoginController@logout
```

#### **Protected Admin Routes (middleware: auth)**
```php
GET  /admin                 → DashboardController@index

// Resource Routes (7 route otomatis per resource)
categories.*                → CategoryController
products.*                  → ProductController
transactions.*              → TransactionController
```

---

## 4. IMPLEMENTASI

### 4.1 Penjelasan CRUD

Aplikasi ini mengimplementasikan operasi **CRUD (Create, Read, Update, Delete)** pada 3 modul utama:

---

#### **A. CRUD Kategori**

##### **Create (Tambah Kategori)**
1. Admin mengakses menu Kategori → Tambah Kategori
2. Mengisi form: Nama Kategori, Deskripsi, Status Aktif
3. Sistem memvalidasi input menggunakan `StoreCategoryRequest`
4. Data disimpan ke tabel `categories`
5. Redirect ke halaman daftar kategori dengan pesan sukses

**Kode Controller:**
```php
public function store(StoreCategoryRequest $request)
{
    $data = $request->validated();
    $data['aktif'] = $request->has('aktif');
    Category::create($data);
    return redirect()->route('categories.index')
        ->with('success', 'Kategori berhasil ditambahkan!');
}
```

##### **Read (Lihat Kategori)**
1. Menampilkan daftar semua kategori dengan pagination
2. Menghitung jumlah produk per kategori menggunakan `withCount()`
3. Menampilkan detail kategori beserta produk-produknya

**Kode Controller:**
```php
public function index()
{
    $categories = Category::withCount('products')->latest()->paginate(10);
    return view('categories.index', compact('categories'));
}
```

##### **Update (Edit Kategori)**
1. Admin memilih kategori yang akan diedit
2. Form otomatis terisi dengan data kategori
3. Admin mengubah data yang diperlukan
4. Sistem memvalidasi dan mengupdate data ke database
5. Redirect dengan pesan sukses

**Kode Controller:**
```php
public function update(UpdateCategoryRequest $request, Category $category)
{
    $data = $request->validated();
    $data['aktif'] = $request->has('aktif');
    $category->update($data);
    return redirect()->route('categories.index')
        ->with('success', 'Kategori berhasil diperbarui!');
}
```

##### **Delete (Hapus Kategori)**
1. Admin mengklik tombol hapus pada kategori
2. Sistem menampilkan konfirmasi (optional)
3. Data kategori dihapus dari database
4. Produk terkait juga terhapus (CASCADE)
5. Redirect dengan pesan sukses

**Kode Controller:**
```php
public function destroy(Category $category)
{
    $category->delete();
    return redirect()->route('categories.index')
        ->with('success', 'Kategori berhasil dihapus!');
}
```

---

#### **B. CRUD Produk**

##### **Create (Tambah Produk)**
1. Admin mengakses menu Produk → Tambah Produk
2. Mengisi form: Kategori, Nama, Deskripsi, Harga, Stok, Satuan, Upload Gambar, Status
3. Sistem memvalidasi input menggunakan `StoreProductRequest`
4. Upload gambar ke `storage/app/public/products/`
5. Simpan path gambar dan data produk ke database
6. Redirect dengan pesan sukses

**Kode Controller:**
```php
public function store(StoreProductRequest $request)
{
    $data = $request->validated();
    $data['aktif'] = $request->has('aktif');
    
    if ($request->hasFile('gambar')) {
        $data['gambar'] = $request->file('gambar')->store('products', 'public');
    }
    
    Product::create($data);
    return redirect()->route('products.index')
        ->with('success', 'Produk berhasil ditambahkan!');
}
```

##### **Read (Lihat Produk)**
1. Menampilkan daftar produk dengan informasi kategori
2. Pagination 10 item per halaman
3. Detail produk menampilkan semua informasi termasuk riwayat transaksi
4. Tampilkan gambar produk

**Kode Controller:**
```php
public function index()
{
    $products = Product::with('category')->latest()->paginate(10);
    return view('products.index', compact('products'));
}
```

##### **Update (Edit Produk)**
1. Admin memilih produk yang akan diedit
2. Form terisi otomatis dengan data produk
3. Admin dapat mengubah data dan mengganti gambar
4. Jika gambar baru diupload, hapus gambar lama
5. Update data ke database
6. Redirect dengan pesan sukses

**Kode Controller:**
```php
public function update(UpdateProductRequest $request, Product $product)
{
    $data = $request->validated();
    $data['aktif'] = $request->has('aktif');
    
    if ($request->hasFile('gambar')) {
        if ($product->gambar) {
            Storage::disk('public')->delete($product->gambar);
        }
        $data['gambar'] = $request->file('gambar')->store('products', 'public');
    }
    
    $product->update($data);
    return redirect()->route('products.index')
        ->with('success', 'Produk berhasil diperbarui!');
}
```

##### **Delete (Hapus Produk)**
1. Admin mengklik tombol hapus
2. Sistem hapus file gambar dari storage
3. Hapus data produk dari database
4. Transaksi terkait juga terhapus (CASCADE)
5. Redirect dengan pesan sukses

**Kode Controller:**
```php
public function destroy(Product $product)
{
    if ($product->gambar) {
        Storage::disk('public')->delete($product->gambar);
    }
    $product->delete();
    return redirect()->route('products.index')
        ->with('success', 'Produk berhasil dihapus!');
}
```

---

#### **C. CRUD Transaksi**

##### **Create (Tambah Transaksi)**
1. Admin mengakses menu Transaksi → Tambah Transaksi
2. Pilih produk yang tersedia (aktif & stok > 0)
3. Isi form: Nama Pembeli, Jumlah, Alamat, No. Telepon
4. Sistem validasi stok produk
5. Hitung total harga otomatis (harga × jumlah)
6. Simpan transaksi ke database
7. Kurangi stok produk secara otomatis
8. Redirect ke detail transaksi

**Kode Controller:**
```php
public function store(StoreTransactionRequest $request)
{
    DB::beginTransaction();
    try {
        $product = Product::findOrFail($request->product_id);
        
        if ($product->stok < $request->jumlah) {
            return back()->with('error', 'Stok tidak mencukupi!');
        }
        
        $totalHarga = $product->harga * $request->jumlah;
        
        $transaction = Transaction::create([
            'product_id' => $request->product_id,
            'nama_pembeli' => $request->nama_pembeli,
            'jumlah' => $request->jumlah,
            'total_harga' => $totalHarga,
            'status' => 'selesai',
            'alamat' => $request->alamat,
            'no_telepon' => $request->no_telepon,
        ]);
        
        $product->decrement('stok', $request->jumlah);
        
        DB::commit();
        return redirect()->route('transactions.show', $transaction)
            ->with('success', 'Transaksi berhasil!');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Terjadi kesalahan!');
    }
}
```

##### **Read (Lihat Transaksi)**
1. Menampilkan daftar transaksi dengan informasi produk
2. Filter berdasarkan status (pending/selesai/batal)
3. Filter berdasarkan tanggal
4. Pagination 15 item per halaman
5. Detail transaksi menampilkan semua informasi lengkap

**Kode Controller:**
```php
public function index(Request $request)
{
    $query = Transaction::with('product.category');
    
    if ($request->has('status') && $request->status != '') {
        $query->where('status', $request->status);
    }
    
    if ($request->has('date') && $request->date != '') {
        $query->whereDate('created_at', $request->date);
    }
    
    $transactions = $query->latest()->paginate(15);
    return view('transactions.index', compact('transactions'));
}
```

##### **Update (Edit Status Transaksi)**
1. Admin dapat mengubah status transaksi
2. Jika status diubah dari 'selesai' ke 'batal', stok produk dikembalikan
3. Jika status diubah dari 'batal' ke 'selesai', stok produk dikurangi
4. Update data ke database
5. Redirect dengan pesan sukses

##### **Delete (Hapus Transaksi)**
1. Admin mengklik tombol hapus
2. Jika status transaksi 'selesai', stok produk dikembalikan
3. Hapus data transaksi dari database
4. Redirect dengan pesan sukses

---

### 4.2 Contoh Tampilan Aplikasi

#### **A. Area Admin**

##### **1. Halaman Login**
- Form login dengan email dan password
- Checkbox "Remember Me"
- Validasi error ditampilkan jika login gagal
- Redirect ke dashboard setelah login berhasil

**URL:** `/login`

---

##### **2. Dashboard Admin**
Menampilkan:
- **Card Statistik:**
  - Total Kategori
  - Total Produk
  - Total Transaksi
  - Total Pendapatan
- **Tabel Produk Stok Menipis:**
  - Daftar produk dengan stok < 10
  - Warning badge merah
- **Tabel Transaksi Terbaru:**
  - 10 transaksi terakhir
  - Status transaksi dengan badge warna
  - Total harga

**URL:** `/admin`

---

##### **3. Halaman Daftar Kategori**
Menampilkan:
- Tombol "Tambah Kategori"
- Tabel daftar kategori:
  - Nama Kategori
  - Deskripsi
  - Jumlah Produk
  - Status (Aktif/Tidak Aktif)
  - Aksi: Lihat, Edit, Hapus
- Pagination
- Flash message sukses/error

**URL:** `/categories`

---

##### **4. Form Tambah/Edit Kategori**
Form berisi:
- Input Nama Kategori (required)
- Textarea Deskripsi
- Checkbox Status Aktif
- Tombol Simpan dan Batal
- Validasi error ditampilkan per field

**URL:** `/categories/create` atau `/categories/{id}/edit`

---

##### **5. Halaman Daftar Produk**
Menampilkan:
- Tombol "Tambah Produk"
- Tabel daftar produk:
  - Gambar Produk (thumbnail)
  - Nama Produk
  - Kategori
  - Harga (format Rupiah)
  - Stok (dengan badge warning jika < 10)
  - Satuan
  - Status (Aktif/Tidak Aktif)
  - Aksi: Lihat, Edit, Hapus
- Pagination
- Flash message

**URL:** `/products`

---

##### **6. Form Tambah/Edit Produk**
Form berisi:
- Dropdown Kategori (hanya kategori aktif)
- Input Nama Produk (required)
- Textarea Deskripsi
- Input Harga (numeric, required)
- Input Stok (numeric, required)
- Input Satuan (default: pcs)
- Upload Gambar (image, max 2MB)
- Preview gambar saat ini (untuk edit)
- Checkbox Status Aktif
- Tombol Simpan dan Batal
- Validasi error

**URL:** `/products/create` atau `/products/{id}/edit`

---

##### **7. Halaman Daftar Transaksi**
Menampilkan:
- Tombol "Tambah Transaksi"
- Filter:
  - Dropdown Status (Semua, Pending, Selesai, Batal)
  - Input Tanggal
  - Tombol Filter dan Reset
- Tabel daftar transaksi:
  - ID Transaksi
  - Tanggal
  - Nama Pembeli
  - Produk (dengan kategori)
  - Jumlah
  - Total Harga (format Rupiah)
  - Status (badge warna: kuning/hijau/merah)
  - Aksi: Lihat, Edit, Hapus
- Pagination
- Flash message

**URL:** `/transactions`

---

##### **8. Form Tambah Transaksi**
Form berisi:
- Dropdown Produk (hanya produk aktif & stok > 0)
- Tampilkan info harga dan stok tersedia
- Input Nama Pembeli (required)
- Input Jumlah (numeric, required, max: stok tersedia)
- Kalkulasi total harga otomatis (real-time)
- Textarea Alamat
- Input No. Telepon
- Tombol Simpan dan Batal
- Validasi error

**URL:** `/transactions/create`

---

##### **9. Detail Transaksi**
Menampilkan:
- Card informasi transaksi:
  - ID & Tanggal Transaksi
  - Status dengan badge
  - Nama Pembeli
  - Alamat & No. Telepon
- Card informasi produk:
  - Gambar Produk
  - Nama & Kategori
  - Harga Satuan
  - Jumlah Dibeli
  - Total Harga (highlighted)
- Tombol: Kembali, Edit, Hapus

**URL:** `/transactions/{id}`

---

#### **B. Area Public (Customer)**

##### **1. Halaman Katalog Produk**
Menampilkan:
- Header dengan nama toko dan menu
- Sidebar filter:
  - Daftar kategori dengan jumlah produk
  - Search box
- Grid produk (4 kolom):
  - Gambar produk
  - Nama produk
  - Kategori (badge)
  - Harga (format Rupiah, besar dan bold)
  - Stok tersedia
  - Tombol "Lihat Detail"
- Pagination
- Responsive design

**URL:** `/`

---

##### **2. Halaman Detail Produk**
Menampilkan:
- Breadcrumb navigasi
- Layout 2 kolom:
  - **Kiri:** Gambar produk besar
  - **Kanan:**
    - Nama produk (heading)
    - Kategori (badge)
    - Harga (besar, warna primary)
    - Stok tersedia (badge)
    - Satuan
    - Deskripsi lengkap
    - Tombol "Checkout" (besar, call-to-action)
- Section "Produk Terkait":
  - Grid produk dengan kategori sama
  - 4 produk terkait
- Tombol kembali ke katalog

**URL:** `/produk/{id}`

---

##### **3. Halaman Checkout**
Menampilkan:
- Card informasi produk yang akan dibeli:
  - Gambar produk
  - Nama & kategori
  - Harga satuan
  - Stok tersedia
- Form order:
  - Input Nama Pembeli (required)
  - Input Jumlah (numeric, max: stok, required)
  - Tampilan Total Harga (kalkulasi real-time)
  - Textarea Alamat Pengiriman (required)
  - Input No. Telepon (required)
  - Tombol "Konfirmasi Pesanan" (besar)
  - Tombol "Batal"
- Validasi error

**URL:** `/checkout/{id}`

---

##### **4. Halaman Sukses Pemesanan**
Menampilkan:
- Icon centang hijau besar
- Pesan "Pesanan Berhasil!"
- Card detail pesanan:
  - ID Transaksi
  - Tanggal & Waktu
  - Nama Pembeli
  - Produk yang dipesan
  - Jumlah
  - **Total Pembayaran** (highlighted, besar)
  - Alamat Pengiriman
  - No. Telepon
- Informasi: "Pesanan Anda sedang diproses"
- Tombol "Kembali ke Beranda" (besar, primary)

**URL:** `/success/{id}`

---

### 4.3 Teknologi yang Digunakan

#### **Backend:**
- **Framework:** Laravel 11
- **Language:** PHP 8.2+
- **Database:** MySQL
- **ORM:** Eloquent

#### **Frontend:**
- **Template Engine:** Blade
- **CSS Framework:** Bootstrap 5 / Tailwind CSS
- **JavaScript:** Vanilla JS / Alpine.js
- **Icons:** Bootstrap Icons / Font Awesome

#### **Tools:**
- **Development Server:** XAMPP / Laravel Valet
- **Dependency Manager:** Composer (PHP), NPM (JS)
- **Version Control:** Git
- **Module Bundler:** Vite

---

### 4.4 Keamanan & Validasi

1. **Autentikasi:**
   - Menggunakan Laravel Authentication
   - Password di-hash dengan bcrypt
   - Session-based authentication
   - Middleware `auth` untuk proteksi route admin

2. **Validasi Input:**
   - Form Request Validation
   - CSRF Protection pada semua form POST
   - XSS Protection (Laravel escaping otomatis)
   - File upload validation (type, size)

3. **Database Security:**
   - Eloquent ORM (mencegah SQL Injection)
   - Foreign Key Constraints
   - Transaction untuk operasi critical
   - Soft deletes (optional)

4. **File Management:**
   - Upload ke storage terpisah dari public root
   - Validasi tipe file image
   - Max file size limit
   - Auto-delete orphan files

---

## 5. KESIMPULAN

Aplikasi Toko Sembako merupakan sistem manajemen toko yang komprehensif dengan fitur lengkap untuk admin dan customer. Dibangun dengan framework Laravel 11, aplikasi ini menawarkan:

### **Keunggulan:**
- ✅ **Arsitektur MVC yang terstruktur**
- ✅ **CRUD lengkap untuk 3 modul utama**
- ✅ **Manajemen stok otomatis**
- ✅ **Upload dan manajemen gambar produk**
- ✅ **Filter dan pencarian yang powerful**
- ✅ **Transaksi database untuk data integrity**
- ✅ **Responsive design untuk berbagai device**
- ✅ **Validasi input yang ketat**
- ✅ **Autentikasi dan otorisasi yang aman**
- ✅ **Dashboard statistik real-time**

### **Fitur Utama:**
1. **Admin Panel** - Manajemen kategori, produk, dan transaksi
2. **Katalog Online** - Customer dapat browsing dan order produk
3. **Manajemen Stok** - Otomatis update saat transaksi
4. **Multi-Filter** - Filter berdasarkan kategori, status, tanggal
5. **Image Upload** - Upload dan display gambar produk
6. **Transaction Management** - Monitoring dan tracking transaksi

### **Kemungkinan Pengembangan:**
- 📱 **API Backend** untuk mobile app
- 💳 **Payment Gateway Integration**
- 📧 **Email/SMS Notification**
- 📊 **Advanced Analytics & Reports**
- 👥 **Multiple User Roles** (Kasir, Manager, Owner)
- 🛒 **Shopping Cart** untuk multiple items
- ⭐ **Rating & Review System**
- 📦 **Shipping Integration**
- 🎯 **Loyalty Program**
- 📈 **Sales Forecasting**

---

**Dibuat:** Januari 2026  
**Framework:** Laravel 11  
**Versi Dokumentasi:** 1.0

---
