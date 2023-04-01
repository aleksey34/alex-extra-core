import {AddListItemBtn} from "./components/AddListItemBtn";
import SliderItem from "./components/slider-item";
import { InspectorControls } from   "@wordpress/block-editor";
import { PanelBody , SelectControl}  from "@wordpress/components";
import {__} from "@wordpress/i18n";
import { ContentTypes } from "./variables/slider-type-options";

import './editor.scss';

const Edit = ( { attributes, setAttributes } ) => {

	const removeImg = (index)=>{
		const newItems = attributes.items.filter( (el , i)=>( i !== index ) );
		setAttributes( {
			items:newItems
		} )
	}

	const resetMedia = (index) => {
		const newItems = [ ...attributes.items];
		newItems[index] = { id:0 , url:"" };
		setAttributes({
			items: newItems
		})
	}

	const onSelectMedia = (media , index) => {
		const newItems = [ ...attributes.items ] ;
		newItems[index]	= { id: media.id  , url: media.url }
		setAttributes({
			items: newItems
		})
	}

	const getCards = (items)=>{
		return (items && items.length ) ? items.map( (item , i )=>{
			return <SliderItem data={{ item, index: i , removeImg , resetMedia , onSelectMedia }}/>
		}) : ''
	}

	const addImg  = ()=>{
		const newItem = {id:0,url:""};
		setAttributes({
			items: [...attributes.items , newItem]
		})
	}

	const content = <>
		<span>+</span>
		<span>добавить изображение</span>
	</>;

	return (
		<>
			<InspectorControls>
				<PanelBody
					title={__('Select type of the slider', 'alex-theme')}
					initialOpen={ true }
				>
					<SelectControl
						label="Slider Type"
						value={ attributes.contentType }
						options={ ContentTypes }
						onChange={ ( newValue ) => { setAttributes( { contentType: newValue } )  } }
						__nextHasNoMarginBottom
					/>
				</PanelBody>
			</InspectorControls>
			<div style={{textAlign:'center', padding: "30px 15px 15px 15px"}}>
				<h3>
					Slider - based on slick slider js lib , OR custom gallery (develop)
					<br/>
					<span>It has options - sliders or gallery(develop)</span>
				</h3>
			</div>
			<div className={` alex-slick-slider-v3  alex-slick-slider `}>
				{getCards(attributes.items)}
				<div  className={`add-img`}  onClick={addImg}>
					<AddListItemBtn   title={`Добавить изображение`} content={content} cssClass={`add-img-btn`}  />
				</div>
			</div>
		</>
	);
};
export default Edit;
