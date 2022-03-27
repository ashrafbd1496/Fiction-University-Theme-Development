<?php get_header();

while (have_posts()) {
	the_post();?>

	<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg') ?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><?php the_title(); ?></h1>
      <div class="page-banner__intro">
        <p><?php echo __('Banner Intro Text goes here','funiversity'); ?></p>
      </div>
    </div>  
  </div>

    <div class="container container--narrow page-section">
    	<div class="metabox metabox--position-up metabox--with-home-link">
		      <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('program'); ?>"><i class="fa fa-home" aria-hidden="true"></i> <?php echo __('All Program','funiversity'); ?> </a> <span class="metabox__main"><?php the_title(); ?>
		      </span></p>
		    </div>

		<!--<h2><?php the_title(); ?></h2>-->
		<div class="generic-content">
			<?php the_content(); ?>
		</div>
		
	</div>
<?php } ?>


<?php get_footer(); ?>