<?php
// Initialize the session
session_start();
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: welcome.php");
    exit;
}
/* if(isset($_SESSION['incorrect']))
 {
     unset($_SESSION['incorrect']);
     ?>
     <script>alert("No account found with that username and password");</script>
     <?php
 }*/
if (isset($_SESSION['wentwrong'])) {
    unset($_SESSION['wentwrong']);
?>
    <script>
        alert("Something went wrong");
    </script>
<?php
}
if (isset($_SESSION['contact'])) {
    unset($_SESSION['contact']);
?>
    <script>
        alert("We have recieved your request");
    </script>
    <?php
}
// Check if the user is already logged in, if yes then redirect him to welcome page


// Include config file
require_once "config.php";

//-------------------------------------------------------------------------------------------------- Problem here

// $log_id = $_GET['id'];
if(isset($_GET['id']))
{
    $log_id = $_GET['id'];
}
else
$log_id = "";

// Define variables and initialize with empty values for login
$username = $password = "";
$username_err = $password_err = "";


// Define variables and initialize with empty values for signup
$confirm_password = "";
$confirm_password_err = "";

if ($log_id == 'login') {
    // Processing form data when form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Check if username is empty
        $trimmed = trim($_POST["username"]);
        if (empty($trimmed)) {
            $username_err = "Please enter username.";
        } else {
            $username = trim($_POST["username"]);
        }

        // Check if password is empty
        $trimmed = trim($_POST["username"]);
        if (empty($trimmed)) {
            $password_err = "Please enter your password.";
        } else {
            $password = trim($_POST["password"]);
        }

        // Validate credentials
        if (empty($username_err) && empty($password_err)) {
            // Prepare a select statement
            $sql = "SELECT id, username, password,type FROM users WHERE username = ? and password=? and type=?";

            if ($stmt = mysqli_prepare($link, $sql)) {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_password, $param_type);

                // Set parameters
                $param_username = $username;
                $param_password = $password;
                $param_type = $_POST['type'];
                // Attempt to execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                    // Store result
                    mysqli_stmt_store_result($stmt);

                    // Check if username exists, if yes then verify password
                    if (mysqli_stmt_num_rows($stmt) == 1) {
                        // Bind result variables
                        mysqli_stmt_bind_result($stmt, $id, $username, $password, $type);
                        if (mysqli_stmt_fetch($stmt)) {
                            /* shoaib if($password, $hashed_password){ shoaib*/
                            // Password is correct, so start a new session


                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            $_SESSION['type'] = $type;

                            // Redirect user to welcome page
                            header("location: welcome.php");
                            /* shoaib   } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        } shoaib*/
                        }
                    } else {
                        // Display an error message if username doesn't exist
    ?><script>
                            alert("No account found with your credentials");
                        </script><?php
                                }
                            } else {
                                echo "Oops! Something went wrong. Please try again later.";
                            }
                        }

                        // Close statement
                        mysqli_stmt_close($stmt);
                    }

                    // Close connection
                    mysqli_close($link);
                }
            } elseif ($log_id == 'signup') {
                $f = 0;
                // Processing form data when form is submitted
                if ($_SERVER["REQUEST_METHOD"] == "POST") {

                    // Validate username
                    $trimmed = trim($_POST["username"]);
                    if (empty($trimmed)) {
                        $susername_err = "Please enter a username.";
                    } else {
                        // Prepare a select statement
                        $sql = "SELECT id FROM users WHERE username = ?";

                        if ($stmt = mysqli_prepare($link, $sql)) {
                            // Bind variables to the prepared statement as parameters
                            mysqli_stmt_bind_param($stmt, "s", $param_username);

                            // Set parameters
                            $param_username = trim($_POST["username"]);

                            // Attempt to execute the prepared statement
                            if (mysqli_stmt_execute($stmt)) {
                                /* store result */
                                mysqli_stmt_store_result($stmt);

                                if (mysqli_stmt_num_rows($stmt) == 1) {
                                    $f = 1;
                                    ?>
                        <script>
                            alert("Username already taken");
                        </script>
                    <?php
                                } else {
                                    $username = trim($_POST["username"]);
                                }
                            } else {
                                echo "Oops! Something went wrong. Please try again later.";
                            }
                        }

                        // Close statement
                        mysqli_stmt_close($stmt);
                    }

                    // Validate password
                    $trimmed = trim($_POST["password"]);
                    if (empty($trimmed)) {
                        $password_err = "Please enter a password.";
                    } elseif (strlen(trim($_POST["password"])) < 6) {
                        $password_err = "Password must have atleast 6 characters.";
                    } else {
                        $password = trim($_POST["password"]);
                    }

                    // Validate confirm password
                    $trimmed = trim($_POST["password"]);
                    if (empty($trimmed)) {
                        $confirm_password_err = "Please confirm password.";
                    } else {
                        $confirm_password = trim($_POST["confirm_password"]);
                        if (empty($password_err) && ($password != $confirm_password)) {
                            $confirm_password_err = "Password did not match.";
                        }
                    }

                    // Check input errors before inserting in database
                    if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {

                        // Prepare an insert statement
                        $sql = "INSERT INTO users (username, password,name,type,code) VALUES (?, ?,?,?,?)";

                        if ($stmt = mysqli_prepare($link, $sql)) {
                            // Bind variables to the prepared statement as parameters
                            mysqli_stmt_bind_param($stmt, "sssss", $param_username, $param_password, $param_name, $param_type, $param_code);

                            // Set parameters
                            $param_username = $username;
                            $param_name = $_POST['name'];
                            $param_type = $_POST['type'];
                            $param_password = $password;
                            if ($param_type == 'Teacher') {
                                $num = 1;
                                $code = substr(md5(rand(101, 999)), 0, 5);
                                $code = $code . rand(0, 9);
                            } else {
                                $code = $_POST['code'];
                                $num = mysqli_num_rows(mysqli_query($link, "select * from users where code='$code'"));
                            }
                            $param_code = $code;

                            if ($num > 0 && $f == 0) {
                                // Attempt to execute the prepared statement
                                if (mysqli_stmt_execute($stmt)) {
                    ?><script>
                            alert("Registered Successfully");
                        </script><?php
                                } else {
                                    ?><script>
                            alert("Something went wrong");
                        </script><?php
                                }
                            } else {
                                if ($f == 1) {
                                } else {
                                    ?><script>
                            alert("Incorrect referal code ask your teacher for correct code");
                        </script><?php
                                }
                            }
                            // Close statement
                            mysqli_stmt_close($stmt);
                        }
                    }
                }

                // Close connection
                mysqli_close($link);
            }
 ?>


