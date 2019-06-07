<div class="signin">
    <form name="login" action="<?php echo base_url(); ?>gost/ulogujse" method="POST">
        <span class="signin">Login</span>
        <div>&nbsp</div><div>&nbsp</div><div>&nbsp</div>
        <div><input class="input-wrap" type="text" name="username" placeholder="Username"/></div>
        <div>&nbsp</div>
        <div><input class="input-wrap" type="password" name="password" placeholder="Password"/></div>
        <div>&nbsp</div><div>&nbsp</div>
        <div><input class="button-wrap" type="submit" value="LOGIN"></div>
        <div>&nbsp</div><div>&nbsp</div>
        <div class="tekst-gray">Don’t have an account?</div>
        <div class="tekst-link"><a href="<?php echo base_url(); ?>register">SIGN UP NOW</a></div>
    </form>
</div>