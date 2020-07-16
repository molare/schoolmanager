<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Gestion</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{asset('logincssjs/images/icons/favicon.ico')}}"/>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- dataTables css -->
    <link href="{{asset('plugins/datatables/dataTables.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('plugins/data-tables/datatables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('plugins/data-tables/responsive.datatables.min.css')}}" rel="stylesheet" type="text/css"/>
      <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{asset('plugins/toastr/toastr.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- jQuery -->
    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    
        <!-- Select2 -->
    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('plugins/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>
    <!-- dataTables js -->
    <script src="{{asset('plugins/data-tables/jquery.datatables.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('plugins/data-tables/datatables.bootstrap4.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('plugins/data-tables/datatables.responsive.min.js')}}" type="text/javascript"></script>
    <!--Date pickers-->
<!--    <script src="assets/plugins/datepicker/js/moment-with-locales.min.js"></script>
    <script src="../bower_components/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>-->
    <!-- SweetAlert2 -->
    <script src="{{asset('plugins/sweetalert2/sweetalert2.min.js')}}"></script>
    <!-- Toastr -->
    <script src="{{asset('plugins/toastr/toastr.min.js')}}"></script>
    <script src="{{asset('plugins/toast.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('dist/js/demo.js')}}"></script>
    <!-- page script -->
    
      <style>
  .hvr-shrinks:hover {
    display: inline-block;
    vertical-align: middle;
    -webkit-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;   
    -webkit-transform: scale(5.1);
    transform: scale(5.1)
}

 .hvr-shrink:hover {
    display: inline-block;
    vertical-align: middle;
    -webkit-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;   
    -webkit-transform: scale(1.1);
    transform: scale(1.1)
}

 .zoom:hover {
    display: inline-block;
    vertical-align: middle;
    -webkit-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;   
    -webkit-transform: scale(1.1);
    transform: scale(3.1)
}

#loadingId {
    width: 100%;
    height: 100%;
    top: 0px;
    left: 0px;
    position: fixed;
    display: block;
    opacity: 0.6;
    background-color: #F8F8F8;
    z-index: 99;
    text-align: center;
 
}

#editLoadingId {
    width: 100%;
    height: 100%;
    top: 0px;
    left: 0px;
    position: fixed;
    display: block;
    opacity: 0.6;
    background-color: #F8F8F8;
    z-index: 99;
    text-align: center;
 
}
</style> 
    <!-- PAGE LEVEL SCRIPTS-->
    <script type="text/javascript">

        var table;
        $(document).ready(function(){
             $('#loadingId').hide();
            $('[data-mask]').inputmask()
            table= $('#paymentTable').DataTable({
                "responsive": true,
                "autoWidth":false,
                //"sAjaxSource":"{{route('payments.index')}}",
                "sAjaxDataProp":"data",
                "oLanguage": {
                    "sLengthMenu": "_MENU_ Enregistrements",
                    "sSearch":"<span class=add-on><i class=fa fa-search></i></span>Recherche",
                    "sZeroRecords": "Aucun résultat",
                    "sInfo": "Affichage de _START_ à _END_ sur _TOTAL_",
                    "sInfoEmpty": "Affichage de 0 à 0 sur 0 Enregistrements",
                    "oPaginate": {
                        "sNext": 'Suivant',
                        "sPrevious": 'Précèdent',
                    },
                    "select": {
                        "rows": {
                            "_": " %d ligne sélectionnée(s)",
                            "1": "1 ligne sélectionnée"
                        }
                    }
                },
                "aLengthMenu": [
                    [10, 25, 100, -1],
                    [10, 25, 100, " Tous"]
                ],
                  "dom": '<"row justify-content-between top-information"lf>rt<"row justify-content-between bottom-information"ip><"clear">',

                  "ajax":{
                    "url" :"{{route('payments.index')}}",
                    "dataSrc" :""

                },
                "aaSorting": [
                    [0, 'desc'],
                    [1, 'asc']
                ], "columns":[
                    {"data":"dateFormat"},
                     {"data":"date_payment"},
                    {"data":"genre_id"},
                    {"data":"register_number"},
                    {"data": "first_name"},
                    {"data":"last_name"},
                    {"data":"classe"},
                    {"data":"amount"},
                    {"data":"rest"},
                    {"data":"action"}

                ],
                'columnDefs': [{
                    'className': 'select-checkbox',
                    'targets': 0,
                    'checkboxes': {
                        'selectRow': true
                    }
                }],
                'select': {
                    'style': 'multi'
                }

            });
            //FIN DATATABLE
   
  

            //IF OPEN MODAL
            $("#btnAddNew").click(function(){
            //$("#pictureId").html('<img  src="/images/avatar.png" border="0" width="200" class="hvr-shrink img-rounded" alt="image" />');

                $("#paymentForm")[0].reset();
                $(".col-md-4").removeClass('has-error').removeClass('has-success');
                $(".text-danger").remove();
                $('#loadingId').hide();
                $(".messages").html("");
                getSchoolYearActive();

                //studentOption();
                classeOption();
                $('#classeId').change(function(){
                    studentOption($(this).val())
                });
                
                paymenttypeOption();

            });

            //FONCTION ADD DEVIS
            $("#btnAddpaymentId").on('click', function(){
                $(".text-danger").remove();
                $(".col-md-4").removeClass('has-error').removeClass('has-success');
              //var form_data = new FormData($('#paymentForm')[0]);
                    $.ajax({
                        url: "{{route('payments.store')}}",
                        type: 'POST',
                        data:$("#paymentForm").serialize(),
                        dataType: "json",
                        beforeSend: function() {
                         $('#loadingId').show();
                         },
                        success: function (response) {
                            console.log(response);
                             $('#loadingId').hide();
                            // remove the error
                            $(".form-group").removeClass('has-error').removeClass('has-success');
                            if (response.success === true) {
                                showAddToast();

                                $("#paymentForm")[0].reset();
                                $("#addpaymentModal").modal("hide");
                                table.ajax.reload(null, false);
                            }else{
                                if (response.data != null) {
                                    showErrorToast();
                                    $(".messages").html('<div class="alert alert-danger alert-dismissable fade show">' +
                                            '<button class="close" data-dismiss="alert" aria-label="Close">×</button><strong>ERREUR!</strong> ' + response.data.cause.serverErrorMessage.detail +
                                            '</div>');

                                }else{
                                    $(".messages").html('<div class="alert alert-danger alert-dismissable fade show">' +
                                            '<button class="close" data-dismiss="alert" aria-label="Close">×</button><strong>ERREUR!</strong> ' + response.message +
                                            '</div>');

                                }
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                         $('#loadingId').hide();
                        console.log(jqXHR);
                       if(jqXHR.responseJSON.errors.first_name !==undefined){
                             $("#firstNameId").after('<p class="text-danger">'+jqXHR.responseJSON.errors.first_name+'</p>');
                             }
                             
                             if(jqXHR.responseJSON.errors.last_name !==undefined){
                             $("#lastNameId").after('<p class="text-danger">'+jqXHR.responseJSON.errors.last_name+'</p>');
                             }

                        }
                    });
                
            });

            //FIN ADD DEVIS
        });


        //FUNCTION UPDATE DEVIS
        function editPayment(id){
            if(id) {
                // remove the error
                $(".col-md-4").removeClass('has-error').removeClass('has-success');
                $(".text-danger").remove();
                // empty the message div
                $(".edit-messages").html("");
                // $("#editPicture").val('');
                $('#editLoadingId').hide();
                $("#editSchoolYearActiveId").html("");
                $("#editSchoolYearActive").val("");
                // remove the id
                $("#payment_edit_id").remove();
                // fetch the member data
                $.ajax({
                    url:"/payments/"+id,
                    type: 'get',
                    dataType: 'json',
                    success:function(response) {
                        console.log(response);
                         editClasseOption(response.student.classe.id,response.student.classe.name);
                         editStudentOption(response.student.id,response.student.first_name+' '+response.student.last_name)
                         //editClasseOption(response.student.id)
                         editPaymentTypeOption(response.data.payment_type.id,response.data.payment_type.name);
                         $("#editSchoolYearActive").val(response.student.schoolYear.name);
                         $("#editDatePaymentId").val(response.data.date_payment);
                         $("#editAmountId").val(response.data.amount);
                         $("#editDescriptionId").val(response.data.description);
                        $("#editSchoolYearActiveId").append('<option value='+response.student.schoolYear.id+'>'+response.student.schoolYear.name+'</option>');

                        $("#editpaymentForm").append('<input type="hidden" name="id" id="payment_edit_id" value="'+response.data.id+'"/>');
                        // here update the member data
                        $("#btnUpdatepaymentId").unbind('click').bind('click', function(){

                            // remove error messages
                            $(".text-danger").remove();
                            var editForm_data = new FormData($('#editpaymentForm')[0]);
                                var idpayment =$("#payment_edit_id").val();
                                  $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                                
                                $.ajax({
                                    url:"/payments/"+idpayment,
                                    type:'POST',
                                    data:$("#editpaymentForm").serialize(),
                                  
                                    //dataType :"json",
                                     beforeSend: function() {
                                     $('#editLoadingId').show();
                                     },
                                    success:function(response) {
                                        $('#editLoadingId').hide();
                                         console.log("response1")
                                        console.log(response)
                                         console.log("response2")
                                        if(response.status === true) {
                                            showUpdateToast();

                                            $("#editPaymentModal").modal("hide");
                                            // reload the datatables
                                            table.ajax.reload(null, false);
                                            // remove the error
                                            $(".form-group").removeClass('has-success').removeClass('has-error');
                                            $(".text-danger").remove();

                                            // remove the id
                                            $("#payment_edit_id").remove();
                                        } else {
                                            showErrorToast();
                                            $(".edit-messages").html('<div class="alert alert-danger alert-dismissible" role="alert">'+
                                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                                    '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.message+
                                                    '</div>')
                                        }
                                    },
                                    error: function(jqXHR, textStatus, errorThrown){
                                     $('#editLoadingId').hide();
                                    console.log(jqXHR);
                                      /*if(jqXHR.responseJSON.errors.name !==undefined){
                                        $("#editNameId").after('<p class="text-danger">'+jqXHR.responseJSON.errors.name+'</p>');
                                        }
                             
                                        if(jqXHR.responseJSON.errors.description !==undefined){
                                        $("#editDescriptionId").after('<p class="text-danger">'+jqXHR.responseJSON.errors.description+'</p>');
                                        }*/                                
                                      }
                                }); // /ajax
                         
                        });

                    }
                }); //fetch selected member info

            } else {
                alert("Error : Refresh the page again");
            }
        }

        //FIN UPDATE DEVIS

        //FUNCTION DELETE COMUNNE

        function removePayment(id){
            if(id) {
                $(".removeMessages").html('');
                // click on remove button
                $("#removeBtn").unbind('click').bind('click', function() {
                    
                        $.ajaxSetup({
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: "/payments/"+id,
                        type: 'DELETE',
                        dataType: 'json',
                        success:function(response) {
                            console.log(response)
                            if(response.status === true) {
                                showDeleteToast();
                                // refresh the table
                                table.ajax.reload(null, false);
                                // close the modal
                                $("#removePaymentModal").modal('hide');

                            } else {
                                showErrorToast();
                                $(".removeMessages").html('<div class="alert alert-danger alert-dismissible" role="alert">'+
                                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                        '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.message+
                                        '</div>');
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown){
                            showErrorToast();
                             console.log(jqXHR);
                            /*if(jqXHR.status ==403){
                             window.location = window.origin + "/spring-boot-apps/errorAuthorise";
                             }else {
                             window.location = window.origin + "/spring-boot-apps/pageError";
                             }*/
                        }
                    });
                }); // click remove btn
            } else {
                alert('Error: Refresh the page again');
            }
        }

        //FIN DELETE DEVIS

 //LIST Classe OPTION
        function classeOption(){
            $.ajax({
                url:"{{route('classRooms.index')}}",
                type:'GET',
                dataType :"json",
                success:function(response){
                    console.log(response);
                    $("#classeId").html('');
                    $("#classeId").append('<option value='+0+'>'+' '+'</option>');
                    $.each(response, function(key, val){
                       $("#classeId").append('<option value='+val.id+'>'+val.name+'</option>');
                    });
                }
            });
        }
    //FIN
    
    
      //LIST EDIT product OPTION
        function editClasseOption(valId, valText){
            $.ajax({
                url:"{{route('classRooms.index')}}",
                type:'GET',
                dataType :"json",
                success:function(response){
                    console.log(response);
                    $("#editClasseId").html('');
                    $("#editClasseId").append('<option value='+valId+'>'+valText+'</option>');
                    /*$.each(response, function(key, val){
                        if(valId!=val.id){
                        $("#editClasseId").append('<option value='+val.id+'>'+val.name+'</option>');
                        }
                    });*/
                }
            });
        }
    //FIN
    //
     //PAYMENTTYPE OPTION
            function paymenttypeOption(){
            $.ajax({
                url:"{{route('paymentTypes.index')}}",
                type:'GET',
                dataType :"json",
                success:function(response){
                    console.log(response);
                    $("#paymentTypeId").html('');
                    $("#paymentTypeId").append('<option value='+0+'>'+' '+'</option>');
                    $.each(response, function(key, val){
                       $("#paymentTypeId").append('<option value='+val.id+'>'+val.name+'</option>');
                    });
                }
            });
        }
    //FIN
    
    
      //LIST EDIT product OPTION
        function editPaymentTypeOption(valId, valText){
            $.ajax({
                url:"{{route('paymentTypes.index')}}",
                type:'GET',
                dataType :"json",
                success:function(response){
                    console.log(response);
                    $("#editPaymentTypeId").html('');
                    $("#editPaymentTypeId").append('<option value='+valId+'>'+valText+'</option>');
                    $.each(response, function(key, val){
                        if(valId!=val.id){
                        $("#editPaymentTypeId").append('<option value='+val.id+'>'+val.name+'</option>');
                        }
                    });
                }
            });
        }
    //FIN
    
      //STUDENT OPTION
            function studentOption(id){
            $.ajax({
                url:"/getStudentByClasse/"+id,
                type:'GET',
                dataType :"json",
                success:function(response){
                    console.log(response);
                    $("#studentId").html('');
                    $("#studentId").append('<option value='+0+'>'+' '+'</option>');
                    $.each(response.data, function(key, val){
                        //$("#pictureId").html('<img  src="/images/'+val.photo+'" border="0" width="200" class="hvr-shrink img-rounded" alt="image" />');
                       $("#studentId").append('<option value='+val.id+'>'+val.first_name+' '+val.last_name+'</option>');
                    });
                }
            });
        }
        
           
      //LIST EDIT product OPTION
        function editStudentOption(valId, valText){
            $.ajax({
                url:"{{route('students.index')}}",
                type:'GET',
                dataType :"json",
                success:function(response){
                    console.log(response);
                    $("#editStudentId").html('');
                    $("#editStudentId").append('<option value='+valId+'>'+valText+'</option>');
                    /*$.each(response, function(key, val){
                        if(valId!=val.id){
                        $("#editStudentId").append('<option value='+val.id+'>'+val.first_name+' '+val.last_name+'</option>');
                        }
                    });*/
                }
            });
        }
    //FIN
    
   
        
        
          function getSchoolYearActive(){
            $.ajax({
                url:"/getSchoolYearActive",
                type:'GET',
                dataType :"json",
                success:function(response){
                    console.log(response);
                     $("#schoolYearActive").val(response.data[0].name);
                     $("#schoolYearActiveId").append('<option value='+response.data[0].id+'>'+response.data[0].name+'</option>');
                },
                error: function(jqXHR, textStatus, errorThrown){
                       console.log(jqXHR);
                 }
            });
        }

    </script>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Navbar -->
     @include('fragment.header');
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('fragment.nav');

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Liste Paiement</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <!-- /.card -->

                    <div class="card">
                        <div class="card-header">
                            <button class="btn btn-success" data-toggle="modal" data-target="#addpaymentModal" id="btnAddNew"><i class="fa fa-plus"></i>Ajouter</button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="responsive-data-table">
                                <table id="paymentTable"  class="table dt-responsive nowrap table-hover  table-striped" >
                                    <thead>
                                    <tr>
                                        
                                        <th>Date création</th>
                                        <th>Date Paiement</th>
                                        <th>Sexe</th>
                                        <th>Matricule</th>
                                        <th>Nom</th>
                                        <th>Prenom</th>
                                        <th>Classe</th>
                                        <th>Montant Versé</th>
                                        <th>Montant à payer</th>
                                        <th data-priority ="1">Action</th>
                                    </tr>
                                    </thead>

                                    <tfoot>
                                    <tr>
                                       
                                        <th>Date création</th>
                                        <th>Date Paiement</th>
                                        <th>Sexe</th>
                                        <th>Matricule</th>
                                        <th>Nom</th>
                                        <th>Prenom</th>
                                        <th>Classe</th>
                                        <th>Montant Versé</th>
                                        <th>Montant à payer</th>
                                         <th data-priority ="1">Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    @include('fragment.footer');

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!-- Add product Modal-->
<div class="modal fade" id="addpaymentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    NOUVEAU PAIEMENT</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <!--FORMULIARE-->
                <form id="paymentForm" autocomplete="off" >
                    
                     {{csrf_field()}}
                    <div class="messages"></div>
                    
                  <div id="loadingId">
                    <img id="loading-image" src="/images/ajax-loader.gif" alt="Loading..." />
                  </div>
                    
                    <div class="form-group row">
                        <div class="col-sm-6">
                         <div class="form-group">
                          <div class="" id="pictureId">
<!--                          <img  src="/images/avatar.png" border="0" width="200" class="hvr-shrink img-rounded" alt="image" />-->
                          </div>
                       </div>
                       </div> 
                        
                        <div class="col-sm-6">
                            <label class="control-label col-sm-6">Année Scolaire</label>
                            <div class="col-md-4">
                                <input name="schoolYearActive" id="schoolYearActive" class="form-control" type="text" disabled="true">
                           </div>
                              <span class="help-block"></span>
                        </div>
                     </div> 
                    
                     <div class="form-group row">
                         <div class="col-sm-6">
                              <label class="control-label col-sm-6">Date Paiement</label>
                              <div class="input-group col-md-12">
                                     <div class="input-group-prepend">
                                         <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                     </div>
                                     <input name="datePayment" id="datePaymentId" class="form-control" type="text" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask>
                                     <span class="help-block"></span>
                               </div>
                         </div>
                         
                          <div class="col-sm-6">
                             <label class="control-label col-sm-6">Type Paiement</label>
                            <div class="col-md-12">
                                <select class="form-control" id="paymentTypeId" name="paymentType">
                                </select>
                            </div>
                        </div>
                     </div> 
                    
                     <div class="form-group row">
                         
                         <div class="col-sm-6">
                             <label class="control-label col-sm-4">Classe</label>
                                 <div class="col-md-12">
                                <select class="form-control" id="classeId" name="classe">
                                </select>
                                     <span class="help-block"></span>
                                 
                               </div>
                        </div>
                         
                        <div class="col-sm-6">
                             <label class="control-label col-sm-4">Etudiant</label>
                                 <div class="col-md-12">
                                     <select class="form-control select2" id="studentId" name="student"></select>
                                     <span class="help-block"></span>
                                 </div>
                        </div>
                         
                    </div>
                    
                    <div class="form-group row">
                         
                        <div class="col-sm-6">
                            <label class="control-label col-sm-2">Montant</label>
                            <div class="input-group col-md-12">
                                <input name="amount" id="amountId" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        
                         <div class="col-sm-6">
                            <label class="control-label col-sm-6">Moyen de paiement</label>
                                 <div class="col-md-12">
                                     <select class="form-control select2" id="payWayId" name="payWay">
                                         <option value="1">Espèce</option>
                                         <option value="2">Chèque</option>
                                         <option value="3">Carte bancaire</option>
                                     </select>
                                     <span class="help-block"></span>
                                 </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-md-12">Description</label>
                        <div class="col-md-12">
                            <textarea name="description" id="descriptionId" class="form-control"></textarea>

                            <span class="help-block"></span>
                        </div>
                    </div>
                    
                  <select class="form-control" id="schoolYearActiveId" name="schoolYear" hidden="true">
                 </select>
                </form>
            </div>
            
            <div class="modal-footer">
               
                <button class="btn btn-success" id="btnAddpaymentId" type="submit"><i class="fa fa-check"></i>Enregistrer</button>
                <button class="btn btn-danger" type="button" data-dismiss="modal">Annuler</button>
            </div>
        </div>
    </div>
</div>
<!-- Fin add product -->

<!-- Edit product Modal-->
<div class="modal fade" id="editPaymentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabels">
                    MODIFIER PAIEMENT</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <!--FORMULIARE-->
                <form id="editpaymentForm" autocomplete="off">
                      {{csrf_field()}}
                    <input type="hidden" name="_method" value="PUT">
                    <div class="edit-messages"></div>
                    
                  <div id="editLoadingId">
                    <img id="loading-image" src="/images/ajax-loader.gif" alt="Loading..." />
                  </div>
                    
                    <div class="form-group row">
                        <div class="col-sm-6">
                         <div class="form-group">
                          <div class="" id="editPictureId">
                          </div>
                       </div>
                       </div> 
                        
                        <div class="col-sm-6">
                            <label class="control-label col-sm-6">Année Scolaire</label>
                            <div class="col-md-4">
                                <input name="schoolYearActive" id="editSchoolYearActive" class="form-control" type="text" disabled="true">
                           </div>
                              <span class="help-block"></span>
                        </div>
                     </div> 
                    
                     <div class="form-group row">
                         <div class="col-sm-6">
                              <label class="control-label col-sm-6">Date Paiement</label>
                              <div class="input-group col-md-12">
                                     <div class="input-group-prepend">
                                         <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                     </div>
                                     <input name="datePayment" id="editDatePaymentId" class="form-control" type="text" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask>
                                     <span class="help-block"></span>
                               </div>
                         </div>
                         
                          <div class="col-sm-6">
                             <label class="control-label col-sm-6">Type Paiement</label>
                            <div class="col-md-12">
                                <select class="form-control" id="editPaymentTypeId" name="paymentType">
                                </select>
                            </div>
                        </div>
                     </div> 
                    
                     <div class="form-group row">
                        <div class="col-sm-6">
                             <label class="control-label col-sm-4">Etudiant</label>
                                 <div class="col-md-12">
                                     <select class="form-control select2" id="editStudentId" name="student" readonly="true"></select>
                                     <span class="help-block"></span>
                                 </div>
                        </div>
                         
                         <div class="col-sm-6">
                             <label class="control-label col-sm-4">Classe</label>
                                 <div class="col-md-12">
                                     <select class="form-control" id="editClasseId" name="classe" readonly="true"></select>
                                     <span class="help-block"></span>
                                 </div>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                         
                        <div class="col-sm-6">
                            <label class="control-label col-sm-2">Montant</label>
                            <div class="input-group col-md-12">
                                <input name="amount" id="editAmountId" class="form-control" type="text" readonly="true">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        
                         <div class="col-sm-6">
                            <label class="control-label col-sm-6">Moyen de paiement</label>
                                 <div class="col-md-12">
                                     <select class="form-control select2" id="editPayWayId" name="payWay">
                                         <option value="1">Espèce</option>
                                         <option value="2">Chèque</option>
                                         <option value="3">Carte bancaire</option>
                                     </select>
                                     <span class="help-block"></span>
                                 </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-md-12">Description</label>
                        <div class="col-md-12">
                            <textarea name="description" id="editDescriptionId" class="form-control"></textarea>

                            <span class="help-block"></span>
                        </div>
                    </div>
                    
                  <select class="form-control" id="editSchoolYearActiveId" name="schoolYear" hidden="true">
                 </select>
                </form>
            </div>
            
            <div class="modal-footer">
               
                <button class="btn btn-success" id="btnUpdatepaymentId" type="submit"><i class="fa fa-check"></i>Enregistrer</button>
                <button class="btn btn-danger" type="button" data-dismiss="modal">Annuler</button>
            </div>
        </div>
    </div>
</div>
<!-- Fin update product -->

<!-- delete product modal-->
<div class="modal fade" id="removePaymentModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel">
                    SUPPRIMER PROFESSUER</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="removeMessages"></div>
                Voulez vous supprimer cette ligne?
            </div>
            <div class="modal-footer">
                <button type="button" id="removeBtn"  class="btn btn-success ">Supprimer</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
            </div>
        </div>
    </div>
</div>
<!--Fin modal delete-->


<!-- Edit product Modal-->
<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabels">
                    INFORMATION ETUDIANT</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <div class="" id="editPictureIds">
                   </div>
                </div>

                  <h3 class="profile-username text-center"><label id="editFirstNameIds"></label></h3>
                  <h3 class="profile-username text-center"><label id="editLastNameIds"></label></h3>
                <p class="text-muted text-center"><label>Etudiant</label></p>

                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#paymentOngletDetail" data-toggle="tab">Profile</a></li>
                  <li class="nav-item"><a class="nav-link" href="#studentOngletDetail" data-toggle="tab">Tuteur</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Scolarité</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                    
                    
                    <div class="active tab-pane" id="paymentOngletDetail">
                    <form class="form-horizontal" id="paymentDetail">
                     <ul class="list-group list-group-unbordered mb-12">
                   <li class="list-group-item">
                    <b>Date d'enregistrement</b> <a class="float-right" id="editDateIds"></a>
                  </li>
                  <li class="list-group-item">
                    <b>PaymentType</b> <a class="float-right" id="editPaymentTypeIds"></a>
                  </li>
                  <li class="list-group-item">
                    <b>Matricule</b> <a class="float-right" id="editMatIds"></a>
                  </li>
                  <li class="list-group-item">
                    <b>Classe</b> <a class="float-right" id="editClasseIds"></a>
                  </li>
                  <li class="list-group-item">
                    <b>Téléphone 1</b> <a class="float-right" id="editPhoneIds"></a>
                  </li>
                  <li class="list-group-item">
                    <b>Téléphone 2</b> <a class="float-right" id="editCelIds"></a>
                  </li>
                  <li class="list-group-item">
                    <b>Email</b> <a class="float-right" id="editEmailIds"></a>
                  </li>
                  <li class="list-group-item">
                    <b>Adresse</b> <a class="float-right" id="editAdresseIds"></a>
                  </li>
                </ul>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                    </div>
                    </form>
                  </div>
                  
                 
                   <div class="tab-pane" id="studentOngletDetail">
                   <form class="form-horizontal" id="studentDetail"> 
                     <ul class="list-group list-group-unbordered mb-12">
                   <li class="list-group-item">
                    <b>Date d'enregistrement</b> <a class="float-right" id="editDateStudentIds"></a>
                  </li>
                  
                   <li class="list-group-item">
                    <b>PaymentType</b> <a class="float-right" id="editPaymentTypeStudentIds"></a>
                  </li>
                  <li class="list-group-item">
                    <b>Nom et Prénom</b> <a class="float-right" id="editNameStudentIds"></a>
                  </li>
                  <li class="list-group-item">
                    <b>Téléphone 1</b> <a class="float-right" id="editPhoneStudentIds"></a>
                  </li>
                  <li class="list-group-item">
                    <b>Téléphone 2</b> <a class="float-right" id="editCelStudentIds"></a>
                  </li>
                  <li class="list-group-item">
                    <b>Email</b> <a class="float-right" id="editEmailStudentIds"></a>
                  </li>
                  <li class="list-group-item">
                    <b>Adresse</b> <a class="float-right" id="editAdresseStudentIds"></a>
                  </li>
                </ul>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                    </div>
                    </form>
                  </div>
                    

                  <div class="tab-pane" id="settings">
                    <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputName" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName2" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                        <div class="col-sm-10">	
                          <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
                
            </div>
        </div>
    </div>
</div>
<!-- Fin update product -->

</body>
</html>
