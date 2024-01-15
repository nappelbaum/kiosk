<?php
  get_template_part( 'parts/header' );
  get_template_part( 'parts/nav' );
?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<?php endwhile; ?>
<?php endif; ?>

<section class="item">
  <div class="container">
    <div class="item__top-wrapper">
      <div class="item__swiper-container">
        <div class="swiper item__slider">
          <div class="swiper-wrapper">
            <?php
                $loop = CFS()->get('images');
                if ( $loop ) {
                foreach ($loop as $row) {
            ?>
              <div
                class="swiper-slide item__img"
                data-fancybox="gallery"
                data-src="<?= $row['image'] ?>"
              >
                <img src="<?= $row['image'] ?>" alt="" />
              </div>
            <?php
              }} else {
            ?>
              <div class="swiper-slide item__img">
                <img src="<?php bloginfo('template_url'); ?>/img/slider/no-image.jpg" alt="" />
              </div>
            <?php
              }
            ?>
          </div>
          <div class="swiper-button-prev">
            <img src="<?php bloginfo('template_url'); ?>/img/slider/leftArrowItem.svg" alt="" />
          </div>
          <div class="swiper-button-next">
            <img src="<?php bloginfo('template_url'); ?>/img/slider/rightArrowItem.svg" alt="" />
          </div>
        </div>

        <div class="swiper swiper_thumbnail">
          <div class="swiper-wrapper">
            <?php
                if ( $loop ) {
                foreach ($loop as $row) {
            ?>
              <div class="swiper-slide">
                <img src="<?= $row['image'] ?>" />
              </div>
            <?php
              }}
            ?>
          </div>
        </div>
      </div>

      <div class="item__content">
        <div class="item__subtitle"><?php the_category(', '); ?></div>
        <h1 class="item__title">
          <?php the_title(); ?>
        </h1>
        <div class="item__article"><?= CFS()->get('vendor') ?></div>
        <div class="item__description">
          <span>Описание:</span>
          <?= CFS()->get('description') ?>
        </div>
        <div class="item__cost"><?= CFS()->get('cost') ?> ₽</div>
        <div class="item__btn">
          <span>Заявка на расчёт стенда</span>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="info">
  <div class="container">
    <nav class="info__nav">
      <div class="info__nav-btn active" tabindex="0">
        <span>О модели</span>
      </div>
      <div class="info__nav-btn" tabindex="0">
        <span>Характеристики</span>
      </div>
      <div class="info__nav-btn" tabindex="0">
        <span>Как заказать?</span>
      </div>
      <div class="info__nav-btn" tabindex="0">
        <span>Доставка</span>
      </div>
    </nav>

    <article class="info__content">
      <p class="info__paragraph active">
        <?= CFS()->get('about') ?>
      </p>
      <p class="info__paragraph">
        <?= CFS()->get('features') ?>
      </p>
      <p class="info__paragraph">
        <?= CFS()->get('order') ?>
      </p>
      <p class="info__paragraph">
        <?= CFS()->get('delivery') ?>
      </p>
    </article>
  </div>
</section>

<?php
  get_template_part( 'parts/feedback' );
  get_template_part( 'parts/footer' );
?>