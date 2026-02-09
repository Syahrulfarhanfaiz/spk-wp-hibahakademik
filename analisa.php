<?php
session_start();
include('configdb.php');

if (!isset($_SESSION['user_id'])) {
	header("Location: login.php");
	exit;
}

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

	<!-- Font Awesome for icons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<!-- Custom styles for this template -->
	<link href="ui/css/jumbotron.css" rel="stylesheet">

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
			margin-bottom: 20px;
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

		.alert {
			border-radius: 8px;
			border: none;
			background-color: #d4edda;
			color: #155724;
		}

		.a {
			background-color: #f8f9fa;
			border-radius: 8px;
			padding: 20px;
			margin-bottom: 20px;
			text-align: center;
		}

		#canvas {
			max-width: 100%;
			height: 300px;
			/* Perkecil tinggi grafik */
		}

		.btn-pdf {
			background-color: #e74c3c;
			border-color: #e74c3c;
			color: #fff;
			transition: background-color 0.3s ease;
		}

		.btn-pdf:hover {
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

			.a {
				padding: 10px;
			}

			#canvas {
				height: 200px;
				/* Lebih kecil di mobile */
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
					<li class="active"><a href="analisa.php"><i class="fas fa-chart-line"></i> Analisa</a></li>
					<li><a href="perhitungan.php"><i class="fas fa-calculator"></i> Perhitungan</a></li>
					<li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="container">
		<!-- Panel untuk Grafik -->
		<div class="panel panel-primary">
			<div class="panel-heading"><i class="fas fa-chart-bar"></i> <b>Grafik Hasil Analisa</b></div>
			<div class="panel-body">
				<div class="a">
					<canvas id="canvas"></canvas>
				</div>
			</div>
		</div>

		<!-- Panel untuk Perhitungan -->
		<div class="panel panel-primary">
			<div class="panel-heading"><i class="fas fa-calculator"></i> <b>Hasil Perhitungan</b></div>
			<div class="panel-body">
				<a href="export-pdf.php" class="btn btn-pdf pull-right"><i class="fas fa-file-pdf"></i> Export ke PDF</a><br /><br />
				<center>
					<?php

					$alt = get_alternatif();
					$alt_name = get_alt_name();
					end($alt_name);
					$arl2 = key($alt_name) + 1; //new
					$kep = get_kepentingan();
					$cb = get_costbenefit();
					$k = jml_kriteria();
					$a = jml_alternatif();
					$tkep = 0;
					$tbkep = 0;

					for ($i = 0; $i < $k; $i++) {
						$tkep = $tkep + $kep[$i];
					}
					for ($i = 0; $i < $k; $i++) {
						$bkep[$i] = ($kep[$i] / $tkep);
						$tbkep = $tbkep + $bkep[$i];
					}
					for ($i = 0; $i < $k; $i++) {
						if ($cb[$i] == "cost") {
							$pangkat[$i] = (-1) * $bkep[$i];
						} else {
							$pangkat[$i] = $bkep[$i];
						}
					}
					for ($i = 0; $i < $a; $i++) {
						for ($j = 0; $j < $k; $j++) {
							$s[$i][$j] = pow(($alt[$i][$j]), $pangkat[$j]);
						}
						$ss[$i] = $s[$i][0] * $s[$i][1] * $s[$i][2] * $s[$i][3] * $s[$i][4];
					}
					// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> vektor S <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< //
					echo "<b>Hasil Akhir</b></br>";
					echo "<table class='table table-striped table-bordered table-hover'>";
					echo "<thead><tr><th>Alternatif</th><th>V</th></tr></thead>";
					$total = 0;
					for ($i = 0; $i < $a; $i++) {
						$total = $total + $ss[$i];
					}
					for ($i = 0; $i < $a; $i++) {
						echo "<tr><td><b>" . $alt_name[$i] . "</b></td>";
						$v[$i] = round($ss[$i] / $total, 6);
						echo "<td>" . $v[$i] . "</td></tr>";
					}
					echo "</table><hr>";
					// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> vektor S <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< //
					uasort($v, 'cmp');
					for ($i = 0; $i < $arl2; $i++) { //new for 8 lines below
						if ($i == 0)
							echo "<div class='alert alert-dismissible alert-info'><b><i>Dari tabel tersebut dapat disimpulkan bahwa " . $alt_name[array_search((end($v)), $v)] . " mempunyai hasil paling tinggi, yaitu " . current($v);
						elseif ($i == ($arl2 - 1))
							echo "</br>Dan terakhir " . $alt_name[array_search((prev($v)), $v)] . " dengan nilai " . current($v) . ".</i></b></div>";
						else
							echo "</br>Lalu diikuti dengan " . $alt_name[array_search((prev($v)), $v)] . " dengan nilai " . current($v);
					}

					function jml_kriteria()
					{
						include 'configdb.php';
						$kriteria = $mysqli->query("select * from kriteria");
						return $kriteria->num_rows;
					}

					function jml_alternatif()
					{
						include 'configdb.php';
						$alternatif = $mysqli->query("select * from alternatif");
						return $alternatif->num_rows;
					}

					function get_kepentingan()
					{
						include 'configdb.php';
						$kepentingan = $mysqli->query("select * from kriteria");
						if (!$kepentingan) {
							echo $mysqli->connect_errno . " - " . $mysqli->connect_error;
							exit();
						}
						$i = 0;
						while ($row = $kepentingan->fetch_assoc()) {
							@$kep[$i] = $row["kepentingan"];
							$i++;
						}
						return $kep;
					}

					function get_costbenefit()
					{
						include 'configdb.php';
						$costbenefit = $mysqli->query("select * from kriteria");
						if (!$costbenefit) {
							echo $mysqli->connect_errno . " - " . $mysqli->connect_error;
							exit();
						}
						$i = 0;
						while ($row = $costbenefit->fetch_assoc()) {
							@$cb[$i] = $row["cost_benefit"];
							$i++;
						}
						return $cb;
					}

					function get_alt_name()
					{
						include 'configdb.php';
						$alternatif = $mysqli->query("select * from alternatif");
						if (!$alternatif) {
							echo $mysqli->connect_errno . " - " . $mysqli->connect_error;
							exit();
						}
						$i = 0;
						while ($row = $alternatif->fetch_assoc()) {
							@$alt[$i] = $row["alternatif"];
							$i++;
						}
						return $alt;
					}

					function get_alternatif()
					{
						include 'configdb.php';
						$alternatif = $mysqli->query("select * from alternatif");
						if (!$alternatif) {
							echo $mysqli->connect_errno . " - " . $mysqli->connect_error;
							exit();
						}
						$i = 0;
						while ($row = $alternatif->fetch_assoc()) {
							@$alt[$i][0] = $row["k1"];
							@$alt[$i][1] = $row["k2"];
							@$alt[$i][2] = $row["k3"];
							@$alt[$i][3] = $row["k4"];
							@$alt[$i][4] = $row["k5"];
							$i++;
						}
						return $alt;
					}

					function cmp($a, $b)
					{
						if ($a == $b) {
							return 0;
						}
						return ($a < $b) ? -1 : 1;
					}

					function print_ar(array $x)
					{	//just for print array
						echo "<pre>";
						print_r($x);
						echo "</pre></br>";
					}
					?>
				</center>
			</div>
			<div class="panel-footer text-primary text-center">
				<i class="fas fa-code"></i>
				<span>Dikembangkan oleh</span>
				<b>Kelompok 3</b>
			</div>

		</div>

	</div> <!-- /container -->


	<!-- Bootstrap core JavaScript
    ================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="ui/js/jquery-1.10.2.min.js"></script>
	<script src="ui/js/bootstrap.min.js"></script>
	<script src="ui/js/bootswatch.js"></script>
	<script src="ui/js/Chart.min.js"></script>
	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	<script src="ui/js/ie10-viewport-bug-workaround.js"></script>
	<!-- chart -->
	<script>
		var randomScalingFactor = function() {
			return Math.round(Math.random() * 100)
		};

		var barChartData = {
			labels: [
				<?php
				for ($i = 0; $i < $a; $i++) {
					echo '"' . $alt_name[$i] . '",';
				}
				?>
			],
			datasets: [{
					fillColor: "rgba(0,0,255)",
					strokeColor: "rgba(220,220,220,0.8)",
					highlightFill: "rgba(0,128,255,0.75)",
					highlightStroke: "rgba(220,220,220,1)",
					data: [
						<?php
						for ($i = 0; $i < $a; $i++) {
							echo $v[$i] . ',';
						}
						?>
					]
				},
				/*{
					fillColor : "rgba(151,187,205,0.5)",
					strokeColor : "rgba(151,187,205,0.8)",
					highlightFill : "rgba(151,187,205,0.75)",
					highlightStroke : "rgba(151,187,205,1)",
					data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
				}*/
			]

		}
		window.onload = function() {
			var ctx = document.getElementById("canvas").getContext("2d");
			window.myBar = new Chart(ctx).Bar(barChartData, {
				responsive: true
			});
		}
	</script>
</body>

</html>