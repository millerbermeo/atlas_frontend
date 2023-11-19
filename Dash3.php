<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <title>Atlas</title>

    <!-- Custom fonts for this template-->
    <link href="all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="sb-admin-2.min.css" rel="stylesheet">



</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <?php include("menu.php"); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <?php include("menu2.php"); ?>

            <div id="content">
                <!-- Topbar -->
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid" id="contenedor">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>

                        <a type="button" class="btn btn-primary mb-3" id="crearpdf">Generar Reporte</a>


                    </div>


                    <div class="row">
                        <div class="col-xl-12 col-lg-7">

                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Digite los campos a filtrar:</h6>
                                </div>

                                <div class="card-body">
                                    <form id="miFormulario" class="form-horizontal" method="post" action="Dash3.php">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Fecha inicio</label>
                                            <!-- <input type="month" class="form-control" name="name1" aria-describedby="emailHelp" placeholder="Nombre" required> -->
                                            <input type="date" class="form-control" id="fecha" name="fecha" max=""
                                                required>

                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Fecha fin</label>
                                            <!-- <input type="month" class="form-control" name="name1" aria-describedby="emailHelp" placeholder="Nombre" required> -->
                                            <input type="date" class="form-control" id="fecha2" name="fecha2" max=""
                                                required>

                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Agente</label>
                                            <select id="miSelect" name="miSelect" class="form-control" required>
                                                <option value=""></option>
                                                <!-- Las opciones serán agregadas dinámicamente por JavaScript -->
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Zona </label>

                                            <select id="miSelect2" name="miSelect2" class="form-control" required>

                                            </select>

                                        </div>

                                        <button type="submit" class="btn btn-primary">Filtrar</button>
                                    </form>


                                </div>
                            </div>
                        </div>
                    </div>

                    <section id="section-mostar" style="display:none;">
                        <div class="row">
                            <div class="col-xl-12 col-lg-7">

                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Campos filtrados:</h6>
                                    </div>

                                    <div class="card-body">
                                        <div class="form-group">
                                            <h5> Fecha inicio: <span id="mostrarFechaInicio"></span></h5>
                                            <h5> Fecha fin: <span id="mostrarFechaFin"></span></h5>
                                            <h5> Zona: <span id="mostrarZona"></span></h5>
                                            <h5> Agente: <span id="mostrarAgente"></span></h5>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xl-12 col-lg-7">

                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">TOTAL CARTAS GENERADAS</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-bar">
                                            <div class="float-right form-group" style="margin-top: 10px;">
                                                <label for="tipoGrafico" class="form-label"
                                                    style="margin-bottom: 5px; display: block;">Tipo de Gráfico:</label>
                                                <select id="tipoGrafico" class="form-select"
                                                    aria-label="Default select example"
                                                    style="width: 150px; padding: 8px; border-radius: 5px;">
                                                    <option value="bar">Barra</option>
                                                    <option value="doughnut">Doughnut</option>
                                                    <option value="line">Línea</option>
                                                </select>

                                            </div>

                                            <canvas id="myBarChart2" style="width: 100%; max-width: 600px;">
                                            </canvas>


                                        </div>

                                        <hr>

                                    </div>
                                </div>

                                <div id="cartasPorUsuarioContainer"></div>


                                <!-- Content Row -->
                                <div class="row">
                                    <!-- Earnings (Monthly) Card Example -->
                                    <div class="col-xl-3 col-md-6 mb-4">
                                        <div class="card border-left-primary shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div
                                                            class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                            Total empresas cobro</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800"
                                                            id="totalEmpresasCobro">

                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Earnings (Monthly) Card Example -->
                                    <div class="col-xl-3 col-md-6 mb-4">
                                        <div class="card border-left-success shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div
                                                            class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                            Total cartera</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800"
                                                            id="totalCartera">

                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Earnings (Monthly) Card Example -->
                                    <div class="col-xl-3 col-md-6 mb-4">
                                        <div class="card border-left-info shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div
                                                            class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                            % Avance de Cobro
                                                        </div>
                                                        <div class="row no-gutters align-items-center">
                                                            <div class="col-auto">
                                                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"
                                                                    id="avanceCobro">

                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="progress progress-sm mr-2">
                                                                    <div class="progress-bar bg-info" role="progressbar"
                                                                        aria-valuenow="50" aria-valuemin="0"
                                                                        aria-valuemax="100"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Pending Requests Card Example -->
                                    <div class="col-xl-3 col-md-6 mb-4">
                                        <div class="card border-left-warning shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div
                                                            class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                            Clientes impactados</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800"
                                                            id="clientesImpactados">

                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>




                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">EMPRESAS CON MAS CARTERA:</h6>
                                    </div>

                                    <div class="card-body">
                                        <!-- <h2>Gráfico de Barras</h2> -->
                                        <label for="tipoGrafico">Selecciona el tipo de gráfico:</label>
                                        <select id="tipoGrafico2" name="tipoGrafico2">
                                            <option value="bar">Gráfico de Barras</option>
                                            <option value="pie">Gráfico de Pastel</option>
                                            <option value="line">Gráfico de Líneas</option>
                                        </select>

                                        <div class="chart-container">
                                            <canvas id="graficoBarras" style="width: 100%; max-width: 600px;"></canvas>
                                        </div>

                                    </div>
                                </div>
                            </div>


                        </div>
                    </section>
                    <!-- <div class="row">
                  <div class="col-xl-12 col-lg-7">

                  <div class="card shadow mb-4">
                      <div class="card-header py-3">
                          <h6 class="m-0 font-weight-bold text-primary">Cartas generadas:</h6>
                      </div>

                      <div class="card-body">
                        <div style="width: 90%;">
                            <canvas id="barChartcartas"></canvas>
                        </div>
                      </div>
                  </div>
                </div>
              </div> -->







                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Atlas 2023</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Bootstrap core JavaScript-->
        <script src="../plantilla/vendor/jquery/jquery.min.js"></script>
        <script src="../plantilla/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../plantilla/js/demo/canvasjs.min.js"></script>



        <!-- Core plugin JavaScript-->
        <script src="../plantilla/vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="../plantilla/js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="../plantilla/vendor/chart.js/Chart.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="../plantilla/js/demo/chart-area-demo.js"></script>
        <script src="../plantilla/js/demo/chart-bar-demo.js"></script>





        <script src="app.js"></script>

</body>

</html>