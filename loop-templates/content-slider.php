<?php
$slides = array();
$args = array(
  'tag' => 'slide',
  'nopaging'=>true,
  'posts_per_page'=>5,
  'meta_key' => 'cta_link'
);
$slider_query = new WP_Query( $args );
if ( $slider_query->have_posts() ) {
    while ( $slider_query->have_posts() ) {
        $slider_query->the_post();
        $link = get_field('cta_link', $post_id);
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
        <?php for($i=0;$i<count($slides);$i++) { ?>
        <li data-target="#carouselHome" data-slide-to="<?php echo $i ?>" <?php if($i==0) { ?>class="active"<?php } ?>></li>
        <?php } ?>
    </ol>

    <div class="carousel-inner" role="listbox">
        <?php $i=0; foreach($slides as $slide) { extract($slide); ?>
        <div class="carousel-item alignfull <?php if($i == 0) { ?>active<?php } ?>">
            <img src="<?php echo $image ?>" alt="<?php echo esc_attr($title); ?>">
            <div class="carousel-caption col-4">
              <h3><?php echo $title; ?></h3>
              <p><?php echo $excerpt; ?></p>
              <?php
              if( $link ):
                $link_url = $link['url'];
                $link_title = $link['title'];
                $link_target = $link['target'] ? $link['target'] : '_self';
              ?>
                <a class="carousel-button .is-style-outline" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                <?php  endif; ?>
              <?php echo the_field('cta_link[1]'); ?>
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


<?php
/* SLIDER CUSTOM FIELD FOR HOMEPAGE */
$images = get_field('slider_photos');
$count=0;
$count1=0;

if($images) : ?>
<div id="slider">
    <div id="carousel" class="carousel slide">
      <!-- Indicators -->
      <ol class="carousel-indicators">
      	<?php foreach( $images as $image ): ?>
        <li data-target="#carousel" data-slide-to="<?php echo $count; ?>" <?php if($count==0) : ?>class="active"<?php endif; ?>></li>
        <?php
		$count++;
        endforeach; ?>
      </ol>

      <!-- Wrapper for slides -->
      <div class="carousel-inner">
      	<?php foreach( $images as $image ): ?>
            <div class="item<?php if($count1==0) : echo ' active'; endif; ?>">
                <img src="<?php echo $image['sizes']['slider-img']; ?>" alt="<?php echo $image['alt']; ?>" />
            </div><!-- item -->
        <?php
        $count1++;
        endforeach;
        ?>
      </div><!-- carousel inner -->
    </div><!-- #carousel -->
</div><!--#slider-->
