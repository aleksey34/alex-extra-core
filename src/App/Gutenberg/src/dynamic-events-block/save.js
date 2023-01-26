/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
//  import { useBlockProps } from '@wordpress/block-editor';

 /**
  * The save function defines the way in which the different attributes should
  * be combined into the final markup, which is then serialized by the block
  * editor into `post_content`.
  *
  * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#save
  *
  * @return {WPElement} Element to render.
  */
 export default function save() {
    // export default function save({attributes:{quantity}}) {
    return null;
    // all render in php fun -- this is dynamic block

    // const getItems = (quantity)=>{
    //    let result = [];
    //    for(let i = 1 ; i <= quantity; i++){
    //     result[i -1] = <li>item{i}</li>
    //    }
    //    return  result;
    // }

    // return (
    //     <>
    //        <p { ...useBlockProps.save() }>
    //          { `data quantity ====${quantity}==== save fun ` }
    //         </p>
    //         {
    //         quantity ? 
    //         <ul>
    //             {getItems(quantity)}          
    //         </ul> : '' 
    //         }
        
    //     </>
      
    //  );
 }
 