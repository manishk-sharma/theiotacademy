<?php get_header(); ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8">
			<h1 class="pt-2 no-margin"><?php echo the_title();?></h1>
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
			the_content();
			endwhile; else: ?>
			<p>Sorry, no posts matched your criteria.</p>
			<?php endif; ?>
			<?php
//for use in the loop, list 5 post titles related to first tag on current post
$tags = wp_get_post_tags($post->ID);
if ($tags) {
echo 'Related Posts';
$first_tag = $tags[0]->term_id;
$args=array(
'tag__in' => array($first_tag),
'post__not_in' => array($post->ID),
'posts_per_page'=>5,
'caller_get_posts'=>1
);
$my_query = new WP_Query($args);
if( $my_query->have_posts() ) {
while ($my_query->have_posts()) : $my_query->the_post(); ?>
<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
 
<?php
endwhile;
}
wp_reset_query();
}
?>
		</div>
		<?php comments_template(); ?>
	</div>
</div>
<?php get_footer(); ?>