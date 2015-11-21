<?php 
  	session_start(); //starts the session
?>
<!DOCTYPE html>
<html>
  	<head>
	    <!-- Custom CSS -->
	    <!-- <style type="text/css">
	      html, body, #map-canvas { 
	        height: 100%; 
	        width: 100%; 
	        margin: 0; 
	        padding: 5px;
	      }

	      #map-canvas{        
	        border: solid Gray 1px;
	        border-radius: 2px;
	      }
	    </style>-->
	    <!-- Latest compiled and minified CSS -->
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"> 
	    <!-- Optional theme -->
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">     
	    <!-- Latest compiled and minified JavaScript -->
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	    <!--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBijJW7Sza7_8F5mlobNi9j7kWf3lCGY_A"></script>-->
        <title>Our Project</title>
	</head>
    <body>
    	<!--<div id="fb-root"></div>-->
		<script>
			/*(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/en_GB/sdk.js";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));

			// This is called with the results from from FB.getLoginStatus().
			function statusChangeCallback(response) {
			    console.log('statusChangeCallback');
			    console.log(response);
			    // The response object is returned with a status field that lets the
			    // app know the current login status of the person.
			    // Full docs on the response object can be found in the documentation
			    // for FB.getLoginStatus().
			    if (response.status === 'connected') {
			      	// Logged into your app and Facebook.
			      	testAPI();
			    } else if (response.status === 'not_authorized') {
			      	// The person is logged into Facebook, but not your app.
			      	document.getElementById('status').innerHTML = 'Please log ' +
			        'into this app.';
			    } else {
			      	// The person is not logged into Facebook, so we're not sure if
			      	// they are logged into this app or not.
			      	document.getElementById('status').innerHTML = 'Please log ' +
			        'into Facebook.';
			    }
			}

			function testAPI() {
			    console.log('Welcome!  Fetching your information.... ');
			    FB.api('/me', function(response) {
			      	console.log('Successful login for: ' + response.name);
			      	document.getElementById('status').innerHTML =
			        'Thanks for logging in, ' + response.name + '!';
				});
			}

			function checkLoginState() {
			    FB.getLoginStatus(function(response) {
			      statusChangeCallback(response);
			    });
			}

			window.fbAsyncInit = function() {
			    FB.init({
			      appId      : '719693054844228',
			      xfbml      : true,
			      version    : 'v2.3',
			      cookie	 : true
			    });

				FB.getLoginStatus(function(response) {
				    statusChangeCallback(response);
				});
			};	*/	

			$(document).ready(function() {
				$('#error').hide();
				$('#success').hide();
				var errorMessage = <?php echo json_encode($_SESSION['errorMessage']); ?>;
				var successMessage = <?php echo json_encode($_SESSION['successMessage']); ?>;
				if(errorMessage != "" && errorMessage != "null" && errorMessage != null){
					$('#error').show();
				}
				if(successMessage != "" && successMessage != "null" && successMessage != null){
					$('#success').show();
				}
				console.log(errorMessage);
			});


		</script>
    	<div class="container"> 
	        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2"> 
	        	<div id="success" name="success" class="alert alert-success" role="alert">
	        		<?php echo $_SESSION['successMessage']; ?>
	        	</div>
				<div id="error" name="error" class="alert alert-danger" role="alert">
				  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
				  <span class="sr-only">Error:</span>
				  <?php echo $_SESSION['errorMessage']; ?>
				</div>                      
	            <div class="panel panel-info">
	                <div class="panel-heading">
	                    <div class="panel-title">Sign In</div>
	                    <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Forgot password?</a></div>
	                </div> 
	                <div style="padding-top:30px" class="panel-body">
	                    <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
	                    <form id="loginform" class="form-horizontal" role="form" action="checklogin.php" method="post">
	                        <div style="margin-bottom: 25px" class="input-group">
	                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
	                            <input id="login-email" type="email" class="form-control" name="email" value="" placeholder="Email" required>                                        
	                        </div>	                            
	                        <div style="margin-bottom: 25px" class="input-group">
	                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
	                            <input id="login-password" type="password" class="form-control" name="password" placeholder="Password" required>
	                        </div>    
	                        <div style="margin-top:10px" class="form-group">
	                            <!-- Button -->
	                            <div class="col-sm-12 controls">
	                              	<button id="btn-login" type="submit" href="#" class="btn btn-success">Login</button>
	                              	<!--<fb:login-button scope="public_profile,email" onlogin="checkLoginState();" auto_logout_link="true"></fb:login-button>
	                              	<div id="status"></div>-->
	                            </div>
	                        </div>
	                        <div class="form-group">
	                            <div class="col-md-12 control">
	                                <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%">
	                                    Don't have an account! 
		                                <a href="#" onclick="$('#loginbox').hide(); $('#signupbox').show()">
		                                    Sign Up Here
		                                </a>
	                                </div>
	                            </div>
	                        </div>    
	                    </form>  
	                </div>                     
            	</div>  
	        </div>
	        <div id="signupbox" style="display:none; margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
	            <div class="panel panel-info">
	                <div class="panel-heading">
	                    <div class="panel-title">Sign Up</div>
	                    <div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="#" onclick="$('#signupbox').hide(); $('#loginbox').show()">Sign In</a></div>
	                </div>  
	                <div class="panel-body">
	                    <form id="signupform" class="form-horizontal" role="form" action="register.php" method="post">
	                        <div id="signupalert" style="display:none" class="alert alert-danger">
	                            <p>Error:</p>
	                            <span></span>
	                        </div>
	                        <div class="form-group">
	                            <label for="firstname" class="col-md-3 control-label">First Name</label>
	                            <div class="col-md-9">
	                                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" required>
	                            </div>
	                        </div>
	                        <div class="form-group">
	                            <label for="lastname" class="col-md-3 control-label">Last Name</label>
	                            <div class="col-md-9">
	                                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" required>
	                            </div>
	                        </div>
	                        <div class="form-group">
	                            <label for="email" class="col-md-3 control-label">Email</label>
	                            <div class="col-md-9">
	                                <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" required>
	                            </div>
	                        </div>
	                        <div class="form-group">
	                            <label for="password" class="col-md-3 control-label">Password</label>
	                            <div class="col-md-9">
	                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
	                            </div>
	                        </div>
	                        <div class="form-group">
	                            <!-- Button -->                                        
	                            <div class="col-md-offset-3 col-md-9">
	                                <button id="btn-signup" type="submit" class="btn btn-info"><i class="icon-hand-right"></i>Sign Up</button>
	                            </div>
	                        </div>
	                    </form>
	                 </div>
	            </div>
	         </div> 
	    </div>
    </body>
</html>
<?php 
  	session_unset(); //end the session
?>