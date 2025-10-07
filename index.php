<?php
session_start();
include 'config.php'; // pastikan koneksi $conn benar

// Pastikan user login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$userId = $_SESSION['user_id'];

// --- PROSES UPDATE PROFILE ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $nama = trim($_POST['nama']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email'] ?? '');
    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("<script>alert('Email wajib diisi dan valid');</script>");
    }
    $password = trim($_POST['password']);

    if ($nama === '' || $username === '' || $email === '') {
        echo "<script>alert('Nama, username, dan email wajib diisi!');</script>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Format email tidak valid!');</script>";
    } else {
        // Cek unik username/email
        $stmt = $conn->prepare("SELECT id FROM users WHERE (username=? OR email=?) AND id<>? LIMIT 1");
        $stmt->bind_param("ssi", $username, $email, $userId);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "<script>alert('Username atau email sudah digunakan!');</script>";
        } else {
            $stmt->close();

            $params = [];
            $types = "";
            $extra_sql = "";

            // Update password jika diisi
            if ($password !== '') {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $extra_sql .= ", password=?";
                $types .= "s";
                $params[] = $hashedPassword;
            }

            // Upload foto profile jika ada
            if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
                $filename = time() . '_' . basename($_FILES['foto']['name']);
                $target = "uploads/img/profile/" . $filename;

                if (!is_dir('uploads/img/profile')) {
                    mkdir('uploads/img/profile', 0777, true);
                }
            
                if (move_uploaded_file($_FILES['foto']['tmp_name'], $target)) {
                    $extra_sql .= ", foto=?";
                    $types .= "s";
                    $params[] = $filename;
                    // echo "Upload sukses: $filename"; // debug
                } else {
                    die("Gagal upload foto. Error code: " . $_FILES['foto']['error']);
                }
            }
            // Query utama update user
            $sql = "UPDATE users SET nama=?, username=?, email=? $extra_sql WHERE id=?";
            $types = "sss" . $types . "i";
            $params = array_merge([$nama, $username, $email], $params, [$userId]);

            $stmt = $conn->prepare($sql);
            $stmt->bind_param($types, ...$params);

            if ($stmt->execute()) {
                $_SESSION['username'] = $username;
                echo "<script>alert('Profile berhasil diperbarui!');</script>";
            } else {
                die("MySQL Error: " . $stmt->error);
            }
            $stmt->close();
        }
    }
}

