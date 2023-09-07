
<p>S'inscrire</p>


<form action="index.php?ctrl=security&action=register" method = POST>

    <label >Pseudo</label>
    <input type ="text" name="username" required>

    <label >Email</label>
    <input type ="email" name="email" required placeholder="....@....">
    
    <label >Mot de Passe</label>
    <input type="password" name="password1"  required placeholder="*****">

    <label >Confirmer du mot de Passe</label>
    <input type="password" name="password2"  required placeholder="*****">
    
    <input type="submit" name="submit" >
    

</form>
