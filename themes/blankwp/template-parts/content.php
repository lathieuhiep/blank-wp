<div class="container">
    <div class="row">
        <div class="col-12 col-sm-7 col-md-9">
            <?php
            if ( have_posts() ) :
                while ( have_posts() ) : the_post();
            ?>
                <div class="item">
                    <div class="img-post">
                        <?php the_post_thumbnail('large'); ?>
                    </div>

                    <h2 class="title-post">
                        <a href="<?php the_permalink(); ?>"><?php the_title() ?></a>
                    </h2>

                    <div class="content-post">
                        <?php
                        if (has_excerpt()) :
                            the_excerpt();
                        else :
                            the_content();
                        endif;
                        ?>
                    </div>
                </div>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
                get_template_part('template-parts/content', 'none');
            endif;

            the_posts_pagination();
            ?>
        </div>

        <div class="col-12 col-sm-5 col-md-3">
            <?php get_sidebar(); ?>
        </div>
    </div>
</div>