<!DOCTYPE html>
<html>
<head>
    <title>Vlab</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/clean-blog.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
</head>
<body>
<div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?id=login" method="post" class="sign-in-form">
            <h2 class="title">Sign in</h2>
            <div class="input-field <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Username" name="username" />
              <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="input-field <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name="password" />
              <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <select name="type" class="input-field">
                    <option>Student</option>
                    <option>Teacher</option>
            </select>
            <input type="submit" value="Login" class="btn solid" />
          </form>
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?id=signup" method="post" class="sign-up-form">
            <h2 class="title">Register</h2> 
            <div class="input-field <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Username" name="username" />
              <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="input-field <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name="password" />
              <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="input-field <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <i class="fas fa-lock"></i>
                <input type="password" placeholder="Confirm Password" name="confirm_password" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="input-field ">
            <i class="fas fa-user"></i>
                <input required type="text" name="name" placeholder="Name">
            </div>
            <select onchange="chan(this.value)" name="type" aria-placeholder="Type" class="input-field">
                    <option>Student</option>
                    <option>Teacher</option>
            </select>
            <input type="submit" class="btn" value="Sign up" />
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>New here ?</h3>
            <p>
              Register Here in Virtual Lab to proceed the Test
            </p>
            <button class="btn transparent" id="sign-up-btn">
              Sign up
            </button>
          </div>
          <img src="images/lab1.png" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>Already Registered ?</h3>
            <p>
              Login Here in Virtual Lab to proceed the Test
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Sign in
            </button>
          </div>
          <img src="images/Lab2.png" class="image" alt="" />
        </div>
      </div>
</div>
<div class="social-panel-container">
	<div class="social-panel">
		<p>Created with <i class="fa fa-heart"></i> by
		<h4>The ADC-Club,</h4>
		<h4>Dept. of Computer Science, AMU</h4>
	</div>
</div>
<footer class="footer">
    <h2>About Us</h2>
    <p>The Pathology V-Lab (Virtual laboratory) has been developed by students of <strong>The Area of Dominant Coders Club</strong> under the supervision of Dr. Swaleha Zubair, Department of Computer Science, AMU for the Department of Pathology, to provide The Students of Medicine with an online platform to practice routine laboratory experiments in a simulated environment.  
It is not a replacement for a hands-on training setup, but has the purpose to provide an enhanced learning experience with ease of access. 
We hope you enjoy using our Pathology V-Lab.
</p>
</footer>
<button class="floating-btn">
	Virtual Lab Team 
</button>
    <script src="js/app.js"></script>
    <script>
        function chan(val) {

            if (val == 'Student') {

                document.getElementById("chcode").setAttribute("style", "display:block");
            } else {

                document.getElementById("chcode").setAttribute("style", "display:none");
                document.getElementById("refcode").required = false;
            }
        }
        $(function() {
            $("#dev").click(function() {
                var body = "<div style='margin-bottom:10px;margin-top:10px;width:100%;font-family:'Comic Sans MS', cursive, sans-serif'>Under the supervision of Dr. Swaleha Zubair<br/>Shoaib Nusrat (nusratshoaibansarit@gmail.com)<br/>Maryam (maryam.aps2@gmail.com)<br/> Mohib Raza <br/> Noor Fatima<br/></div>";
                $("#devmodal .modal-body").html(body);
                $("#devmodal").modal("show");
            });
        });
    </script>
</body>

</html>