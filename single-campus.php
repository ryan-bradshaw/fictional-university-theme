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
<!-- end custom query -->

<!-- Custom Query to pull in EVENT Post types-->
        <?php
            $today = date('Ymd');
            $homePageEvents = new WP_Query(array(
                'posts_per_page' => -1,
                'post_type' => 'event',
                'meta_key' => 'event_date',
                'orderby' => 'meta_value_num',
                'order' => 'ASC',
                'meta_query' => array(
                    array(
                        'key' => 'event_date',
                        'compare' => '>=',
                        'value' => $today,
                        'type' => 'numeric'
                        ),
                    array(
                        'key' => 'related_program',
                        'compare' => 'LIKE',
                        'value' => '"' . get_the_ID('event') . '"'
                    )
                )
            ));

            if($homePageEvents -> have_posts()){
                echo '<hr class="section-break">';
                echo '<h2 class="headline headline--small"> Upcoming '. get_the_title() . ' Department Events </h2>';
    
                while($homePageEvents -> have_posts()){
                    $homePageEvents -> the_post(); ?>
    
                    <div class="event-summary">
                        <a class="event-summary__date t-center" href="#">
                            <span class="event-summary__month"><?php
                                $eventDate = new DateTime(get_field('event_date'));
                                echo $eventDate -> format('M');
                            ?></span>
                            <span class="event-summary__day"><?php
                                echo $eventDate -> format('d');
                            ?></span>
                        </a>
                        <div class="event-summary__content">
                            <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                            <p><?php if(has_excerpt()){
                                echo get_the_excerpt();
                            } else {
                                echo wp_trim_words(get_the_content(), 20);
                            }
                            ?> <a href="<?php the_permalink(); ?>" class="nu gray">Learn more</a></p>
                        </div>
                    </div>
    
                <?php } 
            }
            wp_reset_postdata(); //ALWAYS USE THIS METHOD after using a CUSTOM query ?>
<!-- end custom query -->

    <?php } ?>
<?php get_footer(); ?>