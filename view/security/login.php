<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
</head>
<body>
    <h1>Se connecter</h1>

        <form action="tritement.php?action=register" methode="POST">
           
            <label for="email">Mail</label>
            <input type="email" name="email" id="email"><br>
            
            <label for="pass1">Mot de passe</label>
            <input type="password" name="pass1" id="pass1"><br>
            

            
            <input type="submit" value="Se connecter"><br>


        </form>

</body>
</html>