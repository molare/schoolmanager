<script type="text/javascript">
            $(document).ready(function(){
                var CURRENT_URL = window.location.href.split('#')[0].split('?')[0];
                $SIDEBAR_MENU = $('.main-sidebar');
                // check active menu
                $SIDEBAR_MENU.find('a[href="'+CURRENT_URL+ '"]').addClass('active');
                       

            });
</script>

<style>
  .spinner {
  width: 35px;
  height: 35px;
  background-color: #333;

  margin: 2px auto;
  -webkit-animation: sk-rotateplane 1.2s infinite ease-in-out;
  animation: sk-rotateplane 1.2s infinite ease-in-out;
}

@-webkit-keyframes sk-rotateplane {
  0% { -webkit-transform: perspective(120px) }
  50% { -webkit-transform: perspective(120px) rotateY(180deg) }
  100% { -webkit-transform: perspective(120px) rotateY(180deg)  rotateX(180deg) }
}

@keyframes sk-rotateplane {
  0% { 
    transform: perspective(120px) rotateX(0deg) rotateY(0deg);
    -webkit-transform: perspective(120px) rotateX(0deg) rotateY(0deg) 
  } 50% { 
    transform: perspective(120px) rotateX(-180.1deg) rotateY(0deg);
    -webkit-transform: perspective(120px) rotateX(-180.1deg) rotateY(0deg) 
  } 100% { 
    transform: perspective(120px) rotateX(-180deg) rotateY(-179.9deg);
    -webkit-transform: perspective(120px) rotateX(-180deg) rotateY(-179.9deg);
  }
}
</style>
        <aside class="main-sidebar elevation-4 sidebar-dark-white">
            <!-- Brand Logo -->
            <a class="brand-link navbar-white">
                <img src="dist/img/favicon.ico" alt="AdminLTE Logo" class="brand-image-xl elevation-4 spinner"
                     style="opacity: .8">
                <span class="brand-text font-weight">GESSCO</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                    </div>
                </div>
             <div> 
           <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">{{ Auth::user()->username }}</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <!-- Level two dropdown-->
              <li class="dropdown-item dropdown-hover">
                  <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                     Deconnecter
                 </a>

                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                     @csrf
                 </form>
                </li>
          </div>       
                
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview">
                    <a href="{{route('home')}}"  class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Tableau de bord
                        </p>
                    </a>

                </li>

                <li class="nav-header">PARAMETRAGE</li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-university"></i>
                        <p>
                            Institut
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a   class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Type Ecole
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a  class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Ecole
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                
                  <li class="nav-item">
                    <a  href="{{route('gender')}}" class="nav-link">
                        <i class="fa fa-venus-mars nav-icon"></i>
                        <p>
                            Genre (M/F)
                        </p>
                    </a>
                </li>



                <li class="nav-item">
                    <a  href="{{route('schoolyear')}}" class="nav-link">
                        <i class="fa fa-calendar nav-icon"></i>
                        <p>
                            Année Scolaire
                        </p>
                    </a>
                </li>
                
               
                <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                        <i class="nav-icon  fas fa-user"></i>
                        <p>
                            CORPS PROFESSORAL
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                          <a href="{{route('category')}}"  class="nav-link">
                           <i class="far fa-circle nav-icon"></i>
                            <p>
                                Liste Categorie
                            </p>
                        </a>
                        </li>

                        <li class="nav-item">
                          <a href="{{route('teacher')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>
                                Liste Professeur
                            </p>
                        </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-header">CLASSES
                </li>
                <li class="nav-item">
                    <a href="{{route('classRoom')}}"  class="nav-link">
                        <i class="nav-icon far fa fa-list"></i>
                        <p>
                            Liste Classe
                        </p>
                    </a>
                </li>
                
                <li class="nav-header">MATIERES
                </li>
                <li class="nav-item">
                    <a href="{{route('course')}}"  class="nav-link">
                        <i class="nav-icon far fa fa-spinner fa-spin fa-3x fa-fw"></i>
                        <p>
                            Liste Matière
                        </p>
                    </a>
                </li>
                
                
               <li class="nav-header">SEANCES
                </li>
                <li class="nav-item">
                    <a href="{{route('sitting')}}" class="nav-link">
                        <i class="nav-icon fa fa-folder-open"></i>
                        <p>
                            Liste Seance
                        </p>
                    </a>
                </li>
             

                <li class="nav-header">PARENTS
                </li>
                <li class="nav-item">
                    <a  href="{{route('parent')}}"   class="nav-link">
                        <i class="nav-icon far fa fa-user"></i>
                        <p>
                            Liste parent
                        </p>
                    </a>
                </li>


                <li class="nav-header">ETUDIANTS
                </li>
                <li class="nav-item">
                    <a href="{{route('student')}}" class="nav-link">
                        <i class="nav-icon far fa fa-users"></i>
                        <p>
                            Liste Etudiant
                        </p>
                    </a>
                </li>
                
                
                <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                        <i class="nav-icon  fa fa-cubes"></i>
                        <p>
                            SCOLARITES
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                          <a href="{{route('paymentType')}}"  class="nav-link">
                           <i class="far fa-circle nav-icon"></i>
                            <p>
                                Type 
                            </p>
                        </a>
                        </li>

                        <li class="nav-item">
                          <a href="{{route('payment')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>
                                Scolarité
                            </p>
                        </a>
                        </li>
                    </ul>
                </li>

                
              <li class="nav-header">
                </li>
                <li class="nav-item">
                    <a href="#">
                        <p>
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
        </div>
        <!-- /.sidebar -->
    </aside>