<?php
session_start();
include('configdb.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title><?php echo $_SESSION['judul'] . " - " . $_SESSION['by']; ?></title>

    <!-- Bootstrap core CSS -->
    <!--link href="ui/css/bootstrap.css" rel="stylesheet"-->
    <link href="ui/css/cerulean.min.css" rel="stylesheet">

    <!-- Datatables -->
    <link rel="stylesheet" type="text/css" href="ui/css/datatables/dataTables.bootstrap.css">

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script type="text/javascript" language="javascript" src="ui/js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" language="javascript" src="ui/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="ui/js/dataTables.bootstrap.min.js"></script>

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <!--script src="./index_files/ie-emulation-modes-warning.js"></script-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

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

        .panel {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border: none;
            margin-top: 30px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .panel:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.15);
        }

        .panel-heading {
            background-color: #2980b9 !important;
            color: #fff !important;
            border-radius: 12px 12px 0 0;
            padding: 20px;
            font-size: 1.5rem;
            font-weight: bold;
            display: flex;
            align-items: center;
        }

        .panel-heading i {
            margin-right: 10px;
        }

        .panel-body {
            padding: 30px;
        }

        .table {
            border-radius: 8px;
            overflow: hidden;
        }

        .table thead th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #2980b9;
            color: #2980b9;
            font-weight: bold;
        }

        .table tbody tr:hover {
            background-color: #f1f3f4;
        }

        .btn-success {
            background-color: #27ae60;
            border-color: #27ae60;
            transition: background-color 0.3s ease;
        }

        .btn-success:hover {
            background-color: #229954;
            border-color: #229954;
        }

        .panel-footer {
            background-color: rgba(255, 255, 255, 0.8);
            border-top: 1px solid #ddd;
            padding: 20px;
            border-radius: 0 0 12px 12px;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .panel-footer b {
            color: #2980b9;
        }

        @media (max-width: 768px) {
            .panel-body {
                padding: 15px;
            }

            .panel-heading {
                font-size: 1.2rem;
                padding: 15px;
            }
        }
    </style>
</head>

<body>

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
                    <li><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                    <li><a href="kriteria.php"><i class="fas fa-list"></i> Data Kriteria</a></li>
                    <li class="active"><a href="penjelasan-kriteria.php"><i class="fas fa-list"></i> Penjelasan Kriteria</a></li>
                    <li><a href="alternatif.php"><i class="fas fa-users"></i> Data Alternatif</a></li>
                    <li><a href="analisa.php"><i class="fas fa-chart-line"></i> Analisa</a></li>
                    <li><a href="perhitungan.php"><i class="fas fa-calculator"></i> Perhitungan</a></li>
                    <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">

        <div class="panel panel-primary">
            <div class="panel-heading"><i class="fas fa-info-circle"></i> Penjelasan Kriteria Penilaian</div>

            <div class="panel-body">

                <p>
                    Halaman ini menjelaskan mekanisme penilaian setiap kriteria yang digunakan dalam sistem
                    pendukung keputusan penerima hibah akademik menggunakan metode
                    <b>Weighted Product (WP)</b>.
                    Setiap kriteria memiliki <b>satuan nilai asli</b> yang kemudian dikonversi
                    menjadi <b>nilai rating 1–5</b> agar dapat dihitung secara seragam.
                </p>

                <div class="row">

                    <!-- NILAI AKADEMIK -->
                    <div class="col-md-6">
                        <div class="panel panel-info">
                            <div class="panel-heading"><b>1. Nilai Akademik</b></div>
                            <div class="panel-body">
                                <p>
                                    Kriteria ini menilai capaian akademik mahasiswa berdasarkan nilai akhir.
                                    Semakin tinggi nilai akademik, semakin besar peluang untuk diprioritaskan.
                                </p>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Rentang Nilai</th>
                                        <th>Rating</th>
                                    </tr>
                                    <tr>
                                        <td>> 85 – 100</td>
                                        <td>5</td>
                                    </tr>
                                    <tr>
                                        <td>> 70 – 85</td>
                                        <td>4</td>
                                    </tr>
                                    <tr>
                                        <td>> 60 – 70</td>
                                        <td>3</td>
                                    </tr>
                                    <tr>
                                        <td>> 40 – 60</td>
                                        <td>2</td>
                                    </tr>
                                    <tr>
                                        <td>0 – 40</td>
                                        <td>1</td>
                                    </tr>
                                </table>
                                <p><b>Jenis:</b> Benefit</p>
                            </div>
                        </div>
                    </div>

                    <!-- KEHADIRAN -->
                    <div class="col-md-6">
                        <div class="panel panel-info">
                            <div class="panel-heading"><b>2. Kehadiran</b></div>
                            <div class="panel-body">
                                <p>
                                    Kriteria kehadiran mengukur tingkat kedisiplinan mahasiswa dalam mengikuti kegiatan akademik.
                                    Nilai diambil dalam bentuk persentase kehadiran.
                                </p>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Persentase</th>
                                        <th>Rating</th>
                                    </tr>
                                    <tr>
                                        <td>> 85% – 100%</td>
                                        <td>5</td>
                                    </tr>
                                    <tr>
                                        <td>> 70% – 85%</td>
                                        <td>4</td>
                                    </tr>
                                    <tr>
                                        <td>> 60% – 70%</td>
                                        <td>3</td>
                                    </tr>
                                    <tr>
                                        <td>> 40% – 60%</td>
                                        <td>2</td>
                                    </tr>
                                    <tr>
                                        <td>0% – 40%</td>
                                        <td>1</td>
                                    </tr>
                                </table>
                                <p><b>Jenis:</b> Benefit</p>
                            </div>
                        </div>
                    </div>

                    <!-- KONDISI EKONOMI -->
                    <div class="col-md-6">
                        <div class="panel panel-warning">
                            <div class="panel-heading"><b>3. Kondisi Ekonomi</b></div>
                            <div class="panel-body">
                                <p>
                                    Kriteria ini menilai latar belakang ekonomi mahasiswa.
                                    Semakin rendah kondisi ekonomi, semakin tinggi prioritas bantuan.
                                </p>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Kondisi</th>
                                        <th>Rating</th>
                                    </tr>
                                    <tr>
                                        <td>Kaya</td>
                                        <td>5</td>
                                    </tr>
                                    <tr>
                                        <td>Tidak Miskin</td>
                                        <td>4</td>
                                    </tr>
                                    <tr>
                                        <td>Cukup</td>
                                        <td>3</td>
                                    </tr>
                                    <tr>
                                        <td>Miskin</td>
                                        <td>2</td>
                                    </tr>
                                    <tr>
                                        <td>Sangat Miskin</td>
                                        <td>1</td>
                                    </tr>
                                </table>
                                <p><b>Jenis:</b> Benefit</p>
                            </div>
                        </div>
                    </div>

                    <!-- PRESTASI NON AKADEMIK -->
                    <div class="col-md-6">
                        <div class="panel panel-success">
                            <div class="panel-heading"><b>4. Prestasi Non Akademik</b></div>
                            <div class="panel-body">
                                <p>
                                    Prestasi non akademik dinilai berdasarkan jumlah prestasi yang pernah diraih mahasiswa,
                                    baik di tingkat internal maupun eksternal.
                                </p>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Jumlah Prestasi</th>
                                        <th>Rating</th>
                                    </tr>
                                    <tr>
                                        <td>> 10</td>
                                        <td>5</td>
                                    </tr>
                                    <tr>
                                        <td>7 – 10</td>
                                        <td>4</td>
                                    </tr>
                                    <tr>
                                        <td>5 – 6</td>
                                        <td>3</td>
                                    </tr>
                                    <tr>
                                        <td>1 – 4</td>
                                        <td>2</td>
                                    </tr>
                                    <tr>
                                        <td>0</td>
                                        <td>1</td>
                                    </tr>
                                </table>
                                <p><b>Jenis:</b> Benefit</p>
                            </div>
                        </div>
                    </div>

                    <!-- PERILAKU DAN SIKAP -->
                    <div class="col-md-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading"><b>5. Perilaku dan Sikap</b></div>
                            <div class="panel-body">
                                <p>
                                    Kriteria ini menilai sikap, etika, dan perilaku mahasiswa selama mengikuti kegiatan akademik
                                    berdasarkan penilaian dosen atau pihak kampus.
                                </p>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Penilaian</th>
                                        <th>Rating</th>
                                    </tr>
                                    <tr>
                                        <td>Sangat baik</td>
                                        <td>5</td>
                                    </tr>
                                    <tr>
                                        <td>Baik</td>
                                        <td>4</td>
                                    </tr>
                                    <tr>
                                        <td>Cukup</td>
                                        <td>3</td>
                                    </tr>
                                    <tr>
                                        <td>Kurang baik</td>
                                        <td>2</td>
                                    </tr>
                                    <tr>
                                        <td>Tidak baik</td>
                                        <td>1</td>
                                    </tr>
                                </table>
                                <p><b>Jenis:</b> Benefit</p>
                            </div>
                        </div>
                    </div>

                </div>


                <div class="alert alert-info">
                    <b>Catatan:</b><br>
                    Nilai 1–5 pada setiap kriteria merupakan <b>nilai rating</b> hasil konversi dari data asli mahasiswa,
                    yang kemudian digunakan dalam proses perhitungan metode Weighted Product.
                </div>

            </div>

            <div></div>
            <div class="panel-body">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading"><b>COST & BENEFIT</b></div>
                        <div class="panel-body">
                            <ul>
                                <li><b>Benefit</b> → semakin besar nilainya, semakin baik.</li>
                                <li><b>Cost</b> → semakin kecil nilainya, semakin baik.</li>
                            </ul>

                            <p>
                                Dalam metode WP, kriteria bertipe <b>cost</b> akan dipangkatkan dengan nilai negatif,
                                sedangkan <b>benefit</b> dipangkatkan dengan nilai positif.
                            </p>

                            <h4><b>Daftar Kriteria yang Digunakan</b></h4>

                            <table class="table table-striped table-bordered">
                                <tr>
                                    <th>No</th>
                                    <th>Kriteria</th>
                                    <th>Kepentingan</th>
                                    <th>Jenis</th>
                                    <th>Penjelasan</th>
                                </tr>

                                <?php
                                $q = $mysqli->query("SELECT * FROM kriteria");
                                $no = 1;
                                while ($r = $q->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $no++ . "</td>";
                                    echo "<td>" . ucwords($r['kriteria']) . "</td>";
                                    echo "<td>" . $r['kepentingan'] . "</td>";
                                    echo "<td class='text-uppercase'>" . $r['cost_benefit'] . "</td>";
                                    echo "<td>";
                                    echo ($r['cost_benefit'] == "benefit")
                                        ? "Nilai yang lebih tinggi lebih diutamakan"
                                        : "Nilai yang lebih rendah lebih diutamakan";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </table>

                            <div class="alert alert-info">
                                <b>Kesimpulan:</b><br>
                                Kriteria dengan nilai kepentingan tertinggi memiliki pengaruh paling besar terhadap hasil
                                perangkingan penerima hibah akademik.
                            </div>

                        </div>

                        <div class="panel-footer text-primary text-center">
                            <i class="fas fa-code"></i>
                            <span>Dikembangkan oleh</span>
                            <b>Kelompok 3</b>
                        </div>


                    </div>
                </div>

</body>

</html>