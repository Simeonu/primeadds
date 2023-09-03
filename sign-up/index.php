<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="main.css">
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
<link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
<link href="sign-up/img/my_logo.png" rel="icon">
<title>Sign up-form</title>

<!-- <link rel="stylesheet"href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

</head>
<body>
<div class="signup-form">
    <form action="" method="post">

		<div class="form-group return_home">
           <a href="../index.html"> <img src="../my_dashboard/img/my_logo.png" alt="my_logo" id="logo"></a>
        </div>

		<h2>Sign Up</h2>
		<p>Please fill in this form to create an account!</p>
		<hr>
        <div class="form-group">
			<input type="text" class="form-control" name="name" id="name" placeholder="Name" required="required" />
		</div>
		<div class="form-group">-
			<input type="text" class="form-control" name="username" id="username" placeholder="Username" required="required" />
		</div>
        <div class="form-group">
        	<input type="email" class="form-control" name="email" id="email" placeholder="Email" required="required">
        </div>
		<div class="form-group">
            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required="required">
        </div>  

		 <div class="form-group">
			<label class="checkbox-inline"><input type="checkbox" required="required"> I accept the <a href="../terms">Terms of Use</a> &amp; <a href="#">Privacy Policy</a></label>
		</div>
		<div class="reply"></div>  
		<div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg w-100">Sign Up</button>
        </div>
		<div class="hint-text">Already have an account? <a href="../login/">Login here</a></div>
    </form>
</div>

<script>

	const form  = document.querySelector("form");
	const reply = document.querySelector(".reply");

	form.addEventListener("submit", function(event){
		event.preventDefault();
		reply.innerHTML =  `<div class="text-center">
                              <!-- Using the "spinner-border" class for the spinner -->
                              <div class="spinner-border" role="status">
                                <span class="visually-hidden">Loading...</span>
                              </div>
                          </div>`;   

		const data = {
			name: document.getElementById("name").value,
			username: document.getElementById("username").value,
			email: document.getElementById("email").value,
			password: document.getElementById("password").value
		};

		const sendData = JSON.stringify(data);

		fetch("../api/signup/", {
			method: "POST",
			headers:{
				"Content-type": "application/json"
			},
			body: sendData
		})
		.then(call => call.json())
		.then(data => {

				if (data.message =='success'){
					reply.innerHTML = `<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>successfully created account</strong>.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                  </div>`;

					setTimeout(() => {
						location.href ="../login/";
					}, 2000);
				}else{
					reply.innerHTML =` <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>${data.message}</strong>.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                  </div>`;
				}
			})
			.catch(error => {
				console.error("Error: " , error);
			});

	});

	

</script>



</body>
</html>