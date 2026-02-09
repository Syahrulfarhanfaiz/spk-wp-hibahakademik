<?php
session_start();
include('configdb.php');

if (!isset($_SESSION['user_id'])) {
	header("Location: login.php");
	exit;
}

/* =========================
   FUNGSI – FUNGSI DATA
   ========================= */
function jml_kriteria()
{
	include 'configdb.php';
	return $mysqli->query("SELECT * FROM kriteria")->num_rows;
}

function jml_alternatif()
{
	include 'configdb.php';
	return $mysqli->query("SELECT * FROM alternatif")->num_rows;
}

function get_kepentingan()
{
	include 'configdb.php';
	$q = $mysqli->query("SELECT kepentingan FROM kriteria");
	while ($r = $q->fetch_assoc()) $data[] = $r['kepentingan'];
	return $data;
}

function get_costbenefit()
{
	include 'configdb.php';
	$q = $mysqli->query("SELECT cost_benefit FROM kriteria");
	while ($r = $q->fetch_assoc()) $data[] = $r['cost_benefit'];
	return $data;
}

function get_alt_name()
{
	include 'configdb.php';
	$q = $mysqli->query("SELECT alternatif FROM alternatif");
	while ($r = $q->fetch_assoc()) $data[] = $r['alternatif'];
	return $data;
}

function get_alternatif()
{
	include 'configdb.php';
	$q = $mysqli->query("SELECT k1,k2,k3,k4,k5 FROM alternatif");
	while ($r = $q->fetch_assoc()) {
		$data[] = array_values($r);
	}
	return $data;
}

/* =========================
   AMBIL DATA
   ========================= */
$alt       = get_alternatif();
$alt_name = get_alt_name();
$kep       = get_kepentingan();
$cb        = get_costbenefit();

$a = count($alt);
$k = count($kep);

/* =========================
   PERHITUNGAN WP
   ========================= */
$tkep = array_sum($kep);
for ($i = 0; $i < $k; $i++) {
	$bkep[$i]   = $kep[$i] / $tkep;
	$pangkat[$i] = ($cb[$i] == 'cost') ? -$bkep[$i] : $bkep[$i];
}

for ($i = 0; $i < $a; $i++) {
	$ss[$i] = 1;
	for ($j = 0; $j < $k; $j++) {
		$ss[$i] *= pow($alt[$i][$j], $pangkat[$j]);
	}
}

$totalS = array_sum($ss);
for ($i = 0; $i < $a; $i++) {
	$v[$i] = $ss[$i] / $totalS;
}

arsort($v);
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

		.btn-warning {
			background-color: #f39c12;
			border-color: #f39c12;
			transition: background-color 0.3s ease;
		}

		.btn-warning:hover {
			background-color: #e67e22;
			border-color: #e67e22;
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

		.btn-danger {
			background-color: #e74c3c;
			border-color: #e74c3c;
			transition: background-color 0.3s ease;
		}

		.btn-danger:hover {
			background-color: #c0392b;
			border-color: #c0392b;
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
					<li><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
					<li><a href="kriteria.php"><i class="fas fa-list"></i> Data Kriteria</a></li>
					<li><a href="penjelasan-kriteria.php"><i class="fas fa-list"></i> Penjelasan Kriteria</a></li>
					<li><a href="alternatif.php"><i class="fas fa-users"></i> Data Alternatif</a></li>
					<li><a href="analisa.php"><i class="fas fa-chart-line"></i> Analisa</a></li>
					<li class="active"><a href="perhitungan.php"><i class="fas fa-calculator"></i> Perhitungan</a></li>
					<li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
				</ul>
			</div>
		</div>
	</nav>



	<div class="container">

		<!-- PANEL 1 -->
		<div class="panel panel-primary">
			<div class="panel-heading"><b>Matriks Alternatif terhadap Kriteria</b></div>
			<div class="panel-body">
				<table class="table table-bordered table-striped">
					<tr>
						<th>Alternatif</th>
						<?php for ($i = 1; $i <= 5; $i++) echo "<th>K$i</th>"; ?>
					</tr>
					<?php for ($i = 0; $i < $a; $i++): ?>
						<tr>
							<td><b><?= $alt_name[$i]; ?></b></td>
							<?php for ($j = 0; $j < $k; $j++): ?>
								<td><?= $alt[$i][$j]; ?></td>
							<?php endfor; ?>
						</tr>
					<?php endfor; ?>
				</table>
			</div>
		</div>

		<!-- PANEL 2 -->
		<div class="panel panel-info">
			<div class="panel-heading"><b>Bobot Kepentingan Kriteria</b></div>
			<div class="panel-body">
				<table class="table table-bordered">
					<tr>
						<th>Kriteria</th>
						<?php for ($i = 1; $i <= 5; $i++) echo "<th>K$i</th>"; ?>
					</tr>
					<tr>
						<td><b>Bobot</b></td>
						<?php for ($i = 0; $i < $k; $i++) echo "<td>" . round($bkep[$i], 6) . "</td>"; ?>
					</tr>
				</table>
			</div>
		</div>

		<!-- PANEL 3 -->
		<div class="panel panel-warning">
			<div class="panel-heading"><b>Pangkat Cost dan Benefit</b></div>
			<div class="panel-body">
				<table class="table table-bordered">
					<tr>
						<th>Kriteria</th>
						<?php for ($i = 1; $i <= 5; $i++) echo "<th>K$i</th>"; ?>
					</tr>
					<tr>
						<td><b>Jenis</b></td>
						<?php for ($i = 0; $i < $k; $i++) echo "<td>" . ucfirst($cb[$i]) . "</td>"; ?>
					</tr>
					<tr>
						<td><b>Pangkat</b></td>
						<?php for ($i = 0; $i < $k; $i++) echo "<td>" . round($pangkat[$i], 6) . "</td>"; ?>
					</tr>
				</table>
			</div>
		</div>

		<!-- PANEL 4 -->
		<div class="panel panel-success">
			<div class="panel-heading"><b>Nilai Vektor S</b></div>
			<div class="panel-body">
				<table class="table table-bordered">
					<tr>
						<th>Alternatif</th>
						<th>Nilai S</th>
					</tr>
					<?php for ($i = 0; $i < $a; $i++): ?>
						<tr>
							<td><?= $alt_name[$i]; ?></td>
							<td><?= round($ss[$i], 6); ?></td>
						</tr>
					<?php endfor; ?>
				</table>
			</div>
		</div>

		<!-- PANEL 5 -->
		<div class="panel panel-danger">
			<div class="panel-heading"><b>Hasil Akhir dan Perangkingan</b></div>
			<div class="panel-body">
				<table class="table table-bordered table-striped">
					<tr>
						<th>Peringkat</th>
						<th>Nama</th>
						<th>Nilai Preferensi</th>
					</tr>
					<?php $rank = 1;
					foreach ($v as $i => $nilai): ?>
						<tr>
							<td><?= $rank++; ?></td>
							<td><?= $alt_name[$i]; ?></td>
							<td><?= round($nilai, 6); ?></td>
						</tr>
					<?php endforeach; ?>
				</table>
			</div>
		</div>

		<div class="alert alert-info">
			<b>Kesimpulan:</b><br>
			Berdasarkan metode <b>Weighted Product</b>, peserta didik dengan nilai preferensi tertinggi adalah
			<b><?= $alt_name[array_key_first($v)]; ?></b>, sehingga dinyatakan paling layak menerima Hibah Akademik.
		</div>

	</div>


</body>

</html>