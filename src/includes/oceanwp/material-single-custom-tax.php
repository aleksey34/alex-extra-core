<?php
/**
 * Add custom taxonomy in single material post type
 */

	add_filter('the_content',
		function ($content){
			$htmlTag = '';
			$htmlCat = '';
		if(class_exists('OCEANWP_Theme_Class')
		   &&  is_plugin_active('alex-extra-core/alex-extra-core.php')) {
			if ( ! is_archive() && get_post_type( get_the_ID() ) === 'material' ) {
				$taxonomyArray = get_taxonomies(['object_type' => [ 'material' ] ] , 'objects') ;

				$htmlCat = $htmlCat . '<div class="post-tags clr">';


				foreach ($taxonomyArray as $key => $taxonomy) :

					$termList = get_the_term_list( get_the_ID(), $key , '&nbsp;' ,',&nbsp;' , '&nbsp;&nbsp;&nbsp;' );

					if($termList) :
						if($taxonomy->hierarchical):
						$htmlCat     = $htmlCat .
						            '<strong  class="owp-tag-text">'.$taxonomy->label.': </strong>' .
						            $termList ;
						else:
							$htmlTag  = $htmlTag .
							            '<strong  class="owp-tag-text">'.$taxonomy->label.': </strong>' .
							            $termList ;
						endif;
					endif;

				endforeach;
				$htmlCat  = $htmlCat. '</div>';
			}

		}
		return $content. $htmlTag . $htmlCat ;

	}, 100);