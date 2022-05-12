<?php get_header(); ?>
<?php

    while(have_posts()){
        the_post(); 
        pageBanner();
        ?>


        <div class="container container--narrow page-section">

            <div class="generic-content">
                <div class="row group">
                    <div class="one-third">
                        <?php the_post_thumbnail('professorPortrait'); ?>
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