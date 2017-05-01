        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="SearchEditUser.php">University Student Information App</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
               

                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        
                        <li><a href = "logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <ul class="nav" id="side-menu">
                        
							<li>
								<a href="#"><i class="fa fa-table fa-fw"></i>User Management<span class="fa arrow"></a>
								<ul class="nav nav-second-level">
									<li>
										<a href="CreateUser.php">Create User</a>
									</li>
									
									<li>
										<a href="SearchEditUser.php">Search/Edit User</a>
								</ul>
							</li>

							<li>
								<a href="#"><i class="fa fa-wrench fa-fw"></i>Event Management<span class="fa arrow"></a>
								<ul class="nav nav-second-level">
									<li>
										<a href="CreateEvent.php">Create Event</a>
									</li>
									<li>
										<a href="SearchEditEvent.php">Search/Edit Event</a>
									</li>
								</ul>
							</li>
							<li>
								
								<a href="#"><i class="fa fa-sitemap fa-fw"></i>Programe Management<span class="fa arrow"></a>
								<ul class="nav nav-second-level">
										<li><a href="CreatePrograme.php">Create Programe</a></li>
										<li><a href="SearchEditPrograme.php">Search/Edit Programe</a></li>
								</ul>
							</li>
							<li>
								<a href="#"><i class="fa fa-files-o fa-fw"></i>Course Management<span class="fa arrow"></a>
								<ul class="nav nav-second-level">
										<li><a href="CreateCourse.php">Create Course</a></li>
										<li><a href="SearchEditCourse.php">Search/Edit Course</a></li>
								</ul>
								<!-- /.nav-second-level -->
								<!-- /.nav-second-level -->
							</li>
                        
                        
                        </ul>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>