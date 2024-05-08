<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/48600096e7.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <title>Register & Login</title>
    <style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "poppins", sans-serif;
}

.top {
    margin: 10rem;    
}

body {
    width: 100% auto;
    height: 10% auto;
    background-color: #f5f5f5;
}

.container {
    backdrop-filter: blur(10px);
    width: 350px;
    height: 370px;
    padding: 1.5rem;
    margin: 8% auto;
    border: none;
}

form {
    margin: 0.5rem;
}

.form-title {
    font-size: 3em;
    font-weight: bold;
    margin-left: 0.7em;
    padding: 1.3rem;
    margin-bottom: 2rem;
    font-family: "Inter", sans-serif;
}

input {
    color: black;
    width: 100%;
    background-color: transparent;
    border: none;
    border-bottom: 1px solid #000000;
    padding-left: 1.5rem;
    font-size: 15px;
}

.input-group {
    padding: 1% 0;
    position: relative;
}

.input-group i {
    position: absolute;
    color: rgb(0, 0, 0);
    margin: -3px;
}

.footer {
    text-align: center;
    margin-top: 13%;
    font-size: xx-small;
}

input:focus {
    background-color: transparent;
    outline: transparent;
    border-bottom: 1px solid hsl(0, 0%, 0%);
}

input::placeholder {
    color: transparent;
}

label {
    color: #000000;
    position: relative;
    left: 1.2em;
    top: -1.3em;
    cursor: auto;
    transition: 0.3s ease all;
}

input:focus~label, input:not(:placeholder-shown)~label {
    top: -2.85em;
    color: hsl(0, 0%, 0%);
    font-size: 15px;
}

.or {
    font-size: 1.1rem;
    margin-top: 0.5rem;
    margin-bottom: 0.5rem;
    text-align: center;
    font-size: 15px;
}

.icons {
    text-align: center;
}

.icons i{
    color: rgb(125, 125, 235);
    padding: 0.8rem 1.5rem;
    border-radius: 10px;
    font-size: 1.5rem;
    cursor: pointer;
    border: 2px solid #dfe9f5;
    margin: 0 15px;
    transition: 0.2s;
}

.icons i:hover {
    background: #07001f;
    border: 2px solid rgb(125, 125, 235);
}

.links {
    display: flex;
    justify-content: space-around;
    padding: 0 4rem;
    margin-top: 0.9rem;
    font-weight: bold;
}

button {
    color: rgb(0, 0, 0);
    border: none;
    background-color: transparent;
    text-decoration: underline;
    font-size: 1rem;
    transition: 0.2s;
}

button:hover {
    text-decoration: underline;
    color: rgb(0, 0, 0);
}

h1 {
    text-align: center;
    margin: 1em;
    color: rgb(0, 0, 0);

}

p {
    color: rgb(0, 0, 0);
}

.button {
    display: inline-block;
    border-radius: 7px;
    border: none;
    background: #1875FF;
    color: white;
    font-family: inherit;
    text-align: center;
    vertical-align: center;
    width: 50%;
    margin: auto;
    font-size: 13px;
    width: 21.65em;
    padding: 1em;
    cursor: pointer;
    margin-bottom: 20px;
    margin-top: 20px;
}
   
.button span {
    cursor: pointer;
    color: white;
    display: inline-block;
    position: relative;
    transition: 0.4s;
}
   
.button span:after {
    content: 'To Your Account';
    color: white;
    position: absolute;
    opacity: 0;
    top: 0;
    right: -80px;
    transition: 0.7s;
}
   
.button:hover span {
    padding-right: 7.5em;
}
   
.button:hover span:after {
    opacity: 4;
    right: 0;
}

.button-signup {
    display: inline-block;
    border-radius: 7px;
    border: none;
    background: #1875FF;
    color: white;
    font-family: inherit;
    text-align: center;
    vertical-align: center;
    width: 50%;
    margin: auto;
    font-size: 13px;
    width: 21.65em;
    padding: 1em;
    cursor: pointer;
    margin-bottom: 20px;
    margin-top: 20px;
}
   
.button-signup span {
    cursor: pointer;
    color: white;
    display: inline-block;
    position: relative;
    transition: 0.4s;
}
   
.button-signup span:after {
    content: 'Using @chairo';
    color: white;
    position: absolute;
    opacity: 0;
    top: 0;
    right: -80px;
    transition: 0.7s;
}
   
.button-signup:hover span {
    padding-right: 7em;
}
   
.button-signup:hover span:after {
    opacity: 4;
    right: 0;
}
    </style>
</head>
<body>
    <body>
        <div class="container" id="signUp" style="display: none;">
            <h1 class="form-title">Register</h1>
            <form method="post" action="signup.php">
                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="username" id="username" placeholder="Username" required>
                    <label for="username">Username</label>
                </div>
                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" id="email" placeholder="Email" required>
                    <label for="email">Email</label>
                </div>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" id="password" placeholder="Password" required>
                    <label for="password">Password</label>
                </div>
                <button class="button-signup" type="submit" value="Sign Up" name="signUp" style="vertical-align:middle"><span>Sign Up</span></button>
            </form>
            <p class="or">
                or, if you've got an account
            </p>
            <div class="links">
                <button id="signInButton">Sign In</button>
            </div>
        </div>
        
        <div class="container" id="signIn">
            <h1 class="form-title">Sign In</h1>
            <form method="post" action="login.php">
                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="username" id="username" placeholder="Username" required>
                    <label for="username">Username</label>
                </div>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" id="password" placeholder="Password" required>
                    <label for="password">Password</label>
                </div>
                <button class="button" style="vertical-align:middle" type="submit" class="btn" value="Sign In" name="signIn"><span>Sign In</span></button>
            </form>
            <p class="or">
                or, you could try signing up
            </p>
            <div class="links">
                <button id="signUpButton">Sign Up</button>
            </div>
        </div>
        <footer class="footer">
            <p>&copy Chairo Connect 2024</p>
    <script src="script.js"></script>
</body>
</html>