<?php
session_start();
include('configdb.php');

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}

?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>SCOLA - Sistem Pendukung Keputusan</title>

  <!-- Bootstrap CSS -->
  <link href="ui/css/cerulean.min.css" rel="stylesheet">
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <style>
    body {
      background: linear-gradient(135deg, #f4f6f9 0%, #e9ecef 100%);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      min-height: 100vh;
    }

    .navbar {
      background-color: #2980b9 !important;
      border: none;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .navbar-brand {
      font-weight: bold;
      color: #fff !important;
    }

    .navbar-nav>li>a {
      color: #fff !important;
      font-weight: 500;
    }

    .navbar-nav>li>a:hover {
      background-color: rgba(255, 255, 255, 0.1) !important;
    }

    .section {
      background: #ffffff;
      padding: 40px;
      margin-top: 30px;
      border-radius: 12px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .section:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 35px rgba(0, 0, 0, 0.15);
    }

    .app-title {
      font-weight: bold;
      color: #2c3e50;
      margin-bottom: 10px;
      font-size: 3rem;
      text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
    }

    .app-subtitle {
      color: #555;
      font-size: 18px;
      margin-bottom: 20px;
    }

    .section-title {
      font-weight: bold;
      margin-bottom: 20px;
      color: #2980b9;
      font-size: 1.5rem;
      display: flex;
      align-items: center;
    }

    .section-title i {
      margin-right: 10px;
      color: #2980b9;
    }

    .section p {
      font-size: 16px;
      line-height: 1.8;
      color: #444;
      text-align: justify;
    }

    .welcome-message {
      font-size: 18px;
      color: #27ae60;
      font-weight: 600;
      margin-top: 20px;
      text-align: center;
    }

    .footer-text {
      font-size: 14px;
      color: #777;
      margin-top: 30px;
      text-align: center;
      padding: 20px;
      background: rgba(255, 255, 255, 0.8);
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .divider {
      width: 50%;
      height: 3px;
      background: linear-gradient(90deg, #2980b9, #3498db);
      margin: 20px auto;
      border-radius: 2px;
    }

    .icon-section {
      text-align: center;
      margin-bottom: 20px;
    }

    .icon-section i {
      font-size: 3rem;
      color: #2980b9;
      margin-bottom: 10px;
    }

    @media (max-width: 768px) {
      .section {
        padding: 20px;
      }

      .app-title {
        font-size: 2rem;
      }

      .section {
        min-height: calc(100vh - 70px);
        /* dikurangi tinggi navbar */
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
      }

    }
  </style>
</head>

<body>

  <!-- NAVBAR ASLI, TIDAK DIUBAH -->
  <nav class="navbar navbar-default">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">
          <i class="fas fa-graduation-cap"></i> <b>SCOLA</b>
        </a>
      </div>

      <div id="navbar" class="navbar-collapse collapse pull-right">
        <ul class="nav navbar-nav">
          <li class="active"><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
          <li><a href="kriteria.php"><i class="fas fa-list"></i> Data Kriteria</a></li>
          <li><a href="penjelasan-kriteria.php"><i class="fas fa-list"></i> Penjelasan Kriteria</a></li>
          <li><a href="alternatif.php"><i class="fas fa-users"></i> Data Alternatif</a></li>
          <li><a href="analisa.php"><i class="fas fa-chart-line"></i> Analisa</a></li>
          <li><a href="perhitungan.php"><i class="fas fa-calculator"></i> Perhitungan</a></li>
          <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">

    <!-- SECTION HEADER APLIKASI -->
    <div class="section">
      <div class="icon-section">
        <i class="fas fa-school"></i>
      </div>
      <center>
        <h2 class="app-title">SCOLA</h2>

        <p class="app-subtitle">
          <center>Sistem Pendukung Keputusan Penerima Hibah Akademik</center><br>
          SMAN 1 Lima Puluh
        </p>

        <div class="divider"></div>

        <p class="welcome-message">
          <center>Halo, <?php echo $_SESSION['nama']; ?>! Selamat datang di SCOLA.</center>
        </p>
    </div>


    <!-- SECTION PENJELASAN APLIKASI -->
    <div class="section">
      <h4 class="section-title">
        <i class="fas fa-info-circle"></i> Tentang Aplikasi
      </h4>
      <p>
        SCOLA merupakan aplikasi sistem pendukung keputusan yang dirancang untuk membantu pihak sekolah
        dalam menentukan siswa penerima hibah akademik secara objektif dan terukur.
        Aplikasi ini mengolah data alternatif siswa dan kriteria penilaian untuk menghasilkan
        peringkat rekomendasi berdasarkan tingkat kelayakan masing-masing siswa.
      </p>
      <p>
        Dengan adanya SCOLA, proses seleksi penerima hibah tidak lagi bergantung pada penilaian subjektif,
        melainkan berdasarkan perhitungan matematis yang konsisten, transparan, dan dapat dipertanggungjawabkan.
      </p>
    </div>

    <!-- SECTION METODE WEIGHTED PRODUCT -->
    <div class="section">
      <h4 class="section-title">
        <i class="fas fa-balance-scale"></i> Metode Weighted Product (WP)
      </h4>
      <p>
        Metode Weighted Product (WP) merupakan salah satu metode dalam sistem pendukung keputusan
        yang digunakan untuk menyelesaikan masalah pemilihan alternatif terbaik berdasarkan
        sejumlah kriteria yang memiliki bobot tertentu.
      </p>
      <p>
        Pada metode ini, setiap nilai alternatif pada masing-masing kriteria akan dipangkatkan
        dengan bobot kriteria tersebut. Selanjutnya, seluruh hasil pemangkatan dikalikan
        untuk memperoleh nilai preferensi setiap alternatif.
      </p>
      <p>
        Alternatif dengan nilai preferensi tertinggi dianggap sebagai alternatif terbaik
        dan direkomendasikan sebagai penerima hibah akademik.
      </p>
    </div>

    <div class="footer-text">
      <i class="fas fa-code"></i>
      <span>Dikembangkan oleh</span>
      <b>Kelompok 3</b>
    </div>


  </div>

  <script src="ui/js/jquery-1.10.2.min.js"></script>
  <script src="ui/js/bootstrap.min.js"></script>
  <script src="ui/js/bootswatch.js"></script>

</body>

</html>