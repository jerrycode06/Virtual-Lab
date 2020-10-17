<?php

// Initialize the session
session_start();
 include_once('config.php');
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
 if(isset($_SESSION['wentwrong']))
 {
     unset($_SESSION['wentwrong']);
     ?>
     <script>alert("Something went wrong");</script>
     <?php
 }
 $user=$_SESSION["username"];
 $row=mysqli_fetch_array(mysqli_query($link,"select code,id from users where username='$user'"));
 $id=$row['id'];
 $code=$row['code'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Vlab</title>
    <!--
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">


    <link href="css/all.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link href="css/clean-blog.min.css" rel="stylesheet">

<style>
		#loading {
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  position: fixed;
  display: block;
  opacity: 0.7;
  background-color: #fff;
  z-index: 99;
  text-align: center;
}

#loading-image {
  position: absolute;
  top: 100px;
  left: 240px;
  z-index: 100;
}
	</style>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="/">Virtual Lab (<?php echo $_SESSION['type']; ?>)</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="welcome.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                    
                </ul>
            </div>
        </div>
    </nav>
</head>

<body onload="afterload()">
<div id="loading">
 <center> <img id="loading-image" src="Benedict Images/ajax-loading.gif" alt="Loading..." /></center>
</div>
    <main class="cs-page-wrapper" style="background-color:#33334d;padding-top:65px">

        <div class="container-fluid pt pb pt-lg">
            <div class="row align-items-center py">

                <div class="col-xl-6 col-lg-5 d-flex justify-content-end">
                    <div class="page-header">
                        <div class="h3" style="color:white">Hi, <b><?php  echo htmlspecialchars($_SESSION["username"]);  ?></b> <br>
                        Your referal code is <?php echo $code; ?></div>
                    </div>
                </div>
            </div>

            <p>
                <a href="login/reset-password.php" class="btn btn-warning">Reset Your Password</a>
                <a href="login/logout.php" class="btn btn-danger">Logout</a>
            </p>

            <div class="col-xl-6 col-lg-7 ">

                <div class="pt-2 pb-3 pb-lg-0 mx-auto mb-5 mb-lg-0 ml-lg-0 mr-xl-7 text-center text-lg-left" style="max-width: 495px;">
                    <!--h1 class="display-4 text-light pb-2"><span class="font-weight-light">Second Page</span></h1-->
                    <p class="h4 font-weight-light text-light opacity-70 line-height-base">Explore Our Virtual Laboratories</p>
                    <!--             Button Above the main picture
