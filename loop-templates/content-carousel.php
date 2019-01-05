<?php
$slides = array();
$args = array(
  'tag' => 'slide',
  'nopaging'=>true, '
  posts_per_page'=>10
);
$slider_query = new WP_Query( $args );
if ( $slider_query->have_posts() ) {
    while ( $slider_query->have_posts() ) {
        $slider_query->the_post();

        echo $slider_query->post->id;
        if(has_post_thumbnail()){
            $temp = array();
            $thumb_id = get_post_thumbnail_id();
            $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'full', true);
            $thumb_url = $thumb_url_array[0];
            $temp['title'] = get_the_title();
            $temp['excerpt'] = get_the_excerpt();
            $temp['image'] = $thumb_url;
            $slides[] = $temp;
        }
    }
}
wp_reset_postdata();
?>

<?php if(count($slides) > 0) { ?>

<div id="carouselHome" class="carousel slide" data-ride="carousel"  data-pause="" data-interval="7000" data-keyboard="true">

    <ol class="carousel-indicators">
        <?php for($i=0;$i<count($slides);$i++) {?>
        <li data-target="#carouselHome" data-slide-to="<?php echo $i ?>" <?php if($i==0) { ?>class="active"<?php } ?>></li>
        <?php } ?>
      </ol>

    <div class="carousel-inner" role="listbox">
        <?php $i=0; foreach($slides as $slide) { extract($slide); ?>
        <div class="carousel-item alignfull <?php if($i == 0) { ?>active<?php } ?>">
            <img src="<?php echo $image ?>" alt="<?php echo esc_attr($title); ?>">
            <div class="carousel-caption col-4">
              <h3><?php echo $title; ?></h3>
              <p><?php echo $excerpt;
              ?></p>
              <?php

              if( $link ):
                $link_url = $link['url'];
                $link_title = $link['title'];
                $link_target = $link['target'] ? $link['target'] : '_self';
                ?>
                <a class="carousel-button" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                <?php endif; ?>


            </div>
        </div>
        <?php $i++; } ?>
    </div>

    <a class="carousel-control-prev" href="#carouselHome" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselHome" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>

</div>

<?php } ?>
