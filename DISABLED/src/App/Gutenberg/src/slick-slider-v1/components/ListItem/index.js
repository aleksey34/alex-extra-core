import { Card, CardBody, CardMedia , CardHeader  , CardFooter } from '@wordpress/components';




// import { useBlockProps  } from '@wordpress/blockEditor';

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
// import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {WPElement} Element to render.
 */

const ListItem =  ({ link , index , removeImg , changeImg}) => {

	// { ...useBlockProps()}

	return (
		<li>
			<Card>
				<CardHeader>
					<label>
						<span>Вставьте ссылку на изображение</span>
						<input
							onChange={(event)=>{changeImg(event.target.value , index)}}
							type={`text`} value={ link } />
					</label>
				</CardHeader>
				<CardBody>
					<span onClick={()=>removeImg(index)} title={`Удалить`} className={`remove-img`}><b>&times;</b></span>
				</CardBody>
				<CardFooter>
					{link ? <CardMedia><img src={link} alt={`gallery img`} /> </CardMedia> : ""}
				</CardFooter>
			</Card>
		</li>
	);
}

export {  ListItem };
