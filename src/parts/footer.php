<footer class="footer">
  <div class="container">
    <div class="footer__wrapper">
      <div class="footer__content">
        <div class="footer__customers">
          <h3>Покупателям</h3>

          <?php wp_nav_menu(array(
              'theme_location'  => 'secondary',
              'menu' => 'Secondary Menu',
              'container' => null,
              'items_wrap' => '%3$s',
          )); ?>

        </div>
        <div class="footer__about">
          <h3>О компании</h3>

          <?php wp_nav_menu(array(
              'theme_location'  => 'primary',
              'menu' => 'Primary Menu',
              'container'       => null,
              'items_wrap' => '%3$s',
            )); ?>

        </div>
      </div>
      <div class="footer__contacts">
        <h3>Контакты</h3>
        <div>
          <span>Телефон</span>
          <span><?php
            echo CFS()->get( 'phone', get_option( 'page_on_front' ) );
          ?></span>
        </div>
        <div>
          <span>Адрес</span>
          <span><?php
            echo CFS()->get( 'address', get_option( 'page_on_front' ) );
          ?></span>
        </div>
        <div>
          <span>E-mail</span>
          <span><?php
            echo CFS()->get( 'email', get_option( 'page_on_front' ) );
          ?></span>
        </div>
      </div>
    </div>
    <div class="footer__basement">
      <div class="footer__col-left">
        <p>&copy;&nbsp;2011-
          <script>
            document.write(new Date().getFullYear());
          </script>
          &nbsp;<?php
            echo CFS()->get( 'company', get_option( 'page_on_front' ) );
          ?></p>
        <a href="/">Политика конфиденциальности</a>
      </div>
      <div class="footer__col-right">
        <a href="/">
          <img class="logo" src="<?php bloginfo('template_url'); ?>/img/header/logo.svg" alt="logo" />
        </a>
      </div>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>

  </body>
</html>