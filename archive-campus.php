<?php
get_header();
// pageBanner(array(
// ));
?>
<!-- update to dynamic page banner! -->
<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/ocean.jpg')?>);"></div>
        <div class="page-banner__content container container--narrow">
            <h1 class="page-banner__title"> Our Campuses </h1>
            <div class="page-banner__intro">
                <p>Our campuses are located all over. Find us near you!</p>
        </div>
    </div>
</div>

<div class="container container--narrow page-section">
    <div class="acf-map">
    <?php
        while(have_posts()){
            the_post();
            $mapLocation = get_field('map_location');
        ?>
            <div class="marker" 
                data-lat="<?php echo $mapLocation['lat']; ?>" 
                data-lng="<?php echo $mapLocation['lng']; ?>">
                <h3>
                    <a href ="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    <!-- map location not showing quite right yet -->
                </h3>
                <p><?php echo $mapLocation['address']; ?></p>
            </div>

        <?php } ?>
    </div>
    <hr clas="section-break">
    
</div>

<?php
get_footer();
?>