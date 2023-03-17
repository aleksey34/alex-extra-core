import { useBlockProps  } from '@wordpress/blockEditor';
import { useEffect } from '@wordpress/element';


import { ListItem } from "./components/ListItem";
import { AddListItemBtn } from "../../assets/common-components/AddListItemBtn";

// import { Card, CardBody, CardMedia , CardHeader  , CardFooter } from '@wordpress/components';




// import {InspectorControls  , useBlockProps  } from '@wordpress/blockEditor';
// import {PanelBody , SelectControl} from "@wordpress/components";
// import {useEffect, useState} from '@wordpress/element';
//  import  { useBlockProps } from '@wordpress/block-editor';


// import { Panel, PanelBody, PanelRow } from '@wordpress/components';
// import { more } from '@wordpress/icons';

// import { Toolbar, ToolbarButton } from '@wordpress/components';
// import { formatBold, formatItalic, link } from '@wordpress/Icons';


// import { FormFileUpload } from '@wordpress/components';

/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
 // import { __ } from '@wordpress/i18n';

 /**
  * React hook that is used to mark the block wrapper element.
  * It provides all the necessary props like the class name.
  *
  * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
  */


 /**
  * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
  * Those files can contain any CSS code that gets applied to the editor.
  *
  * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
  */
 import './editor.scss';

 /**
  * The edit function describes the structure of your block in the context of the
  * editor. This represents what the editor will render when the block is used.
  *
  * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
  *
  * @return {WPElement} Element to render.
  */

    export default function Edit({attributes:{ links } , setAttributes}) {

	 useEffect( ()=>{
			 links = [...links];
	 }, [links]);

	 // const [ value, setValue ] = useState( '' );

	 const changeImg = (value, index)=>{
		 links[index] = value;
		 setAttributes({ links: links });
	 }

	 const removeImg = (index)=>{
    	const newLinks = links.filter((l , i)=>{
    		return  i !== index;
		 })
		 setAttributes({ links: newLinks });
	 }

	 const addImg = ()=>{
		 const newLinks = [ ...links , "" ];
		 setAttributes({ links: newLinks });
	 }

	const getImg = (links) =>{
    	return links.map((link , index )=>(<ListItem link={link} index={index} changeImg={changeImg} removeImg={removeImg}  />))
	}
	const content = <>
		<span>+</span><span>добавить изображение</span>
	</>;

     return (
		<div { ...useBlockProps() } className={`alex-slick-slider_editor`}>
			<h2 className={`alex-slick-slider-title`}>Slick Slider, добавьте изображения в слайдер.</h2>
			<span className={`alex-slick-slider-desc`}>Для корректной работы , размеры изображений должны быть одинаковые.</span>
			<ul>
				{ links.length ? getImg(links) : ''}
				<li className={`add-img`}  onClick={addImg}>
					<AddListItemBtn   title={`Добавить изображение`} content={content} cssClass={`add-img-btn`}  />
				</li>
			</ul>
		</div>
     );
 }
