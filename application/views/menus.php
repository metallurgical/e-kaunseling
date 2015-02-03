<div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                <?php 
                if($this->session->userdata('type') == "students"){                     // students
                    ?>  
                        <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>s_forum/view_categories"><i class="fa fa-dashboard fa-fw"></i> Forum</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>appointments/student_appointments"><i class="fa fa-dashboard fa-fw"></i> Appointment</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>chat/manage_session"><i class="fa fa-dashboard fa-fw"></i> Live Chat</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>cam"><i class="fa fa-dashboard fa-fw"></i> Cam</a>
                        </li>
                        
                    </ul>
                    <?php
                }
                else if($this->session->userdata('type') == "counselors"){              // counselors
                ?>
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>                        
                        <li>
                            <a href="<?php echo base_url();?>appointments/counselor_appointments"><i class="fa fa-dashboard fa-fw"></i> Appointment</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>chat/counselor_list_chat"><i class="fa fa-dashboard fa-fw"></i> Live Chat</a>
                        </li>
                        
                    </ul>
                <?php
                }
                else{                                                                   // admin only
                ?>
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>counselors"><i class="fa fa-dashboard fa-fw"></i> Counselor</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>students"><i class="fa fa-dashboard fa-fw"></i> Sudents</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Forums<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url();?>forum/categories">Forum Categories</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url();?>forum/topics">Forum Topics</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url();?>forum/answers">Forum Answer</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        
                        
                        
                        
                    </ul>
                <?php
                }
            ?>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>