<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <h1>Register</h1>
    <!-- modifier action -->
        <form action="index.php?ctrl=security&action=register" method="POST">
            <label for="nickname">Nickname</label>
            <input type="text" name="nickname" id=""><br>
            
            <label for="email">Email</label>
            <input type="email" name="email" id=""><br>
            
            <label for="pass1">Password</label>
            <input type="password" name="pass1" id=""><br>
            
            <label for="pass2">Confirm password</label>
            <input type="password" name="pass2" id=""><br>
            
            <input type="submit" name="submit" value="Register"><br>
        </form>
</body>
</html>