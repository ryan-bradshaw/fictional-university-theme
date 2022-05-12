<?php get_header(); ?>
<?php

    while(have_posts()){
        the_post(); ?>

        <div class="page-banner">
            <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/ocean.jpg')?>);"></div>
                <div class="page-banner__content container container--narrow">
                <h1 class="page-banner__title"><?php the_title(); ?></h1>
                    <div class="page-banner__intro">
                    <p>Don't Forget to Replace me Later!!!!</p>
                </div>
            </div>
        </div>

        <div class="container container--narrow page-section">
            <div class="metabox metabox--position-up metabox--with-home-link">
                <p>
                    <a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('campus'); ?>"><i class="fa fa-home" aria-hidden="true"></i> All Campuses </a> 
                    <span class="metabox__main"><?php the_title(); ?></span>
                </p>
            </div>
            <div class="generic-content">
                <?php the_content(); ?>
            </div>
            <div class="acf-map">
                <?php $mapLocation = get_field('map_location'); ?>
                <div class="marker" data-lat="<?php echo $mapLocation['lat']; ?>" data-lng="<?php echo $mapLocation['lng']; ?>"> 
                    <h3>
                        <?php the_title(); ?>
                        <!-- map location not showing quite right yet -->
                    </h3>
                    <p><?php echo $mapLocation['address']; ?></p>
                </div>
            </div>
            

<!-- Custom Query for PROGRAMS post types -->
    <?php
    $relatedPrograms = new WP_Query(array(
                    'posts_per_page' => -1,
                    'post_type' => 'program',
                    'orderby' => 'title',
                    'order' => 'ASC',
                    'meta_query' => array(
                        array(
                            'key' => 'related_campus',
                            'compare' => 'LIKE',
                            'value' => '"' . get_the_ID('event') . '"'
                        ),
                    )
                ));

                if($relatedPrograms -> have_posts()){
                    echo '<hr class="section-break">';
                    echo '<h2 class="headline headline--small">' . get_the_title() . ' Programs </h2>';
                    echo '<ul class="min-list link-list">';

                    while($relatedPrograms -> have_posts()){
                        $relatedPrograms -> the_post(); ?>
                        <li>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </li>

                    <?php }
                    echo '</ul>';
                }
                wp_reset_postdata(); //ALWAYS USE THIS METHOD after using a CUSTOM query 
                ?>
<!-- end custom query PROGRAMS-->


    <?php } ?>
<?php get_footer(); ?>