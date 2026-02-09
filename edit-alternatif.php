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

    .form-group label {
      font-weight: 600;
      color: #2980b9;
    }

    .form-control {
      border-radius: 8px;
      border: 1px solid #ddd;
      padding: 10px;
      transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .form-control:focus {
      border-color: #2980b9;
      box-shadow: 0 0 5px rgba(41, 128, 185, 0.5);
    }

    .btn {
      border-radius: 8px;
      padding: 10px 20px;
      font-weight: 500;
      transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .btn:hover {
      transform: translateY(-2px);
    }

    .btn-info {
      background-color: #3498db;
      border-color: #3498db;
    }

    .btn-info:hover {
      background-color: #2980b9;
      border-color: #2980b9;
    }

    .btn-warning {
      background-color: #f39c12;
      border-color: #f39c12;
    }

    .btn-warning:hover {
      background-color: #e67e22;
      border-color: #e67e22;
    }

    .btn-primary {
      background-color: #2980b9;
      border-color: #2980b9;
    }

    .btn-primary:hover {
      background-color: #21618c;
      border-color: #21618c;
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
      </div><!--/.nav-collapse -->
    </div><!--/.container-fluid -->
  </nav>
  <div class="container">
    <!-- Main component for a primary marketing message or call to action -->
    <div class="panel panel-primary">
      <!-- Default panel contents -->
      <div class="panel-heading"><i class="fas fa-edit"></i> <b>Edit Data Alternatif</b></div>
      <?php
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
      $result = $mysqli->query("select * from alternatif where id_alternatif = " . $_GET['id'] . "");
      if (!$result) {
        echo $mysqli->connect_errno . " - " . $mysqli->connect_error;
        exit();
      }
      while ($row = $result->fetch_assoc()) {
      ?>
        <div class="panel-body">
          <form role="form" method="post" action="edit.php?id=<?php echo $_GET['id']; ?>">
            <div class="box-body">
              <div class="form-group">
                <label for="alternatif">Alternatif</label>
                <input type="text" class="form-control" name="alternatif" id="alternatif" value="<?php echo $row["alternatif"]; ?>" placeholder="Jenis Kayu">
              </div>
              <div class="form-group">
                <label for="k1"><?php echo ucwords($k[0]); ?></label>
                <select class="form-control" name="k1" id="k1">
                  <option value='1' <?php if ($row["k1"] == '1') echo "selected" ?>>1</option>
                  <option value='2' <?php if ($row["k1"] == '2') echo "selected" ?>>2</option>
                  <option value='3' <?php if ($row["k1"] == '3') echo "selected" ?>>3</option>
                  <option value='4' <?php if ($row["k1"] == '4') echo "selected" ?>>4</option>
                  <option value='5' <?php if ($row["k1"] == '5') echo "selected" ?>>5</option>
                </select>
              </div>
              <div class="form-group">
                <label for="k2"><?php echo ucwords($k[1]); ?></label>
                <select class="form-control" name="k2" id="k2">
                  <option value='1' <?php if ($row["k2"] == '1') echo "selected" ?>>1</option>
                  <option value='2' <?php if ($row["k2"] == '2') echo "selected" ?>>2</option>
                  <option value='3' <?php if ($row["k3"] == '3') echo "selected" ?>>3</option>
                  <option value='4' <?php if ($row["k4"] == '4') echo "selected" ?>>4</option>
                  <option value='5' <?php if ($row["k5"] == '5') echo "selected" ?>>5</option>
                </select>
              </div>
              <div class="form-group">
                <label for="k3"><?php echo ucwords($k[2]); ?></label>
                <select class="form-control" name="k3" id="k3">
                  <option value='1' <?php if ($row["k3"] == '1') echo "selected" ?>>1</option>
                  <option value='2' <?php if ($row["k3"] == '2') echo "selected" ?>>2</option>
                  <option value='3' <?php if ($row["k3"] == '3') echo "selected" ?>>3</option>
                  <option value='4' <?php if ($row["k3"] == '4') echo "selected" ?>>4</option>
                  <option value='5' <?php if ($row["k3"] == '5') echo "selected" ?>>5</option>
                </select>
              </div>
              <div class="form-group">
                <label for="k4"><?php echo ucwords($k[3]); ?></label>
                <select class="form-control" name="k4" id="k4">
                  <option value='1' <?php if ($row["k4"] == '1') echo "selected" ?>>1</option>
                  <option value='2' <?php if ($row["k4"] == '2') echo "selected" ?>>2</option>
                  <option value='3' <?php if ($row["k4"] == '3') echo "selected" ?>>3</option>
                  <option value='4' <?php if ($row["k4"] == '4') echo "selected" ?>>4</option>
                  <option value='5' <?php if ($row["k4"] == '5') echo "selected" ?>>5</option>
                </select>
              </div>
              <div class="form-group">
                <label for="k5"><?php echo ucwords($k[4]); ?></label>
                <select class="form-control" name="k5" id="k5">
                  <option value='1' <?php if ($row["k5"] == '1') echo "selected" ?>>1</option>
                  <option value='2' <?php if ($row["k5"] == '2') echo "selected" ?>>2</option>
                  <option value='3' <?php if ($row["k5"] == '3') echo "selected" ?>>3</option>
                  <option value='4' <?php if ($row["k5"] == '4') echo "selected" ?>>4</option>
                  <option value='5' <?php if ($row["k5"] == '5') echo "selected" ?>>5</option>
                </select>
              </div>
            </div><!-- /.box-body -->

            <div class="box-footer">
              <button type="reset" class="btn btn-info">Reset</button>
              <a href="alternatif.php" type="cancel" class="btn btn-warning">Batal</a>
              <button type="submit" class="btn btn-primary">Proses Edit</button>
            </div>
          </form>
        <?php
      }
        ?>
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
  <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
  <script src="ui/js/ie10-viewport-bug-workaround.js"></script>

</body>

</html>