<html>
    <head >
        <title>Neural Beats</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">
    </head>
    <body>
        <div class="header">
            <table width="100%">
                <tr>
                    <td><a href="<?php echo base_url(); ?>">
                            <img src="<?php echo base_url('images/neural_beats_small2.png'); ?>" class="header">
                        </a></td>
                    <td>
                            <table>
                                <tr>
                                <form name="search" action="<?php echo base_url(); ?>search" method="POST">
                                    <td><input class="header-tekst" type="text" placeholder="Search" size="50"></td>
                                    <td><input type="submit" value="Search" class="search"></td>
                                </form>
                                </tr>
                            </table>
                    </td>
                    <td><form name="signin" action="<?php echo base_url(); ?>login" method="POST"><input type="submit" value="SIGN IN" class="signin"></form></td>                    
                </tr>
            </table>
            
        </div>
