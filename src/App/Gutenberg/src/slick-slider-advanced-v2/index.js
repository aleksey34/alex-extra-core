/**
 * Registers a new block provided a unique name and an object defining its behavior.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-registration/
 */
 import { registerBlockType } from '@wordpress/blocks';

 /**
  * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
  * All files containing `style` keyword are bundled together. The code used
  * gets applied both to the front of your site and to the editor.
  *
  * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
  */
 // import './style.scss';

import transforms from './transforms';


import deprecated from './deprecated';


 /**
  * Internal dependencies
  */
import edit from './edit-custom-wrapper';

 import save from './save';
 import metadata from './block.json';


/**
 * WordPress dependencies
 */
import { gallery as icon } from '@wordpress/icons';
import CustomTitle from "./custom-title";

 /**
  * Every block starts by registering a new block type definition.
  *
  * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-registration/
  */

	registerBlockType( metadata.name, {
		icon,
		example: {
			attributes: {
				columns: 2,
			},
			innerBlocks: [
				{
					name: 'core/image',
					attributes: {
						url: 'https://s.w.org/images/core/5.3/Glacial_lakes%2C_Bhutan.jpg',
					},
				},
				{
					name: 'core/image',
					attributes: {
						url: 'https://s.w.org/images/core/5.3/Sediment_off_the_Yucatan_Peninsula.jpg',
					},
				},
			],
		},
		transforms ,
		/**
		 * @see ./edit.js
		 */
		edit,

		/**
		 * @see ./save.js
		 */
		save, // ()=>{return <div>this is save function</div>} ,
		deprecated
	} )
