<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Gestion</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{asset('logincssjs/images/icons/favicon.ico')}}"/>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{asset('plugins/jqvmap/jqvmap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- jQuery -->
    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- ChartJS -->
    <script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
    <!-- Sparkline
    <script src="{{asset('plugins/sparklines/sparkline.js')}}"></script>
    <!-- JQVMap
    <script src="{{asset('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
    <script src="{{asset('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>-->
    <!-- jQuery Knob Chart -->
    <script src="{{asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
    <!-- daterangepicker -->
    <script src="{{asset('plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
    <!-- Summernote -->
    <script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
    <!-- overlayScrollbars -->
    <script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('dist/js/adminlte.js')}}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes)
    <script src="/dist/js/pages/dashboard.js')}}"></script>-->
    <!-- ChartJS -->
    <script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('dist/js/demo.js')}}"></script>
    <!-- page script -->
    <script>
        $(document).ready(function(){
       classeCounter(), studentCounter(), courseCounter(), teacherCounter();
           dashbordPieChart();
           dashbordChart();
           /*var d = new Date();
           var dateYear = d.getFullYear()
           $("#yearId").html((dateYear-1)+'-'+dateYear);*/
        });

       /* function getUsers(id){
            $.ajax({
                url:window.origin+'/getUser/'+id,
                type: 'GET',
                dataType: 'json',
                success:function(response) {
                    console.log(response);

                } // /success
            }); // /ajax
        }*/

        function getUsersSession(){
            $.ajax({
                url:window.origin+'/users',
                type: 'GET',
                dataType: 'json',
                success:function(response) {
                    console.log(response);
                    $("#userId").html(response._embedded.users[0].username);

                    //getUsers(response.data);

                } // /success
            }); // /ajax
        }






        function classeCounter(){
            $.ajax({
                url:"/countClasse",
                type:'get',
                dataType :"json",
                success:function(response) {
                    console.log(response);
                    $("#counterClasseId").html(response.data[0].counter);
                }
            });
        }
        
        
        function studentCounter(){
            $.ajax({
                url:"/countStudent",
                type:'get',
                dataType :"json",
                success:function(response) {
                    console.log(response);
                    $("#counterStudentId").html(response.data[0].counter);
                }
            });
        }


        function courseCounter(){
            $.ajax({
                url:"/countCourse",
                type:'get',
                dataType :"json",
                success:function(response) {
                    console.log(response);
                    $("#counterCourseId").html(response.data[0].counter);
                }
            });
        }
        
        
          function teacherCounter(){
            $.ajax({
                url:"/countTeacher",
                type:'get',
                dataType :"json",
                success:function(response) {
                    console.log(response);
                    $("#counterTeacherId").html(response.data[0].counter);
                }
            });
        }
       
            /* ChartJS
             * -------
             * Here we will create a few charts using ChartJS
             */

            //--------------
            //- AREA CHART -
            //--------------

            // Get context with jQuery - using jQuery's .get() method.
            function dashbordChart(){
                var d = new Date();
                var dateYear = d.getFullYear();
                $.ajax({
                    url:'/getStudentByYear',
                    type:'get',
                    dataType :"json",
                    success:function(response) {
                        console.log(response);
            //var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
            var areaChartData = {
                labels  : ['Etudiants'],
                datasets: [
                    {
                        label               : dateYear-1+'-'+dateYear,
                        backgroundColor     : '#3ac47d',
                        borderColor         : '#3ac47d',
                        pointRadius         : true,
                        pointColor          : '#3ac47d',
                        pointStrokeColor    : '#28a745',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data                : [response.data1[0].counter]
                    },
                    {
                        label               : (dateYear-2)+'-'+(dateYear-1),
                        backgroundColor     : '#17a2b8',
                        borderColor         : '#17a2b8',
                        pointRadius         : true,
                        pointColor          : 'rgba(210, 214, 222, 1)',
                        pointStrokeColor    : '#c1c7d1',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: '#17a2b8',
                        data                : [response.data2[0].counter]
                    },
                    {
                        label               : (dateYear-3)+'-'+(dateYear-2),
                        backgroundColor     : '#d92550',
                        borderColor         : '#d92550',
                        pointRadius         : true,
                        pointColor          : 'rgba(80, 60, 200, 1)',
                        pointStrokeColor    : '#c1c7d1',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: '#d92550',
                        data                : [response.data3[0].counter]
                    },
                ]
            }

            var areaChartOptions = {
                maintainAspectRatio : false,
                responsive : true,
                legend: {
                    display: true
                },
                scales: {
                    xAxes: [{
                        gridLines : {
                            display : false,
                        }
                    }],
                    yAxes: [{
                        gridLines : {
                            display : false,
                        }
                    }]
                }
            }

            // This will get the first returned node in the jQuery collection.
             /*var areaChart  = new Chart(areaChartCanvas, {
                type: 'line',
                data: areaChartData,
                options: areaChartOptions
                })*/


                //-------------
                //- BAR CHART -
                //-------------
                var barChartCanvas = $('#barChart').get(0).getContext('2d')
                var barChartData = jQuery.extend(true, {}, areaChartData)
                var temp0 = areaChartData.datasets[0]
                var temp1 = areaChartData.datasets[1]
                var temp2 = areaChartData.datasets[2]
                barChartData.datasets[0] = temp0
                barChartData.datasets[1] = temp1
                barChartData.datasets[2] = temp2
                var barChartOptions = {
                    responsive              : true,
                    maintainAspectRatio     : false,
                    datasetFill             : false
                }

                var barChart = new Chart(barChartCanvas, {
                    type: 'bar',
                    data: barChartData,
                    options: barChartOptions
                })

                //-------------
                //- LINE CHART -
                //--------------
              /*  var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
                 var lineChartOptions = jQuery.extend(true, {}, areaChartOptions)
                 var lineChartData = jQuery.extend(true, {}, areaChartData)
                 lineChartData.datasets[0].fill = false;
                 lineChartData.datasets[1].fill = false;
                 lineChartOptions.datasetFill = false

                 var lineChart = new Chart(lineChartCanvas, {
                 type: 'line',
                 data: lineChartData,
                 options: lineChartOptions
                 })*/

            }

        });
    }





            //-------------
            //- DONUT CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
        function dashbordPieChart(){
            var d = new Date();
            var dateYear = d.getFullYear();
            $.ajax({
                url:'/dashbordStudent',
                type:'get',
                dataType :"json",
                success:function(response) {
                    console.log(response);
                   /* for(var i in response.firstData){
                        firstYearTotal +=response.firstData[i];
                    }
                    for(var i in response.secondData){
                        secondYearTotal +=response.secondData[i];
                    }

                    for(var i in response.thirtyData){
                        threeYearTotal +=response.thirtyData[i];
                    }*/

                    var donutData = {
                        labels: [
                           "Masculin",
                           "Feminin"
                        ],
                        datasets: [
                            {
                                data: [response.data[0].counter, response.datas[0].counter],
                                backgroundColor: [ '#3c8dbc', '#f39c12','#f56954', '#00c0ef',  ],
                            }
                        ]
                    }

                    //-------------'#00a65a','#d2d6de'
                    //- PIE CHART -
                    //-------------
                    // Get context with jQuery - using jQuery's .get() method.
                    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
                    var pieData = donutData;
                    var pieOptions = {
                        maintainAspectRatio: false,
                        responsive: true,
                    }
                    //Create pie or douhnut chart
                    // You can switch between pie and douhnut using the method below.
                    var pieChart = new Chart(pieChartCanvas, {
                        type: 'pie',
                        data: pieData,
                        options: pieOptions
                    });

                }
            });
        }

    </script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
    @include('fragment.header');
    
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->


            <!-- Sidebar Menu -->
           @include('fragment.nav');
            <!-- /.sidebar-menu -->


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Tableau de bord</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                       <!-- <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v1</li>
                        </ol>-->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h4 id="counterTeacherId">0</h4>

                                <p>Total Professeur</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-user-plus"></i>
                            </div>
                            <a href="{{route('teacher')}}"  class="small-box-footer">Plus d'information <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h4 id="counterStudentId">0<sup style="font-size: 20px"></sup></h4>

                                <p>Total Etudiant</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-users"></i>
                            </div>
                            <a href="{{route('student')}}"  class="small-box-footer">Plus d'information <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h4 id="counterClasseId">0</h4>

                                <p>Total Classe</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-graduation-cap"></i>
                            </div>
                            <a href="{{route('classRoom')}}" class="small-box-footer">Plus d'information <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h4 id="counterCourseId">0</h4>

                                <p>Total Matière</p>
                            </div>
                            <div class="icon">
                                <i class="far fa fa-spinner fa-spin fa-3x fa-fw"></i>
                            </div>
                            <a href="{{route('course')}}"  class="small-box-footer">Plus d'information <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->
                <!-- Main row -->
                    <div class="row">
                        <div class="col-md-6">
                            <!-- AREA CHART -->
                            <div class="card card-green">
                                <div class="card-header">
                                    <h3 class="card-title">Graphe des etudiants par année scolaire</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <div class="chart">
                                        <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->

                            <!-- LINE CHART 
                            <div class="card card-green">
                                <div class="card-header">
                                    <h3 class="card-title">Courbe des prêts annuels</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart">
                                        <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card -->


                        </div>
                        <!-- /.col (LEFT) -->
                        <div class="col-md-6">

                            <!-- PIE CHART -->
                            <div class="card card-blue">
                                <div class="card-header">
                                    <h3 class="card-title">Graphe des etudiants par sexe</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->

                            <!-- BAR CHART 
                            <div class="card card-blue">
                                <div class="card-header">
                                    <h3 class="card-title">Courbe des prêts mensuels</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart">
                                        <canvas id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card -->



                        </div>
                        <!-- /.col (RIGHT) -->
                    </div>
                    <!-- /.row -->
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    < @include('fragment.footer');

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


</body>
</html>
