/*var attempt = 3; // Variable to count number of attempts.
// Below function Executes on click of login button.
function validate(){
	var username = document.getElementById("username").value;
	var password = document.getElementById("password").value;
	
	if ( username == "Formget" && password == "formget#123"){
		alert ("Login successfully");
		window.location = "/index.html"; // Redirecting to other page.
		return false;
	}
	else{
		attempt --;// Decrementing by one.
		alert("You have left "+attempt+" attempt;");
		// Disabling fields after 3 attempts.
		if( attempt == 0){
			document.getElementById("username").disabled = true;
			document.getElementById("password").disabled = true;
			document.getElementById("submit").disabled = true;
			return false;
		}
	}
}
*/
$('document').ready(function()
{ 
	/* validation */
	$("#login-form").validate({
		rules:
		{
			password: {
				required: true,
			},
			user_email: {
				required: true,
				email: true
			},
		},
			messages:
		{
			password:{
					  required: "please enter your password"
			},
			user_email: "please enter your email address",
		},
		submitHandler: submitForm 
	});  
	/* validation */
	
	/* login submit */
	function submitForm()
	{
		var data = $("#login-form").serialize();
		
		$.ajax({
		
			type : 'POST',
			url  : 'login_process.php',
			data : data,
			beforeSend: function()
			{ 
				$("#error").fadeOut();
				$("#btn-login").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; sending ...');
			},
			success :  function(response)
			{      
				if(response=="ok"){
					$("#btn-login").html('<img src="btn-ajax-loader.gif" /> &nbsp; Signing In ...');
					setTimeout(' window.location.href = "home.php"; ',4000);
				}
				else{
					$("#error").fadeIn(1000, function(){      
						$("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');
						$("#btn-login").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In');
					}
				);}
			}
		});
	}
}
);