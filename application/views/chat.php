
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Bootstrap Admin Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url();?>assets/css/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="<?php echo base_url();?>assets/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url();?>assets/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo base_url();?>assets/css/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url();?>assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!--<link type="text/css" rel="stylesheet" media="all" href="<?php echo base_url();?>assets/css/chat/chat.css" />
    <link type="text/css" rel="stylesheet" media="all" href="<?php echo base_url();?>assets/css/chat/screen.css" />-->
    

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
</head>
<body>

    <div id="wrapper">

        <?php $this->load->view('header_top'); ?>
        <?php $this->load->view('menus.php'); ?>            
<!-- dont disturb here -->





        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"><?php echo $page_header_title;?></h1>
                    </div>
                    <!-- /.col-lg-12 -->                    
                </div>
                <div class="row">
                    <div class="col-lg-6">
                       <style type="text/css">
                       .student_msg{
                            float:left;
                            clear: both;
                            border:1px solid red;
                            width: 350px
                       }
                       .counselor_msg{
                            float: right;
                            clear: both;
                            border:1px solid blue;
                            width: 350px
                       }
                       </style>
                        <div class="panel panel-info" >
                            <div class="panel-heading">
                                Chat With Counselor
                            </div>
                            <div class="panel-body" style='overflow:auto; height:200px;'>
                                <!-- <p class="student_msg">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
                                <p class="counselor_msg">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p> -->
                                
                            </div>
                            <div class="panel-footer">
                                <div>
                                    <textarea cols="50" rows="2" name="msg" id="msg"></textarea> <input type="button" value="Send" name="b_send" id="b_send">
                                </div>
                            </div>
                        </div>
                
                    <script type="text/javascript">
                    $(function(){

                        function retrieve_data(){ 

                            
                        }

                        function send_msg(){}
                    })
                    </script>
                    </div>
                    <!-- /.col-lg-12 -->                    
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->





<!-- dont disturb here -->
    </div>
    <!-- /#wrapper -->
          
    

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url();?>assets/js/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="<?php echo base_url();?>assets/js/raphael-min.js"></script>
    <!--<script src="<?php echo base_url();?>assets/js/morris.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/morris-data.js"></script>-->

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url();?>assets/js/sb-admin-2.js"></script>
   <!-- <script type="text/javascript" src="<?php echo base_url();?>assets/js/chat.js"></script>-->


</body>

</html>
