<!--Janko Kitanovic-->
<div class="signin">
    <form name="login" action="<?php echo base_url(); ?>Gost/ulogujse" method="POST">
        <span class="signin">Login</span>
        <div>&nbsp</div><div>&nbsp</div>
        <span><?php if(isset($poruka)) echo "<font color='red' align='center'>$poruka</font><br>";?></span>        
        <div>&nbsp</div>
        <div><input class="input-wrap" type="text" name="username" placeholder="Username"/></div>
        <span><?php echo form_error('username');?></span>
        <div>&nbsp</div>
        <div><input class="input-wrap" type="password" name="password" placeholder="Password"/></div>
        <span><?php echo form_error('password');?></span>
        <div>&nbsp</div><div>&nbsp</div>
        <div><input class="button-wrap" type="submit" name="submit" value="LOGIN"></div>
        <div>&nbsp</div><div>&nbsp</div>
        <div class="tekst-gray">Don’t have an account?</div>
        <div class="tekst-link"><a href="<?php echo base_url(); ?>register">SIGN UP NOW</a></div>
    </form>
</div>