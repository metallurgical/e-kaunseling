
<?php $this->load->view('header'); ?>
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
                        <h1 class="page-header"><?php echo $data['page_header_title'];?></h1>
                    </div>
                    <!-- /.col-lg-12 -->                    
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div>
                    		<?php echo $output; ?>
                    	</div>
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
       <?php $this->load->view('footer.php'); ?>


</body>

</html>
