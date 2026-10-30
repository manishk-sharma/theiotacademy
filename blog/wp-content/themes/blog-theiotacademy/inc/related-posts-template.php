<?php if (!empty($related_posts)) { ?>
    <div class="related-posts pb-4">
        <p class="main-head">Related Post</p>
        <div class="row">
            <?php
            foreach ($related_posts as $post) {
                setup_postdata($post);
            ?>
            <div class="col-sm-4">
				<div class="card">
                <a class="title" href="<?php the_permalink(); ?>" target="_blank">
                    <?php the_post_thumbnail(array(938,490)); ?>
                    <p class="rel_title py-2 px-2 h5"><?php the_title(); ?></p>
                </a>
				</div>
            </div>
            <?php } ?>
        </div>
        <div class="clearfix"></div>
    </div>
<?php
}