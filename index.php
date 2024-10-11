<html>
    <head>
       <!-- <link rel="stylesheet" href="style.css">-->
    </head>
    <script>

        function HandleLoginResponse(response)
        {
            var text = JSON.parse(response);
            //	document.getElementById("textResponse").innerHTML = response+"<p>";	
            document.getElementById("textResponse").innerHTML = "response: "+text+"<p>";
        }

        function SendLoginRequest(username,password)
        {
            var request = new XMLHttpRequest();
            request.open("POST","login.php",true);
            request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
            request.onreadystatechange= function ()
            {
        
                if ((this.readyState == 4)&&(this.status == 200))
                {
                    HandleLoginResponse(this.responseText);
                }		
            }
            request.send("type=login&uname="+username+"&pword="+password);
        }
</script>

    <!--<h1>login page</h1>-->
<!-- My HTML Work -->
    <body>

        <header class="main-header">
            <h1 class="title-pg">IT-490-Project</h1>
            <nav class="header-nav">
                <ul class="link-list">
                    <li class="link-item">
                        <button class="btn">
                            <a href="#" class="placeholder-link">Link1</a>
                        </button>
                    </li>
                    <li class="link-item">
                        <button class="btn">
                            <a href="#" class="placeholder-link">Link2</a>
                        </button>
                    </li>
                    <li class="link-item">
                        <button class="signup">
                            <a href="signup.html" class="placeholder-link">Signup</a>
                        </button>
                    </li>
                </ul>
            </nav>
        </header>

        <main class="pg-main">
            <section class="sign-in">
                <h2 class="login">Login</h2>
                <form action="" class="login-form" method="post">
                    <label for="username">Username: </label><br>
                    <input type="text" class="login-input" name="username" placeholder="username"><br><br>

                    <label for="password">Password: </label><br>
                    <input type="password" class="login-input" name="password" placeholder="password" required><br>
                    <input type="submit" class="submit" value="Sign In">
                </form>
	    </section>
	<!-- 
            <p class="past-works">Past Works</p>
            <section class="images">
                <section class="img-sec1">
                    <img src="images/placeholder-1024x1024.png" alt="" class="image1">
                    <img src="images/placeholder-1024x1024.png" alt="" class="image1">
                    <img src="images/placeholder-1024x1024.png" alt="" class="image1">
                    <img src="images/placeholder-1024x1024.png" alt="" class="image1">
                </section>
                <section class="img-sec2">
                    <img src="images/placeholder-1024x1024.png" alt="" class="image2">
                    <img src="images/placeholder-1024x1024.png" alt="" class="image2">
                    <img src="images/placeholder-1024x1024.png" alt="" class="image2">
                    <img src="images/placeholder-1024x1024.png" alt="" class="image2">
                </section>
            </section>
            <section class="about-service">
                <p class="p-about-service">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi cupiditate magnam vero dignissimos dolorum inventore ratione ipsum quisquam porro odit non neque, rem doloremque molestiae quaerat explicabo at aspernatur hic.
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ad, aliquid! Porro explicabo dignissimos officia officiis, dolorum harum ipsa tenetur accusantium, nihil fuga deserunt ut, consectetur fugiat ipsam nobis rem vel.
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Reiciendis accusamus aliquid tempore sit, molestias aspernatur modi rerum vel non amet dolor nam repellat dignissimos veniam quasi itaque mollitia quibusdam eos.
                </p>
            </section> -->
        </main>
        <!--</html><div id="textResponse">
            awaiting response
        </div>-->
        
        <script>
            SendLoginRequest("kehoed","12345");
        </script>

        <footer class="footer">
            <p class="copyright">&copy; 2024. Copyright by IT-490-Project</p>
        </footer>
    </body>
</html>



<?php
/*
$username = $_POST["username"];

$password = $_POST["password"];

$hash = password_hash($password, PASSWORD_DEFAULT);

echo $password;
echo "<br>";
echo $hash;
echo "<br>";

$passconfirmed = password_verify($password, $hash);

if ($username == $username)

	echo "That is the username. <br>";
else

	echo "Not a valid username. <br>";

if ($passconfirmed == $password)

	echo "That is the password. <br>";

else

	echo "That is not the password. <br>";

 */
?>
