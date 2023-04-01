/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
 import { useBlockProps } from '@wordpress/block-editor';

 /**
  * The save function defines the way in which the different attributes should
  * be combined into the final markup, which is then serialized by the block
  * editor into `post_content`.
  *
  * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#save
  *
  * @return {WPElement} Element to render.
  */
 export default function save({attributes:{ items }}) {


    const getImg = (items)=>{
    	return (
			items.map( (item)=>{
    			return (
    				<li>
						<img alt={`gallery img`} src={item.url}  />
					</li>
				)
			})
		)
	}

    return (
        <div className={`alex-gutenberg-slick-slider_wrapper`} { ...useBlockProps.save() } >
			<div className={`alex-gutenberg-slick-slider`} >
				{
					items && items.length ?
						<>
							<ul className={`slider-img`}>
								{getImg(items)}
							</ul>
							<ul className={`slider-nav`}>
								{getImg(items)}
							</ul>
						</>
						: ''
				}
			</div>
        </div>
     );
 }
