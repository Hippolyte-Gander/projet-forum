<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
</head>
<body>
    <h1>Login</h1>
        <form action="index.php?ctrl=security&action=login" method="POST"> 
           
            <label for="email">Mail</label>
            <input type="email" name="email" id="email"><br>
            
            <label for="pass1">Mot de passe</label>
            <input type="password" name="password" id="password"><br>
            

            
            <input type="submit" name="submit" value="Login"><br>


        </form>

</body>
</html>