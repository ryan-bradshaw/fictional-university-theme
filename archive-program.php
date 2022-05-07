<?php
get_header();
?>

<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/ocean.jpg')?>);"></div>
        <div class="page-banner__content container container--narrow">
            <h1 class="page-banner__title"> All Programs </h1>
            <div class="page-banner__intro">
                <p>There's something for everyone - Have a look around!</p>
        </div>
    </div>
</div>

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