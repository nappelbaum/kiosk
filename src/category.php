<?php
    $thisCat = get_category( get_query_var('cat') );
    $catSlug = $thisCat->slug;
    $catName = $thisCat->name;
?>

<?php
    require_once 'parts/cat.php';
?>
