<?php
session_start();
  if(isset($_SESSION['user'])){
	   	$role=$_SESSION['role'];
	   	$user=$_SESSION['user'];
	   	$shop=$_SESSION['shop'];
  }
  else{
	   header("Location:../index.php");
	   echo "<script>location='../index.php'</script>";
	 
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Duties &amp; Taxes</title>
        
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" />
        <link href="../bootstrap/font-awesome-4.6.3/css/font-awesome.min.css" rel="stylesheet" />
        <link href="../bootstrap/css/bootstrap.css" rel="stylesheet" media="screen" />
  		<style>
			
        </style>
		<script src="../bootstrap/js/jquery.js" type="text/javascript"></script>
        
	</head>

    <body>
    <?php include "../header.php";?>
   		<div class="container">
     		<div class="row">
            	<?php
                	if(isset($_SESSION['msg'])){echo "<h4 class='text-success text-center'>".$_SESSION['msg']."</h4>"; unset($_SESSION['msg']);}
                	if(isset($_SESSION['err'])){echo "<h4 class='text-danger text-center'>".$_SESSION['err']."</h4>"; unset($_SESSION['err']);}
				?>
                <div class="col-md-2" style="margin-top:50px;">
                	<?php include('sidebar.php'); ?>
                </div><!-- end of col-md-3 -->
                <div class="col-md-10">
                	<center><font size="+2">Duties &amp; Taxes</font></center><hr />
                    <div class="row">
                        <div class="col-md-1"></div>
                    	<div class="col-md-3"><input type="date" id="from" class="form-control" value="<?php if(isset($_GET['from'])){echo $_GET['from'];} ?>" /></div>
                    	<div class="col-md-3"><input type="date" id="to" class="form-control" value="<?php if(isset($_GET['to'])){echo $_GET['to'];} ?>" /></div>
                    	<div class="col-md-2"><button type="button" class="btn btn-success" onclick="getDates()">Search <i class="fa fa-search"></i></button></div>
                    </div><br />
                    <div class="row">
                        <div id="query_result" class="table-responsive col-md-12">
                            <?php include "taxlist.php" ;?>	  
                        </div>
                    </div>
                </div>
            </div><!-- end of row -->
        </div><!-- end of container -->
        <script language="javascript">
        	
			function getDates(){
				var from=$('#from').val();
				var to=$('#to').val();
				var shop='<?php echo $shop; ?>';
				if(from=='' || to==''){
					alert("Select Date Range!");	
				}
				else{
					var xhttp = new XMLHttpRequest();
					xhttp.onreadystatechange = function() {
						if (xhttp.readyState == 4 && xhttp.status == 200) {
							document.getElementById("query_result").innerHTML = xhttp.responseText;
						}
					};
					xhttp.open("GET", "taxlist.php?from="+from+"&to="+to+"&shop="+shop, true);
					xhttp.send();	
				}
			}
			
        </script>
        
  		<script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>            
    </body>
</html>
