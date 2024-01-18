<?php
    include 'connection.php';
?>
<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <title>Login</title>
</head>
<body> 
    <div class="container" id="container">
    
       
        <div class="form-container sign-up">
            <form method="post">
                <h1>Create Account</h1>
                <input type="text" name="name" placeholder="Full Name" required>
                <input type="number" name="phone" placeholder="Phone Number" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="text" name="address" placeholder="Address" required>
                <button name="signUp">SignUp</button>
            </form>
        </div>

        <div class="form-container sign-in">
            <form method="post">
                <h1>SignIn</h1>
                <input type="email" name="emailCheck" placeholder="Email" required>
                <input type="password" name="passwordCheck" placeholder="Password" required>
                <button name="signIn">SignIn</button>
            </form>
        </div>

        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome Back</h1>
                    <p>Enter your details to access feature of this site</p>
                    <button class="hidden" id="login">SignIn</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Hello Dear</h1>
                    <p>Enter your details and let's get start it</p>
                    <button class="hidden" id="register">SignUp</button>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="script.js"></script>
</html>
<?php 
    if(isset($_POST['signUp'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $address = $_POST['address'];
        $role = 'Patient';
        $s = "Insert into users(name, email, password, role, phone, address) 
            values ('".$name."','".$email."', '".$password."','".$role."','".$phone."','".$address."')";
        if(mysqli_query($conn, $s)){
            echo 'User Successfully Registered.';
        }
        else{
            echo 'User Not Successfully Registered.'; 
        }

    }
?>

<?php 
    if(isset($_POST['signIn'])){
        $email = $_POST['emailCheck'];
        $password = $_POST['passwordCheck'];
        $s = "SELECT * from users where email='".$email."' 
              AND password='".$password."'";
        $s2 = "SELECT * from doctors where email='".$email."' 
              AND password='".$password."'";
        $q2 = mysqli_query($conn, $s2);
        $q = mysqli_query($conn, $s);        
        $row = mysqli_fetch_assoc($q);
        $row2 = mysqli_fetch_assoc($q2);
        if($row){
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_role'] = $row['role'];
            if($row['role']=='Patient'){
                header('Location: dashboardPatient.php');
            }
            elseif($row['role']=='Doctor'){
                header('Location: dashboardDoctor.php');
            }
            elseif($row['role']=='Scheduler'){
                header('Location: dashboardScheduler.php');
            }
        }
        elseif ($row2) {
            $_SESSION['user_id'] = $row2['id'];
            $_SESSION['user_name'] = $row2['name'];
            $_SESSION['user_role'] = $row2['role'];
            if($row2['role']=='Patient'){
                header('Location: dashboardPatient.php');
            }
            elseif($row2['role']=='Doctor'){
                header('Location: dashboardDoctor.php');
            }
            elseif($row2['role']=='Scheduler'){
                header('Location: dashboardScheduler.php');
            }
        }
        else{
            echo 'User not Registered/Wrong Information';
        }
    }
?>