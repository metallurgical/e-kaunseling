
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
                       .all_user{
                         border-radius: 5px;
                         -webkit-border-radius:5px;
                         -o-border-radius:5px;
                         

                       }
                       .student_msg{
                            float:left;
                            clear: both;
                            width: 350px;
                            padding: 5px;
                            box-shadow: 0px 0px 3px #565656;
                            background: #fff;
                       }
                       .counselor_msg{
                            float: right;
                            clear: both;
                            width: 350px;
                            padding: 5px;
                            text-align: right;
                            box-shadow: 0px 0px 3px #565656;
                            background: #DCF8C6;
                       }
                       </style>
                        <div class="panel panel-primary" >
                            <div class="panel-heading">
                                Chat With <?php  
                                if($this->session->userdata('type') == "students"){
                                    echo "Counselor";
                                }
                                else{
                                    echo "Student";
                                }?>
                            </div>
                            <div class="panel-body msg_container" style='overflow:auto; height:200px;background:#E5DDDA'>
                                <!-- <p class="student_msg">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
                                <p class="counselor_msg">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p> -->
                                
                            </div>
                            <div class="panel-footer">
                                <div>
                                    <input type="hidden" value="<?php echo $this->session->userdata('type');;?>" id="user_type">
                                    <input type="hidden" value="<?php echo $chat_parent_id;?>" id="chat_parent_id">
                                    <input type="hidden" value="<?php echo $student_id;?>" id="student_id">
                                    <div class="row">
                                        <div class="col-sm-10">
                                            <textarea name="msg" id="msg" class="form-control"></textarea> 
                                        </div>
                                            <input type="button" value="Send" name="b_send" id="b_send" class="btn btn-primary btn-small" >
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                
                    <script type="text/javascript">
                    $(function(){
//style="position:relative;margin-left:5px;margin-top:-40px"
                        var msg_container = $('.msg_container')
                            user_type = $('#user_type'),
                            chat_parent_id = $('#chat_parent_id'),
                            student_id = $('#student_id');

                        retrieve_data();

                        $('#b_send').on('click', function(e){
                            e.preventDefault();
                            //alert(chat_parent_id);
                            var msg = $('#msg').val();
                                send_msg(msg, chat_parent_id.val(), student_id.val());
                        })
                        
                        function retrieve_data(){ 

                            $.ajax({
                                type : 'POST',
                                url : '<?php echo base_url();?>chat/retrieve_data',
                                data : 'chat_parent_id='+chat_parent_id.val(),
                                dataType : 'json',
                                success : function(data){
                                    var bil = data.length,
                                        msg = '';


                                    for (var i = 0; i < bil; i++) {
                                        
                                        if(data[i].chat_from != 0){
                                            msg += "<p class='student_msg all_user'>"+data[i].chat_message+"</p>";
                                        }else{
                                            msg += "<p class='counselor_msg all_user'>"+data[i].chat_message+"</p>";
                                        }
                                        
                                    };
                                   
                                    msg_container.html(msg);
                                    scroll_to_bottom();
                                }
                            });

                        }

                        function send_msg(msg, chat_parent_id, student_id){

                            $.ajax({
                                type : 'POST',
                                url : '<?php echo base_url();?>chat/send_data',
                                data : 'msg='+msg+"&chat_parent_id="+chat_parent_id+"&student_id="+student_id,
                                success : function(data){
                                   if(user_type.val() == "students"){
                                        msg_container.append("<p class='student_msg all_user'>"+msg+"</p>");
                                   }else{
                                        msg_container.append("<p class='counselor_msg all_user'>"+msg+"</p>");
                                   }
                                  $('#msg').val('');
                                  scroll_to_bottom();
                                }
                            });
                        }

                        
                        function scroll_to_bottom(){
                            msg_container.animate({ scrollTop: msg_container.prop("scrollHeight") - msg_container.height() }, 'slow');
                        }

/* $('#load_tweets').load('<?php echo base_url();?>chat/retrieve_data').fadeIn("slow");
                            }, 10000);*/
                     //$(document).ready(
                                //function() {
                                    setInterval(function() {retrieve_data() }, 3000);
                               // });


                                        });
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
