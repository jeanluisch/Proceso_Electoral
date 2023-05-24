
  <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;" >
              <a href="index.php" class="site_title"><img src="favicon-96x96.png" width="25"> <span style="color: #98a60d;">Esperanzador 2.0</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="images/usuario.png" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Bienvenido</span>
                <h2> <?php  echo $_SESSION['nombre_usuario'] ?> </h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="index.php"><i class="fa fa-home"></i> Inicio </a>

                  </li>
                  <li><a><i class="fa fa-university"></i> Estructura Electoral <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="centro_votacion.php">Centro de Votación</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-calendar"></i> 1x12 <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="elector.php">Electores</a></li>
                      <li><a href="responsables.php">Responsables 1x12</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-bar-chart-o"></i> Reportes <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                    </ul>
                  </li>
                  <li><a><i class="fa fa-user"></i>Usuario <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                       <li><a href="usuario.php">Usuario</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->

            
            
            <!-- /menu navegacion -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="images/usuario.png" alt=""><?php  echo $_SESSION['usuario'] ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    
                    <li><a href="../controlador/iniciar_sesion.php?session=destroy"><i class="fa fa-sign-out pull-right"></i> Cerrar Sesión</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top Navegacion -->


