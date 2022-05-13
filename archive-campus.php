<?php
get_header();
pageBanner(array(
    'title' => 'Our Campuses',
    'subtitle' => 'We have two beautiful campuses in the heart of Manhattan'
));
?>

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