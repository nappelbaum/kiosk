<?php
/*
Template Name: home
*/
?>

<?php
  get_template_part( 'parts/header' );
  get_template_part( 'parts/nav' );
?>

    <section class="hero-banner">
      <div class="hero-banner__back"></div>
      <div class="container">
        <div class="hero-caption">
          <p class="hero-caption__subtitle"><?= CFS()->get('banner_subtitle') ?></p>
          <h1 class="hero-caption__title">
            <?= CFS()->get('banner_title') ?>
          </h1>
          <p class="hero-caption__caption">
            <?= CFS()->get('banner_caption') ?>
          </p>
          <a href="#works" class="hero-caption__btn">
            <span><?= CFS()->get('banner_btn_caption') ?></span>
          </a>
        </div>
      </div>
    </section>

    <section class="hero-banner-mob">
      <div class="container">
        <div class="hero-banner-mob__row">
          <div class="hero-banner-mob__hero-caption">
            <div class="hero-caption">
              <p class="hero-caption__subtitle"><?= CFS()->get('banner_subtitle') ?></p>
              <p class="hero-caption__title">
                <?= CFS()->get('banner_title') ?>
              </p>
              <p class="hero-caption__caption">
                <?= CFS()->get('banner_caption') ?>
              </p>
              <a href="#production" class="hero-caption__btn">
                <span><?= CFS()->get('banner_btn_caption') ?></span>
              </a>
            </div>
          </div>

          <div class="hero-banner-mob__slider">
            <img src="<?php bloginfo('template_url'); ?>/img/hero-banner/Mobgroup.png" alt="" />
          </div>
        </div>
      </div>
    </section>

    <section class="works" id="works">
      <div class="container">
        <h1>Наши Работы</h1>
        <div class="works__wrapper">
          
          <?php
          global $post;

          $myposts = get_posts([
            'numberposts' => 6,
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
                  <a href="<?php the_permalink(); ?>" class="works__caption"
                    ><span><?php the_title(); ?></span></a
                  >
                </div>
              <?php
            }
          }

          wp_reset_postdata();
          ?>
        </div>
      </div>
    </section>

    <section class="production" id="production">
      <div class="container">
        <div class="production__row">
          <div class="swiper production__slider">
            <div class="swiper-wrapper">

              <?php
                  $loop = CFS()->get('production_images');
                  if ( $loop ) {
                  foreach ($loop as $row) {
              ?>
                <div class="swiper-slide production__img">
                  <img src="<?= $row['production_image'] ?>" alt="" />
                </div>
              <?php
                }} else {
              ?>
                <div class="swiper-slide production__img">
                  <img src="<?php bloginfo('template_url'); ?>/img/slider/no-image.jpg" alt="" />
                </div>
              <?php
                }
              ?>
            </div>

            <?php
              if ( $loop && count($loop) > 1 ) {
            ?>
              <div class="slider-control">
                <div class="slider-control__left">
                  <img src="<?php bloginfo('template_url'); ?>/img/slider/leftArrow.svg" alt="" />
                </div>
                <div class="slider-control__center">
                  <div><span class="slider-control_active">1</span>/<?= count($loop) ?></div>
                </div>
                <div class="slider-control__right">
                  <img src="<?php bloginfo('template_url'); ?>/img/slider/rightArrow.svg" alt="" />
                </div>
              </div>
            <?php
              }
            ?>

            <ol class="slider-indicators">
              <?php
                  if ( $loop ) {
                  foreach ($loop as $row) {
              ?>
                <!-- <li class="active"><span></span></li> -->
                <li><span></span></li>
              <?php
                }}
              ?>
            </ol>
          </div>
          <div class="production__caption">
            <h1><?= CFS()->get('production_title') ?></h1>
            <div class="production__description">
              <?= CFS()->get('production_caption') ?>
            </div>
          </div>
        </div>
      </div>
    </section>

<?php
  get_template_part( 'parts/feedback' );
  get_template_part( 'parts/footer' );
?>