<a class="d-inline-flex align-items-center text-decoration-none pt-2 mt-4 mb-5" href="#demos" data-scroll=""><span class="btn btn-icon rounded-circle border-primary"><i class="fe-arrow-down h4 text-primary my-1"></i></span><span class="ml-3 text-primary font-weight-medium">ADD BUTTON HERE</span></a>-->
                    <hr class="hr-light mb-5">
                    <!--div class="row">
                        <div class="col-sm-4 mb-4 mb-sm-0">
                            <div class="h1 text-light mb-1">Lab A</div>
                            <div class="h5 text-light font-weight-normal opacity-70 mb-2">Demo</div><span class="badge badge-pill badge-success"></span>
                        </div>
                        <div class="col-sm-4 mb-4 mb-sm-0">
                            <div class="h1 text-light mb-1">Lab A</div>
                            <div class="h5 text-light font-weight-normal opacity-70 mb-1">Demo</div>
                        </div>
                        <div class="col-sm-4">
                            <div class="h1 text-light mb-1">Lab A</div>
                            <div class="h5 text-light font-weight-normal opacity-70 mb-1">Demo</div>
                        </div>
                    </div-->
                </div>
            </div>
        </div>

    </main>

    <section class="my-5">
        <div class="py-3">
            <h1 class="text-center">Benedict's test for reducing sugar Laboratory Setup</h1>
        </div>
        <div class="container">
            <div class="row">
                <img onload="afterload()" src="Benedict Images/1.png" alt="image" id="imgmain" style="height:350px;width:1100px" class="img-fluid pb-4">
				
				
            </div>
			
			<div class="row">
			
				<div class="col-md-6 h3" style="background-color:#93aacf;font-family:arial;padding:10px">
					<div id="0">
						
						<!--div  class="form-group">
						<label>What amount of sugar is present in urine sample?</label>
						<select onchange="zero(this.value)" class="form-control">
							
							<option value="a1">No Reducing Sugar</option>
							<option value="a2">Traceable</option>
							<option value="a3">Low</option>
							<option value="a4">Moderate</option>
							<option value="a5">High</option>
						</select>
						
						</div-->
					</div>
					<div id="1" style="display:block">
						<div  class="form-group">
						<label>What you think will be our first step ?</label>
						<select  onchange="first(this.value)" class="form-control">
							<option>Select Answer</option>
							<option value="a1">Take 5ml of benedict's solution into test tube</option>
							<option value="a2">Take 5ml of urine sample into test tube</option>
						</select>
						</div>
					</div>
					<div id="2" style="display:none" >
						<div  class="form-group">
						<label>Next step (2) ?</label>
						<select  onchange="second(this.value)" class="form-control">
							<option>Select Answer</option>
							<option value="a1">Take 5ml more benedict's solution into test tube</option>
							<option value="a2">Take 5ml of urine sample into test tube</option>
						</select>
						</div>
					</div>
					<div id="3" style="display:none" >
						<div  class="form-group">
						<label>Next step(3) ?</label>
						<textarea cols="6" rows="3" id="txt1" placeholder="what will we do now?" class="form-control"> </textarea>
						</div>
						<span onclick="third()" class="btn btn-primary">Submit</span>
					</div>
					<div id="4" style="display:none" >
						<div  class="form-group">
						<label>Next step(4) ?</label>
						<textarea cols="6" rows="3" id="txt2" placeholder="what will we do now?" class="form-control"> </textarea>
						</div>
						<span onclick="fourth()" class="btn btn-primary">Submit</span>
					</div>
					<div id="5" style="display:none" >
						<div  class="form-group">
						<label>Next step(5) ?</label>
						<textarea cols="6" rows="3" id="txt3" placeholder="what will we do now?" class="form-control"> </textarea>
						</div>
						<span onclick="fifth()" class="btn btn-primary">Submit</span>
					</div>
					<div id="6" style="display:none" >
						<button id="btnShowPopup2">Click for More about color of solution</button>
						<form style="margin-top:7px" action="result.php" method="post" onsubmit="return vald()">
						    <div id="popres">
						    </div>
						    <button name="resbut" class="btn btn-success">Click here to Complete Experiment</button>
						</form>
					</div>
					
				</div>
				<!-- Model Starts -->
					<div id="MyPopup" class="modal fade" role="dialog">
						<div class="modal-dialog">
						<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">
									&times;</button>
									<h4 class="modal-title">
									</h4>
								</div>
								<div class="modal-body">
								</div>
								<div class="modal-footer">
								<button type="button" class="btn btn-danger" data-dismiss="modal">
								Close</button>
								</div>
							</div>
						</div>
					</div>
				<!-- Model Ends -->
				<!-- Model Starts -->
					<div id="MyPopup2" class="modal fade" role="dialog">
						<div class="modal-dialog">
						<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">
									&times;</button>
									<h4 class="modal-title">
									</h4>
								</div>
								<div class="modal-body">
								</div>
								<div class="modal-footer">
								<button type="button" class="btn btn-danger" data-dismiss="modal">
								Close</button>
								</div>
							</div>
						</div>
					</div>
				<!-- Model Ends -->
					
				<div class="col-md-6 h3" id="hint1"  style="font-family:arial;padding:10px;">
					<button id="btnShowPopup" class="btn btn-primary">Click to know about Benedict's solution</button>
				</div>
				<div class="col-md-6 h3" id="hint2"  style="font-family:arial;padding:10px;display:none">
					See above we have taken 5ml of Benedict's solution in test tube
				</div>
				<div class="col-md-6 h3" id="hint3"  style="font-family:arial;padding:10px;display:none">
					See above we have taken 5ml of urine sample in the same test tube
				</div>
				<div class="col-md-6 h3" id="hint4"  style="font-family:arial;padding:10px;display:none">
					See above we have  lit flame
				</div>
				<div class="col-md-6 h3" id="hint5"  style="font-family:arial;padding:10px;display:none">
					See above placed test tube over flame
				</div>
				<div class="col-md-6 h3" id="hint6"  style="font-family:arial;padding:10px;display:none">
					See the color of solution in test tube has changed to green which means urine sample has Traceable amount of sugar
				</div>
			
			</div>
			
        </div>
        <div class="container">
            <div style="margin-top:30px"class="row">
                <!--div class="col-md-3">
                    <iframe width="300" height="230" src="https://www.youtube.com/embed/PAKCgrnKeBA" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div-->
                <?php
                if($_SESSION['type']=='Teacher')
                {
                $res=mysqli_query($link,"select * from lab_res where sid in (select id from users where code ='$code' and id!=$id)");
                ?>
                <div class="h3">Your Student's Results are:<br></div>
                <div class="col-md-12">
                    <div class="table-responsive">
				        <table class="table table-hover">
					        <thead>
						    <th>Name</th>
						    <th>Username</th>
						    <th>Step 1</th>
						    <th>Step 2</th>
						    <th>Step 3</th> 
						    <th>Step 4</th>
						    <th>Step 5</th> 
					        </thead>
					        <tbody>
					            <?php
					            $num=mysqli_num_rows($res);
					            for($i=0;$i<$num;$i++)
					            {
					               $r1= mysqli_fetch_array($res);
					               $id=$r1['sid'];
					              $r2= mysqli_fetch_array(mysqli_query($link,"select name,username from users where id=$id"));
					                ?>
					                <tr>
					                    <td><?php echo $r2['name']; ?></td>
					                    <td><?php echo $r2['username']; ?></td>
					                    <td><?php echo $r1['step_1']; ?></td>
					                    <td><?php echo $r1['step_2']; ?></td>
					                    <td><?php echo $r1['step_3']; ?></td>
					                    <td><?php echo $r1['step_4']; ?></td>
					                    <td><?php echo $r1['step_5']; ?></td>
					               </tr>     
					                <?php
					            }
					            mysqli_close($link);
					            ?>
					       </tbody> 
					   </table>
					</div>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </section>
    <?php
    include "footer.php";
    ?>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootsrap.bundle.min.js"></script>
    <script src="js/smooth-scroll.polyfills.min.js"></script>
    <script src="js/parallax.min.js"></script>
    <!--Main Theme Script-->
    <script src="js/theme.min.js"></script>
    <script src="js/clean-blog.min.js"></script>
	<script>
	f1=0;
	f2=0;
	res=[];
	function vald()
	{
	    ht="<input type='hidden' name='s1' value="+res[0]+"><input type='hidden' name='s2' value="+res[1]+"><input type='hidden' name='s3' value="+res[2]+"><input type='hidden' name='s4' value="+res[3]+"><input type='hidden' name='s5' value="+res[4]+">";
	    document.getElementById("popres").innerHTML=ht;
	    return true;
	}
	function afterload()
		{
			document.getElementById("loading").setAttribute("style","display:none");
		}
		function zero(val)
		{
			this.sample=val;
			alert(sample);
			d1=document.getElementById("1");
			d0=document.getElementById("0");
			d1.setAttribute("style","display:block");
			d0.setAttribute("style","display:none");
		}
		function first(val)
		{
			img=document.getElementById("imgmain");
			d1=document.getElementById("1");
			d2=document.getElementById("2");
			h2=document.getElementById("hint2");
			h1=document.getElementById("hint1");
			if(val=="a1")
			{
				alert("Correct Answer to start with we take 5ml of benedict's solution in test tube");
				if(f1==0)
				{
				res[0]="right";
				f1=1;
				}
				img.setAttribute("src","Benedict Images/2.png");
				document.getElementById("loading").setAttribute("style","display:block");
				d1.setAttribute("style","display:none");
				d2.setAttribute("style","display:block");
				h2.setAttribute("style","font-family:arial;padding:10px;display:block");
				h1.setAttribute("style","font-family:arial;padding:10px;display:none");
			}
			else
			{
			    if(f1==0)
			    {
			    res[0]="wrong";
			    f1=1;
			    }
				alert("Wrong Answer to start with we take 5ml of benedict's solution in test tube, Choose correct again");
			}
		}
		function second(val)
		{
			img=document.getElementById("imgmain");
			d2=document.getElementById("2");
			d3=document.getElementById("3");
			h2=document.getElementById("hint2");
			h3=document.getElementById("hint3");
			if(val=="a2")
			{
				alert("Correct Answer now we have to take 5ml of urine sample in test tube");
				if(f2==0)
				{
				res[1]="right";
				f2=1;
				}
				img.setAttribute("src","Benedict Images/5.png");
				document.getElementById("loading").setAttribute("style","display:block");
				d2.setAttribute("style","display:none");
				d3.setAttribute("style","display:block");
				h2.setAttribute("style","font-family:arial;padding:10px;display:none");
				h3.setAttribute("style","font-family:arial;padding:10px;display:block");
			}
			else
			{
			    if(f2==0)
			    {
			    res[1]="wrong";
			    f2=1;
			    }
				alert("Wrong Answer now we have to take 5ml of urine sample in test tube, Choose correct again");
			}
		}
		function third()
		{
			img=document.getElementById("imgmain");
			d4=document.getElementById("4");
			d3=document.getElementById("3");
			h4=document.getElementById("hint4");
			h3=document.getElementById("hint3");
			res[2]=document.getElementById("txt1").value;
				alert("Now we will lit flame");
				img.setAttribute("src","Benedict Images/6.png");
				document.getElementById("loading").setAttribute("style","display:block");
				d3.setAttribute("style","display:none");
				d4.setAttribute("style","display:block");
				h4.setAttribute("style","font-family:arial;padding:10px;display:block");
				h3.setAttribute("style","font-family:arial;padding:10px;display:none");
			
			
		}
		function fourth()
		{
			img=document.getElementById("imgmain");
			d4=document.getElementById("4");
			d5=document.getElementById("5");
			h4=document.getElementById("hint4");
			h5=document.getElementById("hint5");
			res[3]=document.getElementById("txt2").value;
				alert("Now we will place the test tube over flame");
				img.setAttribute("src","Benedict Images/7.png");
				document.getElementById("loading").setAttribute("style","display:block");
				d5.setAttribute("style","display:block");
				d4.setAttribute("style","display:none");
				h4.setAttribute("style","font-family:arial;padding:10px;display:none");
				h5.setAttribute("style","font-family:arial;padding:10px;display:block");
			
			
		}
		function fifth()
		{
			img=document.getElementById("imgmain");
			d6=document.getElementById("6");
			d5=document.getElementById("5");
			h6=document.getElementById("hint6");
			h5=document.getElementById("hint5");
			res[4]=document.getElementById("txt3").value;
				alert("Now color of solution in test tube will be changed depeding upon the concentration of sugar in urine sample");
				img.setAttribute("src","Benedict Images/8.png");
				document.getElementById("loading").setAttribute("style","display:block");
				d5.setAttribute("style","display:none");
				d6.setAttribute("style","display:block");
				h5.setAttribute("style","font-family:arial;padding:10px;display:none");
				h6.setAttribute("style","font-family:arial;padding:10px;display:block");
		}
	</script>
	<script type="text/javascript">
    $(function () {
        $("#btnShowPopup").click(function () {
           
            var body = "<img src='Benedict Images/ben.jpg' class='img-fluid pb-4'>";
 
            
            $("#MyPopup .modal-body").html(body);
            $("#MyPopup").modal("show");
        });
    });
	$(function () {
        $("#btnShowPopup2").click(function () {
           
            var body = "<img src='Benedict Images/more.jpg' class='img-fluid pb-4'>";
 
            
            $("#MyPopup2 .modal-body").html(body);
            $("#MyPopup2").modal("show");
        });
    });
    /*"<div style='margin-bottom:10px;margin-top:10px;width:100%;background-color:#6481b0;border-radius:8px;color:white;font-weight:bold;font-family:'Comic Sans MS', cursive, sans-serif' class='h2'>Shoaib Nusrat (nusratshoaibansarit@gmail.com)<br/>Maryam (maryam.aps2@gmail.com)<br/> Mohib Raza <br/> Noor Fatima<br/><div class='h2'>Under the supervision of Dr. Swaleha Zubair</div>
            </div>";*/
     	$(function () {
        $("#dev").click(function () {
           
            var body ="<div style='margin-bottom:10px;margin-top:10px;width:100%;font-family:'Comic Sans MS', cursive, sans-serif'>Under the supervision of Dr. Swaleha Zubair<br/>Shoaib Nusrat (nusratshoaibansarit@gmail.com)<br/>Maryam (maryam.aps2@gmail.com)<br/> Mohib Raza <br/> Noor Fatima<br/></div>";
 
            
            $("#devmodal .modal-body").html(body);
            $("#devmodal").modal("show");
        });
    });
</script>
</body>

</html>
