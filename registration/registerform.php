<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webleb</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../registrationStyling/register.css">
    
    
</head>

<body style="display:flex; align-items:center; justify-content:center;
background-color: #0e2941;">


  <div class="form">
    <div class="form-fields">
     <form class="register-form" action="register.php" method="POST">
        
        <h2><i class="fas fa-lock"></i> Register</h2>
        
        <div class="fields">
            <input type="text" name="full-name" placeholder="Full Name *"
            required><br>
        </div>

         <div class="fields">
            <input type="text" name="username" placeholder="Username *" 
            required/><br>
            
        </div>

         <div class="fields">
         <input type="text" id="email" name= "em" 
         placeholder="Email *"
         required/>
         <span id="emailError" style="color: red;
            display: inline-block;
            width: 200px;
            "></span><br> <!-- Fixed width for error message -->
            
         </div>

        
         <div class="fields">
            <input type="password" name="password" id="password" 
            placeholder="Password *" required/>
            <span id="passwordError" style="color: red; display: 
            inline-block;
            width:200px"></span><br>

         </div>
        
        <div class="fields">
            <input type="submit" name="sub" value="Register">
        </div>
       
        <p class="message">Already registered? <a href="form.php">
            Sign In</a></p>
        
        </form>
    </div>
   
  </div>

  <script>
    document.querySelector('.register-form').addEventListener('submit', function(event) {
        const emailInput = document.getElementById('email');
        const emailError = document.getElementById('emailError');
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Email format regex pattern

        if (!emailPattern.test(emailInput.value)) {
            emailError.textContent = 
            'Please enter an email address with format info@gmail.com';
            event.preventDefault(); // Prevent form submission
        } else {
            emailError.textContent = ''; // Clear error message
        }
    });
</script>


<script>
    document.querySelector('.register-form').addEventListener('submit', function(event) {
        const passwordInput = document.getElementById('password');
        const passwordError = document.getElementById('passwordError');
        const passwordPattern = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;

        if (!passwordPattern.test(passwordInput.value)) {
            passwordError.textContent = 
            'Password should contain at least 8 characters, and include a, A, @, ! ...';
            event.preventDefault(); // Prevent form submission
        } else {
            passwordError.textContent = ''; // Clear error message
        }
    });
  </script>


</body>
</html>
