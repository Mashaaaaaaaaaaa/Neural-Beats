<!--Janko Kitanovic-->
<div class="signin">
    <form name="register" action="<?php echo base_url(); ?>Gost/registrujse" method="POST">
        <span class="signin">Register</span>
        <div>&nbsp</div>        
        <span>
            <?php if(isset($poruka)) echo "<font color='red' align='center'>$poruka</font>";
                    else echo '<div>&nbsp</div>'?>
        </span>
        <div>&nbsp</div>
        <div><input class="input-wrap" type="text" name="username" placeholder="Username"/></div>
        <span>
            <?php if(form_error('username')==TRUE)
                echo form_error('username');
                  else echo '<div>&nbsp</div>';?>
        </span>
        <div><input class="input-wrap" type="password" name="password1" placeholder="Password"/></div>
        <span>
            <?php if(form_error('password1')==TRUE)
                echo form_error('password1');
                  else echo '<div>&nbsp</div>';?>
        </span>
        <div><input class="input-wrap" type="password" name="password2" placeholder="Confirm Password"/></div>
        <span>
            <?php if(form_error('password2')==TRUE)
                echo form_error('password2');
                  else echo '<div>&nbsp</div>';?>
        </span>
        <div><input class="input-wrap" type="text" name="email" placeholder="E-mail"/></div>
        <span>
            <?php if(form_error('email')==TRUE)
                echo form_error('email');
                  else echo '<div>&nbsp</div>';?>
        </span>    
        <div>&nbsp</div><div>&nbsp</div>
        <div><input class="button-wrap" type="submit" name="submitRegister" value="REGISTER"></div>
    </form>
</div>