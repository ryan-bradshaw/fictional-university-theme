<?php get_header(); ?>
<?php

    while(have_posts()){
        the_post();
        pageBanner();
        ?>


        <div class="container container--narrow page-section">
            <div class="metabox metabox--position-up metabox--with-home-link">
                <p>
                    <a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('program'); ?>"><i class="fa fa-home" aria-hidden="true"></i> All Programs </a> 
                    <span class="metabox__main"><?php the_title(); ?></span>
                </p>
            </div>
            <div class="generic-content">
                <?php the_content(); ?>
            </div>

<!-- Custom Query for PROFESSOR post types -->
    <?php
    $relatedProfessors = new WP_Query(array(
                    'posts_per_page' => -1,
                    'post_type' => 'professor',
                    'orderby' => 'title',
                    'order' => 'ASC',
                    'meta_query' => array(
                        array(
                            'key' => 'related_program',
                            'compare' => 'LIKE',
                            'value' => '"' . get_the_ID('event') . '"'
                        ),
                    )
                ));

                if($relatedProfessors -> have_posts()){
                    echo '<hr class="section-break">';
                    echo '<h2 class="headline headline--small">' . get_the_title() . ' Professors </h2>';
                    echo '<ul class="professor-cards">';

                    while($relatedProfessors -> have_posts()){
                        $relatedProfessors -> the_post(); ?>
                        <li class="professor-card__list-item">
                            <a class ="professor-card" href="<?php the_permalink(); ?>">
                                <img class="professor-card__image" src="<?php the_post_thumbnail_url('professorLandscape'); ?>">
                                <span class="professor-card__name"><?php the_title(); ?></span>
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
                    $homePageEvents -> the_post(); 
                    get_template_part('template-parts/content', get_post_type());
                    ?>

                <?php } 
            }
        wp_reset_postdata(); //ALWAYS USE THIS METHOD after using a CUSTOM query ?>
<!-- end custom query -->
    <?php 
        $relatedCampus = get_field('related_campus');

        if($relatedCampus){
            echo '<hr class="section-break">';
            echo '<h2 class="headline">' . get_the_title() . ' is available at these Campuses:</h2>';
            echo '<ul class="min-list link-list">';

            foreach($relatedCampus as $campus){
                ?><li><a href="<?php echo get_the_permalink($campus);?>"><?php echo get_the_title($campus); ?></a></li><?php
            }
            // permalink is sending to wrong page?
            echo '</ul>';
        }
    ?>

    <?php } ?>
<?php get_footer(); ?>