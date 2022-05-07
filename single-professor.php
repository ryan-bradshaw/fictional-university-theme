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

            <div class="generic-content">
                <div class="row group">
                    <div class="one-third">
                        <?php the_post_thumbnail(); ?>
                    </div>
                    <div class="two-thirds">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
            <hr class="section-break">
            <div>
                <?php
                
                $relatedPrograms = get_field('related_program');

                if($relatedPrograms){
                    echo '<h3 class="headline headline--medium"> Subject(s) Taught: </h3>';
                    echo '<ul class="link-list "min-list>';
                    foreach($relatedPrograms as $program){
                        ?>
                            <p>
                                <a href="<?php echo get_the_permalink($program); ?>"><?php echo get_the_title($program); ?></a>
                            </p>
                        <?php
                    }
                    echo '</ul>';
                }
                ?>
            </div>
        </div>
        <hr>
    <?php }

?>
<?php get_footer(); ?>