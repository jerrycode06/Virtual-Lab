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
	
	
    <link href="css/all.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
	
    <!-- Custom styles for this template -->
    <link href="css/clean-blog.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/welcome.css">

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
</head>
<body onload="afterload()">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="mainNav">
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
                    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Urine Test
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="welcome.php">Benedict's Test</a>
          <a class="dropdown-item" href="protein.php">Test for proteins</a>
          <a class="dropdown-item" href="ketone.php">Test for Ketones</a>
          <a class="dropdown-item" href="bile.php">Test for Bile Salts</a>
        </div>
	  </li>
	  <li class="nav-item">
          <a class="nav-link" href="about.php">Hematology</a>
      </li>
                </ul>
            </div>
        </div>
    </nav>
<div id="loading">
 <center> <img id="loading-image" src="Benedict Images/ajax-loading.gif" alt="Loading..." /></center>
</div>
	<section id="home">
	<h3 style="color: #fff;">Hi, <b><?php  echo htmlspecialchars($_SESSION["username"]);  ?></b> <br>
                        Your referal code is <?php echo $code; ?></h3>
	<h1>Welcome to Virtual Lab</h1>			
      <a href="login/reset-password.php" class="btn btn-warning" style="margin-top:60px; margin-bottom: 10px;border-radius: 10px;">Reset Your Password</a>
				<a href="login/logout.php" class="btn btn-danger" style=" border-radius: 10px;">Logout</a>
    </section>

    <section class="test">
        <div class="py-3">
            <h1 class="text-center">Benedict's test for reducing sugars</h1>
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
							<option value="a1">Take 5ml of benedict's solution into test tube.</option>
							<option value="a2">Take 5ml of urine sample into test tube.</option>
						</select>
						</div>
					</div>
					<div id="2" style="display:none" >
						<div  class="form-group">
						<label>Next step (2) ?</label>
						<select  onchange="second(this.value)" class="form-control">
							<option>Select Answer</option>
							<option value="a1">Add Urine Sample.</option>
							<option value="a2">Benedicts reagent is first heated to see for prior colour change which indicates contamination or substandard reagent and then Add Urine Sample.</option>
						</select>
						</div>
					</div>
					<div id="3" style="display:none" >
						<div  class="form-group">
						<label>Next step(3) ?</label>
						<select  onchange="third(this.value)" class="form-control">
							<option>Select Answer</option>
							<option value="a1">Add 5ml of urine to benedict’s reagent.</option>
							<option value="a2">Add 8drops of urine to  benedicts’ reagent.</option>
						</select>
						</div>
					</div>
					<div id="4" style="display:none" >
						<div  class="form-group">
						<label>Next step(4) ?</label>
						<select  onchange="fourth(this.value)" class="form-control">
							<option>Select Answer</option>
							<option value="a1">Heat the solution.</option>
							<option value="a2">Wait for colour change without heating.</option>
						</select>
						</div>
					</div>
					<div id="5" style="display:none" >
						<button data-toggle="modal" data-target="#modal2" class="btn btn-primary">Click for More about color of solution</button>
						<form style="margin-top:7px" action="result.php" method="post" onsubmit="return vald()">
						    <div id="popres">
						    </div>
						    <button name="resbut" class="btn btn-success">Click here to Complete Experiment</button>
						</form>
					</div>
					
				</div>
				<!-- Model Starts -->
				<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  					<div class="modal-dialog modal-dialog-scrollable">
    					<div class="modal-content">
      						<div class="modal-header">
        						<h5 class="modal-title" id="staticBackdropLabel">About Benedict's Test</h5>
        						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          							<span aria-hidden="true">&times;</span>
        						</button>
      						</div>
      						<div class="modal-body">
						 			<p>The Benedict’s test is a qualitative and semi-quantitative method to test for the presence of reducing sugars in a random urine sample or other solution. It detects and partly quantifies the amount present according to the degree of colour change.</p>
						 			<p><strong>Principle -</strong></p>
						 			<p>It is based on the principle that on heating in presence of an alkali (sodium carbonate), reducing sugars are converted to enediols which are strong reducing agents. These then convert the cupric ions in copper sulphate to cuprous ions . An insoluble reddish precipitate of cuprous oxide Is formed and the degree of colour of the precipitate/solution is dependent on the amount of reducing sugar in the analyte.The sodium citrate in the reagent acts as a complexing agent which keeps the copper ions in solution.
										Benedicts solution contains anhydrous sodium carbonate, sodium citrate and copper (2) sulphate pentahydrate.</p>
      						</div>
      						<div class="modal-footer">
        						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      						</div>
    					</div>
 					 </div>
				</div>
				<!-- Model Ends -->
				<!-- Model Starts -->
				<div class="modal fade " id="modal2" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  					<div class="modal-dialog modal-dialog-scrollable">
    					<div class="modal-content">
      						<div class="modal-header">
        						<h5 class="modal-title" id="staticBackdropLabel">About Benedict's Test Solution</h5>
        						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          							<span aria-hidden="true">&times;</span>
        						</button>
      						</div>
      						<div class="modal-body">
							  <p><strong>The Color change and the corresponding quantities of reducing sugar -</strong></p>
						 			<ul>
						  				<li>Blue - Negative </li>
						 			 	<li>Green - 0.5 to 1gm </li>
						  				<li>Green/yellow - 1 to 1.5gm%</li>
						  				<li>Orange - 1.5 to 2 gm% </li>
						  				<li>Brick red - more than 2gm%</li>
						 			</ul>
									<img src = "Benedict Images/ben2.jpg"/>
      						</div>
      						<div class="modal-footer">
        						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      						</div>
    					</div>
 					 </div>
				</div>
				<!-- Model Ends -->
					
				<div class="col-md-6 h3" id="hint1"  style="font-family:arial;padding:10px;">
					<button data-toggle="modal" data-target="#staticBackdrop" class="btn btn-primary">Click to know about Benedict's solution</button>
				</div>
				<div class="col-md-6 h3" id="hint2"  style="font-family:arial;padding:10px;display:none">
					See above we have taken 5ml of Benedict's solution in test tube
				</div>
				<div class="col-md-6 h3" id="hint3"  style="font-family:arial;padding:10px;display:none">
					See above we are going to heat Benedict's solution to see for prior colour change which indicates contamination or substandard reagent
				</div>
				<div class="col-md-6 h3" id="hint4"  style="font-family:arial;padding:10px;display:none">
					See above we have taken 8 drops amount of urine sample in the same test tube
				</div>
				<div class="col-md-6 h3" id="hint5"  style="font-family:arial;padding:10px;display:none">
					See above the tube is carefully heated over the flame
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
				alert("Correct Answer now We should take Benedicts reagent first - heated to see for prior colour change which indicates contamination or substandard reagent and then Add Urine Sample.");
				if(f2==0)
				{
				res[1]="right";
				f2=1;
				}
				img.setAttribute("src","Benedict Images/6.png");
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
				alert("Wrong Answer now We should take Benedicts reagent first - heated to see for prior colour change which indicates contamination or substandard reagent and then Add Urine Sample, Choose correct again");
			}
		}
		function third(val)
		{
			img=document.getElementById("imgmain");
			d4=document.getElementById("4");
			d3=document.getElementById("3");
			h4=document.getElementById("hint4");
			h3=document.getElementById("hint3");
			if(val=="a2")
			{
				alert("Correct Answer now we should Add 8drops of urine to Benedicts’ reagent.");
				if(f2==0)
				{
				res[1]="right";
				f2=1;
				}
				img.setAttribute("src","Benedict Images/5.png");
				document.getElementById("loading").setAttribute("style","display:block");
				d3.setAttribute("style","display:none");
				d4.setAttribute("style","display:block");
				h3.setAttribute("style","font-family:arial;padding:10px;display:none");
				h4.setAttribute("style","font-family:arial;padding:10px;display:block");
			}
			else
			{
			    if(f2==0)
			    {
			    res[1]="wrong";
			    f2=1;
			    }
				alert("Wrong Answer to Add 5ml of urine to benedict’s reagent, Choose correct again");
			}
			
			
		}
		function fourth(val)
		{
			img=document.getElementById("imgmain");
			d4=document.getElementById("4");
			d5=document.getElementById("5");
			h4=document.getElementById("hint4");
			h5=document.getElementById("hint5");
			if(val=="a1")
			{
				alert("Correct Answer now we should Heat the solution.");
				if(f2==0)
				{
				res[1]="right";
				f2=1;
				}
				img.setAttribute("src","Benedict Images/7.png");
				document.getElementById("loading").setAttribute("style","display:block");
				d4.setAttribute("style","display:none");
				d5.setAttribute("style","display:block");
				h4.setAttribute("style","font-family:arial;padding:10px;display:none");
				h5.setAttribute("style","font-family:arial;padding:10px;display:block");
			}
			else
			{
			    if(f2==0)
			    {
			    res[1]="wrong";
			    f2=1;
			    }
				alert("Wrong Answer 'Wait for colour change without heating', Choose correct again");
			}			
		}
	</script>
</body>

</html>
