<?php
/**
** WPR Template to render Section input
**/

    // not run if accessed directly
    if( ! defined("ABSPATH" ) )
        die("Not Allewed");

    $fm = new WPR_InputMeta($field_meta, 'section');
    
    
 ?>
 
        <h2 style="margin-top:10px;" class="fs-title"><?php echo $fm->title; ?></h2>
        <h3 class="fs-subtitle"><?php echo apply_filters('the_content', $fm->desc); ?></h3>