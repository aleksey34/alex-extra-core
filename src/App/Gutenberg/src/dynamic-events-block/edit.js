import {PanelBody , SelectControl} from "@wordpress/components";
import {InspectorControls  , useBlockProps } from '@wordpress/blockEditor';

import { useSelect } from "@wordpress/data";

import {date} from '@wordpress/date';

// import {useEffect, useState} from '@wordpress/element';

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
       
        let events = useSelect((select)=>{
            return  select('core')
                        .getEntityRecords('postType', 'post', {per_page: quantity});
                       
                        
        }, [quantity]) ;
   
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
           
            <div { ...useBlockProps() } style={{display:"flex", flexWrap:'wrap'}}>
            { events?.map((item)=>(
                <article style={{flex:"0 0 33%"}} className={`large-entry blog-entry clr`}>
                    <div className={`blog-entry-inner clr`}>
                        <div className={`thumbnail`}>
                            <a href={item.link}  >
                                <img src={item.featured_media_uri}  alt={item.title.rendered} />
                            </a>
                        </div>
                        <header>                    
                            <h2 className={`blog-entry-header`}>{item.title.rendered}</h2>
                            <ul className={`meta obem-default clr`} > 
                                <li className={`meta-author`}>{`${item.author_name}`}</li>
                                <li className={`meta-time`}>{`${date('j F , Y' ,item.date)}`}</li>
                                <li className={`meta-tag`}>
                                    {
                                    item.tags_data?.length && 
                                    <span>{`Tags:`}</span> 
                                    }
                                   
                                    {
                                
                                    item.tags_data?.map( (tag)=>(<div>
                                            
                                            <span>{tag.name}</span>
                                        </div>))
                                        
                                    
                                }</li>
                                <li className={`meta-cat`}>
                                
                                    {
                                    item.cats_data?.length && 
                                    <span>{`Categories:`}</span> 
                                    }

                                    {
                                        item.cats_data?.map((cat)=>(
                                            <div>
                                                
                                                <span>{cat.name}</span>
                                            </div>
                                        ))
                                    }
                                </li>
                                {
                                    item.comment_status === 'open' ?  

                                        ( item.comment_data?.total_comments > 0 ) ? 
                                     <li>          
                                         <span>Comments:</span>
                                         <span>{item.comment_data.total_comments}</span>                       
                                     </li>
                                     :
                                     <li>          
                                         <span>There are not  comments yet</span>                      
                                     </li>
                                     
                                    : 
                                    <li>
                                        <span>The comments are closed</span>
                                    </li>
                                }                    
                            </ul>
                        </header>

                        <div dangerouslySetInnerHTML={{__html:item.excerpt.rendered}} />
                        <div className={`blog-entry-readmore`}>
                            <a href={`${item.link}`} className={`btn button`}>Read more...</a>
                        </div>
                    </div>
                </article>
                    )) }
            </div>
        </>
      
     );
 }
 