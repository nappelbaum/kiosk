<?php
/*
Template Name: delivery
*/
?>

<?php
  get_template_part( 'parts/header' );
  get_template_part( 'parts/nav' );
?>

<div class="temp">
  <div class="container">
    <h1>Доставка</h1>
    <section><?php echo the_title(); ?></section>
  </div>
</div>

<?php
  get_template_part( 'parts/feedback' );
  get_template_part( 'parts/footer' );
?>