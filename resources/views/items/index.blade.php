{{-- <!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Daftar Aset IT</title>
<style>
:root {
    --primary-pink: #d81b60;
    --light-pink: #f8bbd0;
    --bg-light: #f4f4f7;
    --text-dark: #333;
    --sidebar-width: 250px;
}
body {
    font-family: sans-serif;
    margin: 0;
    background-color: var(--bg-light);
    color: var(--text-dark);
    display: flex;
}

/* Sidebar */
.sidebar {
    width: var(--sidebar-width);
    min-height: 100vh;
    background-color: white;
    color: var(--text-dark);
    box-shadow: 2px 0 5px rgba(0,0,0,0.1);
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1000;
    transition: transform 0.3s ease;
}
.sidebar-header {
    padding: 15px;
    text-align: center;
    font-weight: bold;
    color: var(--primary-pink);
    font-size: 1.2em;
    border-bottom: 1px solid #eee;
}
.sidebar-menu {
    list-style: none;
    padding: 15px 0;
    margin: 0;
}
.sidebar-menu li a {
    display: flex;
    align-items: center;
    padding: 12px 20px;
    text-decoration: none;
    color: var(--text-dark);
    transition: background-color 0.2s, color 0.2s;
    font-size: 15px;
}
.sidebar-menu li a:hover,
.sidebar-menu li a.active {
    background-color: var(--light-pink);
    color: var(--primary-pink);
    border-right: 3px solid var(--primary-pink);
}
.sidebar-menu li a span {
    margin-right: 10px;
    font-size: 18px;
}

/* Main Content */
.main-content {
    flex-grow: 1;
    margin-left: var(--sidebar-width);
    padding: 20px;
}
.container { padding: 0; max-width: 1200px; margin: 0 auto; }

/* Header Hamburger (mobile) */
.header {
    background-color: white;
    padding: 10px 20px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    display: none;
    align-items: center;
    justify-content: flex-start;
    position: sticky;
    top: 0;
    z-index: 999;
}
.hamburger-btn {
    background: none;
    border: none;
    font-size: 24px;
    cursor: pointer;
    padding: 5px 10px;
    margin-right: 15px;
    color: var(--primary-pink);
}

/* Card Dashboard */
.card-container {
    display: flex;
    gap: 20px;
    margin-bottom: 30px;
    flex-wrap: wrap;
}
.info-card {
    background-color: white;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    width: 23%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    transition: transform 0.2s;
    min-width: 200px;
}
.info-card:hover { transform: translateY(-3px); }
.card-content h4 { margin: 0; font-size: 14px; color: #6c757d; }
.card-content p { margin: 5px 0 0; font-size: 28px; font-weight: bold; color: var(--text-dark); }
.card-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 20px;
    color: white;
    box-shadow: 0 2px 4px rgba(0,0,0,0.2);
}
.icon-data { background-color: #6a1b9a; }
.icon-masuk { background-color: #43a047; }
.icon-keluar { background-color: #ffb300; }
.icon-kategori { background-color: var(--primary-pink); }

/* Toolbar */
.toolbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: white;
    padding: 12px 15px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    margin-bottom: 20px;
    flex-wrap: wrap;
    gap: 10px;
}
.filter-group, .search-group { display: flex; gap: 10px; flex-wrap: wrap; }
.filter-group select, .toolbar button, .toolbar input {
    padding: 7px 10px;
    border: 1px solid #ced4da;
    border-radius: 4px;
    font-size: 14px;
}
.toolbar button { background-color: var(--primary-pink); color: white; border: none; cursor: pointer; transition: background-color 0.2s; }
.toolbar button:hover { background-color: #c2185b; }
.reset-btn { background-color: #f8f9fa !important; color: var(--text-dark) !important; border: 1px solid #ced4da !important; }

/* Table */
.table-responsive { background-color: white; padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); overflow-x: auto; }
table { width: 100%; border-collapse: collapse; min-width: 600px; }
th, td { border: 1px solid #dee2e6; padding: 12px; text-align: left; }
th { background-color: var(--light-pink); font-weight: bold; text-transform: uppercase; color: var(--text-dark); }

/* Action buttons */
.action-links a, .delete-btn { margin-right: 5px; text-decoration: none; padding: 4px 8px; border-radius: 3px; font-size: 12px; }
.edit-btn { background-color: #ffc107; color: #333; }
.detail-btn { background-color: var(--primary-pink); color: white; }
.delete-btn { background-color: #dc3545; color: white; border: none; cursor: pointer; }

/* Media Queries */
@media (max-width: 992px) {
    .header { display: flex; }
    .sidebar { transform: translateX(-100%); }
    .sidebar.active { transform: translateX(0); }
    .main-content { margin-left: 0; }
    .container { padding: 0 15px; }
}
</style>
</head>
<body>

<nav class="sidebar" id="sidebar">
    <div class="sidebar-header">Aset Barang</div>
    <ul class="sidebar-menu">
        <li><a href="#" class="active"><span>&#x1F4CB;</span> Dashboard</a></li>
        <li><a href="#"><span>&#x1F4E6;</span> Data Barang</a></li>
        <li><a href="#"><span>&#x1F4E6;</span> Daftar Barang</a></li>
        <li><a href="#"><span>&#x2B07;</span> Barang Masuk</a></li>
        <li><a href="#"><span>&#x2B06;</span> Barang Keluar</a></li>
        <li><a href="#"><span>&#x1F504;</span> Mutasi Barang</a></li>
        <li><hr style="border: 0; border-top: 1px solid #eee; margin: 10px 20px;"></li>
        <li><a href="#"><span>&#x1F464;</span> User</a></li>
    </ul>
</nav>

<div class="main-content">
    <div class="header">
        <button class="hamburger-btn" id="hamburger-btn">&#9776;</button>
        <span style="font-weight: bold;">Dashboard</span>
    </div>

    <div class="container">

        <div class="card-container">
            <div class="info-card">
                <div class="card-content">
                    <h4>Total Data Aset</h4>
                    <p>{{ count($items) }}</p>
                </div>
                <div class="card-icon icon-data">📦</div>
            </div>
            <div class="info-card">
                <div class="card-content">
                    <h4>Total Gedung</h4>
                    <p>{{ $items->pluck('gedung')->unique()->count() }}</p>
                </div>
                <div class="card-icon icon-kategori">🏢</div>
            </div>
            <div class="info-card">
                <div class="card-content">
                    <h4>Barang Masuk</h4>
                    <p>0</p>
                </div>
                <div class="card-icon icon-masuk">⬇️</div>
            </div>
            <div class="info-card">
                <div class="card-content">
                    <h4>Barang Keluar</h4>
                    <p>5</p>
                </div>
                <div class="card-icon icon-keluar">⬆️</div>
            </div>
        </div>

        <h1>Daftar Aset IT</h1>

        <div class="toolbar">
            <div class="filter-group">
                <select name="pilih_gedung" disabled><option>Pilih Gedung</option></select>
                <select name="pilih_ruangan" disabled><option>Pilih Ruangan</option></select>
                <select name="kategori" disabled><option>Kategori</option></select>
            </div>

            <div class="search-group">
                <button type="button">+ Tambah Barang</button>
                <input type="text" placeholder="Cari barang..." disabled>
                <button type="button" style="background-color: #e9ecef; color: var(--text-dark); border: 1px solid #ced4da;">🔍</button>
            </div>
        </div>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Ruangan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                    <tr>
                        <td>
                            {{ $item->nama_barang }}
                            @if(!empty($item->manufacture))
                                ({{ $item->manufacture }})
                            @endif
                        </td>
                        <td>{{ $item->ruangan }}</td>
                        <td>
                            <span style="color: {{ $item->status == 'Aktif' ? 'green' : 'red' }}; font-weight: bold;">
                                {{ $item->status }}
                            </span>
                        </td>
                        <td class="action-links" style="white-space: nowrap;">
                            <a href="#" class="detail-btn">Detail</a>
                            <a href="#" class="edit-btn">Edit</a>
                            <form action="#" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn" onclick="return confirm('Yakin ingin menghapus aset ini?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>

<script>
document.getElementById('hamburger-btn').addEventListener('click', function() {
    document.getElementById('sidebar').classList.toggle('active');
});
</script>

</body>
</html> --}}
