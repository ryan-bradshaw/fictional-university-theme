<?php
get_header();
pageBanner(array(
    'title' => 'All Programs',
    'subtitle' => 'There is something for everyone - Have a look around!'
));
?>

<div class="container container--narrow page-section">
    <ul class="link-list min-list">
    <?php
        while(have_posts()){
            the_post();
        ?>
            <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
        <?php }
        wp_reset_postdata();
        $relatedCampus = get_field('related_campus');
        
        if ($relatedCampus){
            echo '<h3>' . get_the_title() . ' is available at these campuses: </h2>';
        }

    ?>
    </ul>
    <hr clas="section-break">
    
</div>

<?php
get_footer();
?>