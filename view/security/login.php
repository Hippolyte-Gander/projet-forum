<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
</head>
<body>
    <h1>Se connecter</h1>
    <!-- modifier action -->
        <form action="index.php?action=register" methode="POST"> 
           
            <label for="email">Mail</label>
            <input type="email" name="email" id="email"><br>
            
            <label for="pass1">Mot de passe</label>
            <input type="password" name="password" id="password"><br>
            

            
            <input type="submit" name="submit" value="Se connecter"><br>


        </form>

</body>
</html>