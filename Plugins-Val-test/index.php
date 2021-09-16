
<?php
/**
 * @package RdvTest
 * @version 1.0.0
 */
/*
Plugin Name: Plugins Rdv Val
Plugin URI: http://didierroche.com
Description: Un plugins de prise de rendez- vous génial par moi
Author: Valentin
Version: 1.0.0
Author URI:s
plugins_url('/wp-content/plugins/Plugins-Val-test/css/calendar.css')
*/
?>
<head>
    <link rel="stylesheet" href="\LeSpaDLN\wp-content\plugins\Plugins-Val-test\css\calendar.css" />
</head>
<?php



add_action("admin_menu", "add_menu");

function add_menu()
{
    add_menu_page("Plugins RDV Val", "Plugins RDV Val", 4 ,"mainpage", "RDVPAGE");
    add_submenu_page("mainpage", "Calendrier" ,"Calendrier", 4, "pagecal", "Cal");
    add_submenu_page("mainpage", "Nouveau Rendez-vous" ,"Nouveau Rendez-vous", 4, "pagerdv", "rdv");
    add_submenu_page("mainpage", "Lieux" ,"Lieux", 4, "pagelieux", "lieux");
    add_submenu_page("mainpage", "Fourniseurs" ,"Fourniseurs", 4, "pageFourniseurs", "Fourniseurs");
    add_submenu_page("mainpage", "Services" ,"Services", 4, "pageServices", "Services");
    add_submenu_page("mainpage", "Paramètres" ,"Paramètres", 4, "pageParamètres", "Paramètres");

}

function RDVpage()
{
    
    require 'src/date/Month.php' ;
    $month = new app\date\Month($_GET['month'] ?? null,$_GET['year'] ?? null);
    $start =  $month->getStartingDay()->modify('last monday');
    ?> 
    <div class="style-monthbtn">
        <h1><?php echo $month->toString();?></h1>
            
                <a href="?month=<?php echo $month->previousMonth()->month; ?>&year=<?php echo $month->previousMonth()->year;?>" 
                class="btn-calendar">&lt;</a>
                <a href="lespadln/wp-admin/admin.php?page=mainpage/index.php?month=<?php echo $month->nextMonth()->month; ?>&year=<?php echo $month->nextMonth()->year;?>"
                 class="btn-calendar">&gt;</a>
            
    </div>

    
<table class="calendar__table calendar__table--<?php echo $month->getWeeks(); ?>weeks">
    <?php
        for( $i =0 ; $i < $month->getWeeks(); $i++ ):  ?>
    <tr>
        <?php foreach($month->days as $k =>$day):
           $date = (clone $start)->modify("+" . ($k + $i * 7) . "days")
            ?>
        <td class ="<?php echo $month->withinMouth($date) ? '' : 'calendar__othermouth'; ?>">
           <?php if($i === 0): ?>
            <div class="calendar__weekday"><?php echo $day ;  ?></div>
            <?php endif; ?>
            <div class="calendar__day"><?php echo $date->format('d');?></div>
        </td>
        <?php endforeach; ?>
    </tr>
    <?php endfor; ?>
</table>
<?php }?>

<?php

function cal() 
{
    echo "page calendrier   ?";
}
function rdv()
{
    echo "page nouveau rdv ?";
}
function lieux()
{
    echo "page lieux ?";
}
function Fourniseurs()
{
    echo "page fourniseurs ?";
}
function Services()
{
    echo "page Services ?";
}
function Paramètres()
{
    echo "page Paramètres ?";
}
?>
