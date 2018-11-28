<?php
if ( function_exists('register_sidebar') )
    register_sidebar(array(
        'name' => 'Box-1', 
        'before_widget' => '<div class="box1"><div class="box1text">',
        'after_widget' => '</div></div><!--/widget-->',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => 'Box-2', 
        'before_widget' => '<div class="box2"><div class="box2text">',
        'after_widget' => '</div></div><!--/widget-->',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => 'Box-3', 
        'before_widget' => '<div class="box3"><div class="box3text">',
        'after_widget' => '</div></div><!--/widget-->',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));
 register_sidebar(array(
        'name' => 'Box-4', 
        'before_widget' => '<div class="box4"><div class="box4text">',
        'after_widget' => '</div></div><!--/widget-->',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));
 register_sidebar(array(
        'name' => 'Box-5', 
        'before_widget' => '<div class="box5"><div class="box5text">',
        'after_widget' => '</div></div><!--/widget-->',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));

?>