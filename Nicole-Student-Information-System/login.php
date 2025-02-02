<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SIS</title>
        <link rel="icon" href="../USJR/images/slsuloogo.png" type="image">
        <link rel="stylesheet" href="bootstrap.min.css">
        <script defer src="bootstrap.bundle.min.js"></script>
        <style>
        
            .horizontal-line1 {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 5px; 
                background-color: blue;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); 
            }

            .header{
                margin-top: 1%; 
            }
          

            .welcomeMsg h2{
                margin-top: 5%;
                font-weight: 700;
                text-align: center;
            }

            .mainComponent{
                display: flex;
                flex-direction: horizontal;
                align-items: center; 
                justify-content: center; 
            }

            .formDiv {
                margin-top: 2%;
                margin-left: 15%;
                margin-right: 20px;
                border: 1px solid black;
                width: 361px;
                padding-top:20px;
                padding-left:20px;
                padding-right:20px;
                border-radius: 10px;
            }

            h4 {
                text-align: center;
            }

            .entry {
                width: 315px; 
                margin-top: 20px;
            }

            .formbtn1{
                width:100px; 
            }

            .registerMsg{
                margin-top: 20px;
            }

            .formbtn2{
                width:200px;
                margin-left: 10px; 
                text-decoration: none;
            }

            .bg{
                margin-top: 2%;
            }

            .horizontal-line3 {
                position: fixed;
                margin-top: 3%;
                margin-left: 10%;
                width: 80%;
                height: 1px; 
                background-color: #B2B2B2;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); 
            }
        </style>
    </head>
    <body>
        <div class="horizontal-line1">

        </div>

        <div class="container header">
            <img src="images/slsuloogo.png" class="img-fluid" alt="image">
        </div>

        <div class="container welcomeMsg">
            <h2>Students Information System</h2>
        </div>

        <div class="container mainComponent">
        
            <div class="container formDiv">
                <h4>LOGIN</h4>

                <form action="processlogin.php" method="post" class="entry">

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="username" id="username" required>
                    <label for="username">Username</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="password" class="form-control" name="password" id="password" required>
                    <label for="password">Password</label>
                </div>

                    <button type="submit" class="btn btn-primary formbtn1">Login</button><br>
                    <p class="registerMsg">Need an account?<span><a href="register.php" class="formbtn2">Register</a></span></p>
                </form>
            </div>

            <div class="container bg">
                <img src="images/a bg.png" class="img-fluid" alt="image">
            </div>
            
        </div>

        <div class="horizontal-line3">

        </div>

    </body>
</html>