// Ambil data user
$stmt = $conn->prepare("SELECT nama, username, email, foto FROM users WHERE id=?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc() ?: []; // fallback kosong jika tidak ada
$stmt->close();

// Simpan nilai untuk form
$namaValue = htmlspecialchars($user['nama'] ?? '');
$usernameValue = htmlspecialchars($user['username'] ?? '');
$emailValue = htmlspecialchars($user['email'] ?? '');
$fotoProfile = !empty($user['foto']) ? $user['foto'] : 'icon_profile.png';

// cek mode edit
$edit_mode = false;
$mahasiswa = [
    'id' => '',
    'nama' => '',
    'ttl' => '',
    'alamat' => '',
    'nis' => '',
    'prodi' => '',
    'kelamin' => ''
];

if (isset($_GET['edit'])) {
    $edit_id = intval($_GET['edit']);
    $result = $conn->query("SELECT * FROM mahasiswa WHERE id=$edit_id");
    if ($result && $result->num_rows > 0) {
        $mahasiswa = $result->fetch_assoc();
        $edit_mode = true;
    }
}

// Hitung total data
$totalQuery = $conn->query("SELECT COUNT(*) AS total FROM mahasiswa");
$totalData = $totalQuery->fetch_assoc()['total'];

// Hitung jumlah pria
$maleQuery = $conn->query("SELECT COUNT(*) AS total FROM mahasiswa WHERE kelamin = 'L'");
$totalMale = $maleQuery->fetch_assoc()['total'];

// Hitung jumlah wanita
$femaleQuery = $conn->query("SELECT COUNT(*) AS total FROM mahasiswa WHERE kelamin = 'P'");
$totalFemale = $femaleQuery->fetch_assoc()['total'];


// Jumlah data per halaman
$limit = 10;

// Halaman aktif (default 1)
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Hitung offset (mulai dari data ke berapa)
$offset = ($page - 1) * $limit;

// Ambil total data
$total_query = $conn->query("SELECT COUNT(*) AS total FROM mahasiswa");
$total_data = $total_query->fetch_assoc()['total'];

// Hitung total halaman
$total_pages = ceil($total_data / $limit);

// Ambil data untuk halaman ini
$result = $conn->query("SELECT * FROM mahasiswa LIMIT $offset, $limit");

$active_tab = $edit_mode ? 'tables' : 'dashboard';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudenTrack</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Itim&family=Jersey+10&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div id="background">
        <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" class="pink1">
            <path fill="#F2A2C4"
                d="M39.8,-75.9C46.9,-64.9,44.6,-44.7,47.9,-30.5C51.2,-16.3,60,-8.1,59.7,-0.2C59.4,7.8,49.9,15.6,44.7,26.4C39.5,37.3,38.6,51.2,31.8,54.8C25.1,58.4,12.5,51.6,-0.5,52.4C-13.5,53.3,-27,61.7,-40.4,62C-53.8,62.2,-67.2,54.4,-71.4,42.7C-75.6,31,-70.7,15.5,-71.4,-0.4C-72.1,-16.3,-78.5,-32.6,-74.9,-45.4C-71.3,-58.2,-57.8,-67.4,-43.6,-74.3C-29.5,-81.2,-14.8,-85.8,0.8,-87.3C16.4,-88.7,32.8,-86.9,39.8,-75.9Z"
                transform="translate(100 100)" />
        </svg>
        <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" class="ungu1">
            <path fill="#E0DCF2"
                d="M42.7,-68.6C56.8,-65.8,70.8,-57.4,73,-45C75.3,-32.6,65.8,-16.3,62.5,-1.9C59.2,12.5,62,25,59.4,36.7C56.8,48.5,48.8,59.6,38,68.8C27.2,78,13.6,85.4,1.5,82.7C-10.6,80.1,-21.2,67.6,-34.2,59.7C-47.3,51.7,-62.8,48.5,-65.8,39.3C-68.8,30.1,-59.3,15.1,-59.9,-0.4C-60.5,-15.8,-71.3,-31.6,-68.1,-40.4C-64.9,-49.3,-47.8,-51.2,-34.1,-54.3C-20.5,-57.3,-10.2,-61.4,2,-64.9C14.3,-68.4,28.6,-71.4,42.7,-68.6Z"
                transform="translate(100 100)" />
        </svg>
        <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" class="ungu2">
            <path fill="#E0DCF2"
                d="M52.8,-72.1C68.1,-61.5,80.1,-45.7,78.1,-30.4C76.2,-15.1,60.3,-0.3,54.2,17.4C48.2,35.2,51.9,55.9,44.5,68.6C37.1,81.3,18.6,86,1.1,84.5C-16.4,83.1,-32.8,75.4,-44.9,64.2C-57,53,-64.9,38.3,-70.1,22.7C-75.3,7,-77.9,-9.6,-71.9,-22C-65.9,-34.3,-51.4,-42.5,-38,-53.8C-24.6,-65.1,-12.3,-79.4,3.2,-83.9C18.7,-88.3,37.4,-82.8,52.8,-72.1Z"
                transform="translate(100 100)" />
        </svg>
        <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" class="pink2">
            <path fill="#F2A2C4"
                d="M34.5,-46.2C42.3,-41.9,44.5,-28.5,53.1,-14.4C61.7,-0.2,76.8,14.8,71.1,20.2C65.3,25.5,38.8,21.2,23.5,26.6C8.2,32,4.1,47.1,-2.5,50.4C-9,53.8,-18,45.5,-31.4,39.5C-44.8,33.5,-62.6,29.8,-69.1,20C-75.7,10.2,-71,-5.6,-64.5,-19.6C-58.1,-33.5,-49.8,-45.4,-38.8,-48.6C-27.8,-51.9,-13.9,-46.5,-0.2,-46.1C13.4,-45.8,26.8,-50.5,34.5,-46.2Z"
                transform="translate(100 100)" />
        </svg>
    </div>
    <div id="main">
        <div class="main-sidebar">
            <div class="sidebar-menu">
                <button type="button" class="tablinks active" onclick="openTab(event, 'dashboard')"
                    id="defaultOpen"><img src="uploads/img/icon/dashboard.png" width="25" height="25">Dashboard</button>
                <button type="button" class="tablinks" onclick="openTab(event, 'tables')"><img
                        src="uploads/img/icon/table.png" width="25" height="25">Tables</button>
                <button type="button" class="tablinks" onclick="openTab(event, 'profile')"><img
                        src="uploads/img/icon/profile.png" width="25" height="25">Profile</button>
                <button type="button" class="tablinks" onclick="window.location.href='logout.php'">Logout</button>
            </div>
        </div>
        <div class="main-container">
            <div id="dashboard" class="tabcontent">
                <div class="dashboard-nav">
                    <div class="hello-admin">
                        <h1>Hi <?php echo ucwords(htmlspecialchars($usernameValue)); ?>,</h1>
                        <h2>here’s an overview of your activity!</h2>
                    </div>
                    <div class="icon-profile">
                        <img src="uploads/img/profile/<?php echo htmlspecialchars($fotoProfile); ?>" alt="profile"
                            width="100" height="100" style="border-radius: 50%;">
                    </div>
                </div>
                <div class="dashboard-main">
                    <div class="main-data">
                        <div class="main-icon">
                            <img src="uploads/img/icon/database.png" alt="database icon">
                        </div>
                        <div class="main-text">
                            <h1><?php echo $totalData; ?></h1>
                            <h2>Total Data</h2>
                        </div>
                    </div>
                    <div class="main-data">
                        <div class="main-icon">
                            <img src="uploads/img/icon/male.png" alt="database icon">
                        </div>
                        <div class="main-text">
                            <h1><?php echo $totalMale; ?></h1>
                            <h2>Male</h2>
                        </div>
                    </div>
                    <div class="main-data">
                        <div class="main-icon">
                            <img src="uploads/img/icon/female.png" alt="database icon">
                        </div>
                        <div class="main-text">
                            <h1><?php echo $totalFemale; ?></h1>
                            <h2>Female</h2>
                        </div>
                    </div>
                </div>
                <div class="dashboard-bottom">
                    <div class="bar-chart">
                        <canvas id="barChart" width="300" height="400"></canvas>
                    </div>
                    <div class="donut-chart">
                        <canvas id="donutChart" width="400" height="400"></canvas>
                    </div>
                </div>
            </div>
            <div id="tables" class="tabcontent">
                <button class="btn btn-add" onclick="toggleForm()" style="margin-left: 5%;">+ Tambah Data</button>

                <!-- Form tambah/edit data -->
                <form class="form-container" id="formTambah"
                    style="display: <?php echo $edit_mode ? 'block' : 'none'; ?>;" method="POST" action="simpan.php">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($mahasiswa['id']); ?>">
                    <input type="text" name="nama" id="namaMahasiswa" placeholder="Nama"
                        value="<?php echo htmlspecialchars($mahasiswa['nama']); ?>" required>
                    <input type="date" name="ttl" id="ttlMahasiswa" placeholder="TTL"
                        value="<?php echo htmlspecialchars($mahasiswa['ttl']); ?>" required>
                    <input type="text" name="alamat" id="alamatMahasiswa" placeholder="Alamat"
                        value="<?php echo htmlspecialchars($mahasiswa['alamat']); ?>" required>
                    <input type="text" name="nis" id="nisMahasiswa" placeholder="NIS"
                        value="<?php echo htmlspecialchars($mahasiswa['nis']); ?>" required>
                    <select name="prodi" required>
                        <option value="">--- Pilih Prodi ---</option>
                        <option value="Informatika" <?php if($mahasiswa['prodi']=="Informatika") echo "selected"; ?>>
                            Informatika</option>
                        <option value="Kehutanan" <?php if($mahasiswa['prodi']=="Kehutanan") echo "selected"; ?>>
                            Kehutanan</option>
                        <option value="Multimedia" <?php if($mahasiswa['prodi']=="Multimedia") echo "selected"; ?>>
                            Multimedia</option>
                        <option value="Hukum" <?php if($mahasiswa['prodi']=="Hukum") echo "selected"; ?>>
                            Hukum</option>
                        <option value="Farmasi" <?php if($mahasiswa['prodi']=="Farmasi") echo "selected"; ?>>
                            Farmasi</option>
                        <option value="Sosiologi" <?php if($mahasiswa['prodi']=="Sosiologi") echo "selected"; ?>>
                            Sosiologi</option>
                        <option value="Psikologi" <?php if($mahasiswa['prodi']=="Psikologi") echo "selected"; ?>>
                            Psikologi</option>
                        <option value="Akuntansi" <?php if($mahasiswa['prodi']=="Akuntansi") echo "selected"; ?>>
                            Akuntansi</option>
                        <option value="Kewirausahaan"
                            <?php if($mahasiswa['prodi']=="Kewirausahaan") echo "selected"; ?>>
                            Kewirausahaan</option>
                        <option value="Keperawatan" <?php if($mahasiswa['prodi']=="Keperawatan") echo "selected"; ?>>
                            Keperawatan</option>
                        <option value="Manajemen" <?php if($mahasiswa['prodi']=="Manajemen") echo "selected"; ?>>
                            Manajemen</option>
                    </select>
                    <select name="kelamin" required>
                        <option value="">--- Jenis Kelamin ---</option>
                        <option value="L" <?php if($mahasiswa['kelamin']=="L") echo "selected"; ?>>
                            Pria</option>
                        <option value="P" <?php if($mahasiswa['kelamin']=="P") echo "selected"; ?>>
                            Wanita</option>
                    </select>
                    <button type="submit" class="btn btn-add">Simpan</button>
                    <?php if ($edit_mode): ?>
                    <button type="button" class="btn btn-add" onclick="cancelEdit()">Cancel</button>
                    <?php else: ?>
                    <button type="button" class="btn btn-add" onclick="cancelData()">Cancel</button>
                    <?php endif; ?>
                </form>

                <!-- Tabel -->
                <div class="table-container">
                    <table id="dataTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>TTL</th>
                                <th>Alamat</th>
                                <th>NIS</th>
                                <th>Prodi</th>
                                <th>Kelamin</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = $offset + 1;
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                        <td>".$no++."</td>
                                        <td>".ucwords(htmlspecialchars($row['nama']))."</td>
                                        <td>".htmlspecialchars($row['ttl'])."</td>
                                        <td>".ucwords(htmlspecialchars($row['alamat']))."</td>
                                        <td>".htmlspecialchars($row['nis'])."</td>
                                        <td>".htmlspecialchars($row['prodi'])."</td>
                                        <td>".($row['kelamin'] == 'L' ? 'Pria' : 'Wanita')."</td>
                                        <td>
                                            <a href='index.php?edit=".$row['id']."'><button class='tbl-btn-add'>Edit</button></a>
                                            <a href='delete.php?id=".$row['id']."' onclick=\"return confirm('Hapus data ini?')\"><button class='tbl-btn-del'>Delete</button></a>
                                        </td>
                                    </tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="pagination">
                    <?php if ($page > 1): ?>
                    <a href="?page=<?php echo $page - 1; ?>#tables" class="page-btn">« Prev</a>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <a href="?page=<?php echo $i; ?>#tables"
                        class="page-btn <?php echo ($i == $page) ? 'active' : ''; ?>">
                        <?php echo $i; ?>
                    </a>
                    <?php endfor; ?>

                    <?php if ($page < $total_pages): ?>
                    <a href="?page=<?php echo $page + 1; ?>#tables" class="page-btn">Next »</a>
                    <?php endif; ?>
                </div>
            </div>
            <div id="profile" class="tabcontent">
                <div class="profile-container">
                    <div class="image-profile">
                        <img src="uploads/img/profile/<?php echo htmlspecialchars($fotoProfile); ?>" alt="Profile">
                    </div>
                    <div class="form-profile">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="input-form">
                                <input type="text" name="nama" id="nama" value="<?php echo $namaValue; ?>" required>
                                <input type="text" name="username" id="username" value="<?php echo $usernameValue; ?>"
                                    required>
                                <input type="email" name="email" id="email"
                                    value="<?php echo htmlspecialchars($emailValue); ?>" required>
                                <input type="password" name="password" id="password"
                                    placeholder="Password Baru (kosongkan jika tidak diganti)">
                                <input type="file" name="foto" id="imgProfile">
                            </div>
                            <button type="submit" name="update_profile">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    const totalMale = <?php echo $totalMale; ?>;
    const totalFemale = <?php echo $totalFemale; ?>;
    </script>

    <script src="script.js"></script>
</body>

</html>