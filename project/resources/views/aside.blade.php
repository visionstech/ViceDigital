
<div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="{{ url('/dashboard/dashboard') }}" class="site_title"></i> <span>VICE Media LLC</span></a>
            </div>
            <div class="clearfix"></div> <br />
            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
                  <li><a href="{{ url('/dashboard/dashboard') }}"><i class="fa fa-home"></i>Dashboard</a></li>
                  <li><a href="{{ url('/dashboard/configuration') }}"><i class="fa fa-cog"></i> Configuration</a></li>
                  <?php  
                    $class='';
                      /*if(strpos($_SERVER['REQUEST_URI'],"publisher") != false){
                      echo "sdfsdfsd";
                      }*/
                  ?>
                  <li class="{{ (strpos($_SERVER['REQUEST_URI'],'publisher') != false)?'current-page':'' }}"><a href="{{ url('/publisher/publishers') }}"><i class="fa fa-newspaper-o"></i> Publishers</a></li>
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->
          </div>
        </div>
