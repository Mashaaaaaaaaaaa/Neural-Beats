<!--Janko Kitanovic-->
<div class="signin">
    <form name="login" action="<?php echo base_url(); ?>Gost/ulogujse" method="POST">
        <span class="signin">Login</span>
        <div>&nbsp</div><div>&nbsp</div>
        <span>
            <?php if(isset($poruka)) {
                if($poruka=="Uspesno ste kreirali nalog"){
                     echo "<font color='green' align='center'>$poruka</font>";
                }  else echo "<font color='red' align='center'>$poruka</font>";
            } else echo '<div>&nbsp</div>'?>
        </span>        
        <div>&nbsp</div>
        <div><input class="input-wrap" type="text" name="username" placeholder="Username"/></div>
        <span>
            <?php if(form_error('username')==TRUE)
                echo form_error('username');
                  else echo '<div>&nbsp</div>';?>
        </span>
        <div><input class="input-wrap" type="password" name="password" placeholder="Password"/></div>
        <span>
            <?php if(form_error('password')==TRUE)
                echo form_error('password');
                  else echo '<div>&nbsp</div>';?>
        </span>
        <div>&nbsp</div>
        <div><input class="button-wrap" type="submit" name="submitLogin" value="LOGIN"></div>
        <div>&nbsp</div><div>&nbsp</div>
        <div class="tekst-gray">Don’t have an account?</div>
        <div class="tekst-link"><a href="<?php echo base_url(); ?>register">SIGN UP NOW</a></div>
    </form>
</div>