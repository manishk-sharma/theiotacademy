<?php
$slides = array(); 
$args = array( 'tag' => 'slide', 'nopaging'=>true, 'posts_per_page'=>5 );
$slider_query = new WP_Query( $args );
if ( $slider_query->have_posts() ) {
    while ( $slider_query->have_posts() ) {
        $slider_query->the_post();
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

<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
    
    <ol class="carousel-indicators">
        <?php for($i=0;$i<count($slides);$i++) { ?>
        <li data-target="#carousel-example-generic" data-slide-to="<?php echo $i ?>" <?php if($i==0) { ?>class="active"<?php } ?>></li>
        <?php } ?>
    </ol>

    <div class="carousel-inner" role="listbox">
        <?php $i=0; foreach($slides as $slide) { extract($slide); ?>
        <div class="item <?php if($i == 0) { ?>active<?php } ?>">
            <img src="<?php echo $image ?>" alt="<?php echo esc_attr($title); ?>">
            <div class="carousel-caption"><h3><?php echo $title; ?></h3><p><?php echo $excerpt; ?></p></div>
        </div>
        <?php $i++; } ?>
    </div>

    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span><span class="sr-only">Previous</span></a>
    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span><span class="sr-only">Next</span></a>

</div>

<?php } ?>