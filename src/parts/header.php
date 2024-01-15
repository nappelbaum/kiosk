<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kiosk</title>

    <?php wp_head(); ?>

  </head>
  <body>
  <header class="header">
    <div class="container">
      <div class="header__wrapper">
        <a href="/" class="header__logo-wrapper">
          <img class="logo" src="<?php bloginfo('template_url'); ?>/img/header/logo.svg" alt="logo" />
        </a>

      <div class="header__table">
        <div class="header__nav-row">
          <ul class="header__nav-col-1">
            <li class="header__products">
              <div class="header__product-btn" id="button_1025">
                <span>Продукция</span>
                <img src="<?php bloginfo('template_url'); ?>/img/header/polygon.svg" alt="" />
              </div>

              <?php wp_nav_menu(array(
                  'theme_location'  => 'secondary',
                  'menu' => 'Secondary Menu',
                  'container' => null,
                  'menu_class' => 'header__products-list visually-hidden',
              )); ?>

            </li>

            <?php wp_nav_menu(array(
              'theme_location'  => 'primary',
              'menu' => 'Primary Menu',
              'container'       => null,
              'items_wrap' => '%3$s',
            )); ?>

          </ul>
          <ul class="header__nav-col-2">
            <li class="header__phone">
              <?php
                function replace_phone_call($matches)
                  {
                    $tel = str_replace(array('-', ' ', '(' , ')'), '', $matches[0]);
                    return '<a href="tel:' . $tel . '">' . $matches[0] . '</a>';
                  }
                 
                function replace_phone($text)
                  {
                    return preg_replace_callback('/(?:\+|\d)[\d\-\(\) ]{9,}\d/', 'replace_phone_call', $text);
                  }
                 
                $text = CFS()->get( 'phone', get_option( 'page_on_front' ) );
                echo replace_phone($text);
              ?>
            </li>
            <li class="header__city">
              <img src="<?php bloginfo('template_url'); ?>/img/header/city.svg" alt="" />
              <a href="">Город <?php
                echo CFS()->get( 'city', get_option( 'page_on_front' ) );
              ?></a>
            </li>
            <li class="header__email">
              <img src="<?php bloginfo('template_url'); ?>/img/header/email.svg" alt="" />
              <a href="mailto:<?php echo CFS()->get( 'email', get_option( 'page_on_front' ) ); ?>">
              <?php
                echo CFS()->get( 'email', get_option( 'page_on_front' ) );
              ?></a>
            </li>
          </ul>
          <div class="header__nav-col-3-pl">
            <span>Связаться</span>
          </div>
        </div>
        <div class="header__search-row">
          <div class="header__input">
            <input type="text" placeholder="Поиск по сайту" />
          </div>
          <a class="header__telegram">
            <img src="<?php bloginfo('template_url'); ?>/img/header/telegram.svg" alt="" />
          </a>
          <a class="header__whatsapp">
            <img src="<?php bloginfo('template_url'); ?>/img/header/whatsapp.svg" alt="" />
          </a>
          <button class="header__call">
            <span>Заказать звонок</span>
          </button>
        </div>
      </div>

      <div class="header__burger">
        <span></span>
      </div>

      <ul class="header__mob-menu-list visually-hidden">
        <li class="header__products">
          <div class="header__product-btn" id="button_650">
            <span>Продукция</span>
            <img src="<?php bloginfo('template_url'); ?>/img/header/polygon.svg" alt="" />
          </div>

          <?php wp_nav_menu(array(
              'theme_location'  => 'secondary',
              'menu' => 'Secondary Menu',
              'container' => null,
              'menu_class' => 'header__products-list products-list_650 visually-hidden',
          )); ?>

        </li>

        <?php wp_nav_menu(array(
          'theme_location'  => 'primary',
          'menu' => 'Primary Menu',
          'container'       => null,
          'items_wrap' => '%3$s',
        )); ?>

      </ul>

      <div class="header__overlay visually-hidden"></div>
    </div>
  </div>
</header>