 <nav class="main-header navbar navbar-expand navbar-dark navbar-orange">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
             <a class="nav-link" data-toggle="dropdown" href="#">
              <i class=""></i>
              <span class="badge badge-success navbar-badge"><h5 id="yearActiveId"></h5></span>
            </a>
             </li>
          </ul>
        </nav>

 <script>
      $(document).ready(function(){
            //$('#loadingId').hide();
            getSchoolYearActiveOption();
        });
  function getSchoolYearActiveOption(){
            $.ajax({
                url:"/getSchoolYearActive",
                type:'GET',
                dataType :"json",
                success:function(response){
                    console.log(response);
                    $("#yearActiveId").html(response.data[0].name);
                },
                error: function(jqXHR, textStatus, errorThrown){
                       console.log(jqXHR);
                 }
            });
        }

    </script>