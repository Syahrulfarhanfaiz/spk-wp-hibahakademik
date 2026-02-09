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

	<!-- Static navbar -->
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
					<li class="active"><a href="alternatif.php"><i class="fas fa-users"></i> Data Alternatif</a></li>
					<li><a href="analisa.php"><i class="fas fa-chart-line"></i> Analisa</a></li>
					<li><a href="perhitungan.php"><i class="fas fa-calculator"></i> Perhitungan</a></li>
					<li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="container">
		<!-- Main component for a primary marketing message or call to action -->
		<div class="panel panel-primary">
			<!-- Default panel contents -->
			<div class="panel-heading"><i class="fas fa-users"></i> <b>Data Alternatif</b></div>
			<?php
			//include 'config.php';
			$kriteria = $mysqli->query("select * from kriteria");
			if (!$kriteria) {
				echo $mysqli->connect_errno . " - " . $mysqli->connect_error;
				exit();
			}
			$i = 0;
			while ($row = $kriteria->fetch_assoc()) {
				@$k[$i] = $row["kriteria"];
				$i++;
			}

			$alternatif = $mysqli->query("select * from alternatif");
			if (!$alternatif) {
				echo $mysqli->connect_errno . " - " . $mysqli->connect_error;
				exit();
			}
			$i = 0;
			?>
			<div class="panel-body table-responsive">
				<a class='btn btn-warning pull-right' href='add-alternatif.php'> Tambah Data Alternatif</a><br /><br />
				<table id="example" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>No.</th>
							<th>Alternatif</th>
							<th class="text-center"><?php echo ucwords($k[0]); ?></th>
							<th class="text-center"><?php echo ucwords($k[1]); ?></th>
							<th class="text-center"><?php echo ucwords($k[2]); ?></th>
							<th class="text-center"><?php echo ucwords($k[3]); ?></th>
							<th class="text-center"><?php echo ucwords($k[4]); ?></th>
							<th class="text-center">Pilihan</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$i = 1;
						while ($row = $alternatif->fetch_assoc()) {
							echo '<tr>';
							echo '<td>' . $i++ . '</td>';
							echo '<td>' . ucwords($row["alternatif"]) . '</td>';
							echo '<td>' . $row["k1"] . '</td>';
							echo '<td>' . $row["k2"] . '</td>';
							echo '<td>' . $row["k3"] . '</td>';
							echo '<td>' . $row["k4"] . '</td>';
							echo '<td>' . $row["k5"] . '</td>';
							echo '<td><!--a href="#"><i class="fa fa-search"></i></a-->';
						?>
							<a href="edit-alternatif.php?id=<?php echo $row['id_alternatif']; ?>" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i> Edit</a>
							<a href="del.php?id=<?php echo $row['id_alternatif']; ?>" onClick="return confirm('Menghapus data ke-<?php echo $i - 1; ?> Alternatif <?php echo $row['alternatif']; ?> ?');" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Delete</a></td>
						<?php
							echo '</tr>';
						}
						?>
					</tbody>
				</table>
			</div>
			<div class="panel-footer text-primary text-center">
				<i class="fas fa-code"></i>
				<span>Dikembangkan oleh</span>
				<b>Kelompok 3</b>
			</div>

		</div>
	</div>

	</div> <!-- /container -->


	<!-- Bootstrap core JavaScript
    ================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="ui/js/bootstrap.min.js"></script>
	<script src="ui/js/bootswatch.js"></script>
	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	<script src="ui/js/ie10-viewport-bug-workaround.js"></script>
	<!-- Page-Level Demo Scripts - Tables - Use for reference -->
	<script>
		$(document).ready(function() {
			$('#example').dataTable({
				"language": {
					"url": "ui/css/datatables/Indonesian.json"
				}
			});
		});
	</script>
</body>

</html>