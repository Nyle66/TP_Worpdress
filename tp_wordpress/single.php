<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package TP_Wordpress
 */

get_header(); 
$pop = get_option("custom_pop");
if(isset($pop["article"])){
	if($pop["article"] == 1){
		echo "<script>alert(\"POP-UP D'ARTICLE\")</script>";
	}
};
?>

<div class="cont">
            <?php
                // On appelle ici la liste des articles (donc 1 seul pour cette page)
                while( have_posts() ){
                    the_post(); // Sert à initialiser l'article en cours
					
                    $title = get_the_title();
					$categories = get_the_category();
					$tags = get_the_tags();
                }
            ?>
			
            <h1 class="title-article"> <?= $title ?> </h1>

			<?php echo get_the_post_thumbnail( $page->ID, 'thumbnail' ); ?>
			
				<?php get_template_part("template-parts/article") ?>
				

		</div>
		<div id="list">
		<div class="related-cats list-cont">
			<h3> Catégories associées : </h3>
				<?php
					foreach($categories as $category){ ?>
						<ul><li> <a href="<?= get_category_link($category->cat_ID) ?>"> <?= $category->name ?> </a> </li></ul>
					<?php } ?>
				
		</div>
						<?php if($tags != false){?>

						
		<div class="related-tags list-cont">
			<h3> Tags associés : </h3>
				<?php
					foreach($tags as $tag){ ?>
						<ul><li> <a href="<?= get_tag_link($tag->term_ID) ?>"> #<?= $tag->name ?> </a> </li></ul>
					<?php } ?>
				
		</div>
		<?php } ?>
		</div>
		<br><br>

<?php
get_sidebar();
get_footer();
