/**
 * WordPress dependencies
 */
import {
	useBlockProps,
} from '@wordpress/block-editor';

export default function save( { attributes } ) {
	const {items, id} = attributes;


	const getImg =(items)=> {
		    const itemsFiltered = (items && items.length) ? items.filter( (e)=>( e.url !== '' ))   : [];
			return (
				(itemsFiltered && itemsFiltered.length) ?
					itemsFiltered.map( (item)=>{
						return (
							<img alt={`image`} src={item.url} />
						)
					})
					: ''
			)
		};


	return (
			(items && items.length) ?
				<div id={`alexSliderItem-${id}`}  className={`alex-gutenberg-slick-slider_wrapper  alex-slider-item alex-slider-item-${id}`} { ...useBlockProps.save() } >
					<div className={`alex-gutenberg-slick-slider`} >
						<ul className={`slider-img`}>
							{getImg(items)}
						</ul>
						<ul className={`slider-nav`}>
							{getImg(items)}
						</ul>
					</div>
				</div>
				: ''
	);

}
