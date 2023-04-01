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
 export default function save({attributes:{ links}}) {


    const getImg = (links)=>{
    	return (
    		links.map( (link)=>{
    			return (
    				<li>
						<img alt={`gallery img`} src={link}  />
					</li>
				)
			})
		)
	}

    return (
        <div className={`alex-gutenberg-slick-slider_wrapper`} { ...useBlockProps.save() } >
			<div className={`alex-gutenberg-slick-slider`} >
				{
					links && links.length ?
						<>
							<ul className={`slider-img`}>
								{getImg(links)}
							</ul>
							<ul className={`slider-nav`}>
								{getImg(links)}
							</ul>
						</>
						: ''
				}
			</div>
        </div>
     );
 }
