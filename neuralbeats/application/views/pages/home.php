<!--Janko Kitanovic-->
<div class="flex-container-main">
    <div>&nbsp;</div>
    <span class="font">Dobrodosli na sajt Neural Beats</span>
    <div>&nbsp;</div>
    <img src="<?php echo base_url('images/neural_beats.png'); ?>" class="home">
    <div>&nbsp</div>
    <span class="font"><a href="<?php
    if(!$this->session->has_userdata('korisnik')){ 
        echo base_url().'generator';
        
    }
        else echo base_url().'korisnik/view/generator';
    ?>" class="yellow">Otvorite generator</a></span>
</div>