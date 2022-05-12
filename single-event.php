<?php get_header();?>
<?php

    while(have_posts()){
        the_post();
        pageBanner();
        ?>

        <div class="container container--narrow page-section">
            <div class="metabox metabox--position-up metabox--with-home-link">
                <p>
                    <a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('event'); ?>"><i class="fa fa-home" aria-hidden="true"></i> Events Home</a> 
                    <span class="metabox__main"><?php the_title(); ?></span>
                </p>
            </div>
            <div class="generic-content">
                <?php the_content(); ?>
            </div>
            <hr class="section-break">
            <div>
                <?php
                
                $relatedPrograms = get_field('related_program');

                if($relatedPrograms){
                    echo '<h3 class="headline headline--medium"> Related Program(s): </h3>';
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