<?php
  get_template_part( 'parts/header' );
  get_template_part( 'parts/nav' );
?>

<section class="categories">
    <div class="container">
        <?php wp_nav_menu(array(
            'theme_location'  => 'secondary',
            'menu' => 'Secondary Menu',
            'container'       => null,
        )); ?>
    </div>
</section>

<section class="works">
  <div class="container">
    <h1><?php echo $catName; ?></h1>
    <div class="works__wrapper">
        
        <?php
        global $post;

        $myposts = get_posts([
            'numberposts' => -1,
            'category_name' => $catSlug,
        ]);

        if( $myposts ){
            foreach( $myposts as $post ){
                setup_postdata( $post );
                $loop = CFS()->get('images');
                ?>
                <div class="works__work-block">
                    <a href="<?php the_permalink(); ?>" class="works__img">
                        <img src="<?php
                            if ( $loop ) {
                                echo $loop[0]['image'];
                            } else {
                                bloginfo('template_url'); ?>/img/slider/no-image.jpg
                            <?php
                                }
                            ?>" alt="" />
                    </a>
                    <a href="<?php the_permalink(); ?>" class="works__caption">
                        <span><?php the_title(); ?></span>
                    </a>
                </div>
                <?php
            }
        }

        wp_reset_postdata();
        ?>
    </div>
  </div>
</section>

<?php
  get_template_part( 'parts/feedback' );
  get_template_part( 'parts/footer' );
?>