<?php
/**
 * Template Name: Home Page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package _tk
 */

get_header(); ?>
<?php get_template_part('home','search'); ?>
<?php get_template_part('home','featured'); ?>
<?php get_template_part('home','info'); ?>
<!-- footer -->
<?php get_footer(); ?>
