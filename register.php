<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudenTrack - Register</title>
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
        <div class="register-container">
            <div class="register-main">
                <h1 class="register-title">Register</h1>
                <div class="form-register">
                    <form action="register_process.php" method="POST" autocomplete="off">
                        <div class="register-input">
                            <img src="uploads/img/icon/badge.png" width="50" height="50">
                            <input type="text" name="nama" id="nama" placeholder="Full Name" title="Masukkan Nama Lengkap Anda">
                        </div>
                        <div class="register-input">
                            <img src="uploads/img/icon/account.png" width="50" height="50">
                            <input type="text" name="username" id="username" placeholder="Username" title="Masukkan Username Anda">
                        </div>
                        <div class="register-input">
                            <img src="uploads/img/icon/email.png" width="50" height="50">
                            <input type="email" name="email" id="email" placeholder="Email" title="Masukkan Email Anda">
                        </div>
                        <div class="register-input">
                            <img src="uploads/img/icon/lock.png" width="50" height="50">
                            <input type="password" name="password" id="password" placeholder="********" autocomplete="new-password" title="Masukkan Password Anda">
                        </div>
                        <div class="register-input">
                            <img src="uploads/img/icon/lock.png" width="50" height="50">
                            <input type="password" name="confirm_password" id="confirm_password" placeholder="********" autocomplete="new-password" title="Konfirmasi Password Anda">
                        </div>
                        <div class="btn-register">
                            <button type="button" onclick="window.location.href='login.php'" title="Sudah punya akun? Klik untuk login">Login</button>
                            <button type="submit">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>