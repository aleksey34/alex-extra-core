import {PanelBody , SelectControl} from "@wordpress/components";
import {InspectorControls  , useBlockProps } from '@wordpress/blockEditor';


/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
 import { __ } from '@wordpress/i18n';

 /**
  * React hook that is used to mark the block wrapper element.
  * It provides all the necessary props like the class name.
  *
  * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
  */
//  import  { useBlockProps } from '@wordpress/block-editor';
 
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

    export default function Edit({attributes:{quantity} , setAttributes}) {
   
    const setQuantity = (newQuantity) => {
      
        setAttributes({ quantity: parseInt(newQuantity) });
    }



     return (
        <>
            <InspectorControls>
                <PanelBody>
                    <SelectControl
                        label="Количество событий в блоке"
                        value={ quantity }
                        options={ [
                            { label: '1', value: 1 },
                            { label: '2', value: 2 },
                            { label: '3', value: 3 },
                            { label: '4', value: 4 },
                            { label: '5', value: 5 },
                            { label: '6', value: 6 },
                        
                        ] }
                        onChange={ ( newQuantity ) => setQuantity( newQuantity ) }
                        // onChange={ ( newSize ) => setSize( newSize ) }
                        __nextHasNoMarginBottom
                    /> 
                </PanelBody>      
            </InspectorControls>
           
            <p { ...useBlockProps() }>
                { __(
                    'test editor TEST block is here test-block',
                    'guten-todo-list'
                ) }
            </p>
        </>
      
     );
 }
 