<!--Janko Kitanovic-->
<html>
    <head >
        <title>Neural Beats</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">
    </head>
    <body>
        <div class="header">
            <table width="100%">
                <tr>
                    <td><a href="<?php echo base_url(); ?>korisnik">
                            <img src="<?php echo base_url('images/neural_beats_small2.png'); ?>" class="header">
                        </a></td>
                    <td>
                            <table>
                                <tr>
                                <form name="search" action="<?php echo base_url(); ?>korisnik/search" method="POST">
                                    <td><input class="header-tekst" type="text" placeholder="Search" size="30"></td>
                                    <td><input type="submit" value="Search" class="search"></td>
                                </form>
                                </tr>
                            </table>
                    </td>
                    <td>
                        <font color="white">Korisnik: <?php echo $korisnik->Username." "; ?></font>
                    </td>
                    <td>
                        <a class="yellow" href="<?php echo site_url("Korisnik/logout"); ?>">Logout</a>
                    </td>
                </tr>
            </table>
            
        </div>
