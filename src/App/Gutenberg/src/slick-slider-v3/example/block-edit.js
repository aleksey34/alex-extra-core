import  {  MediaUpload, MediaUploadCheck } from   "@wordpress/block-editor";// wp.blockEditor;
import {Button, Card, CardBody, CardHeader, ResponsiveWrapper} from "@wordpress/components"; // wp.components;
import  { __ } from   "@wordpress/i18n"  ;
import {AddListItemBtn} from "../../assets/common-components/AddListItemBtn";
import SliderItem from "./components/slider-item";


const BlockEdit = (props) => {
	const { attributes, setAttributes } = props;

	const removeImg = (index)=>{
		const newItems = attributes.items.filter( (el , i)=>(i !== index));
		setAttributes({
			items:newItems
		})
	}

	const resetMedia = (index) => {
		const newItems = [ ...attributes.items];
		newItems[index] = { mediaId:0 , mediaUrl:"" };
		setAttributes({
			items: newItems
		})
	}

	const onSelectMedia = (media , index) => {
		const newItems = [ ...attributes.items ] ;
		newItems[index]	= { mediaId: media.id  , mediaUrl: media.url }
		setAttributes({
			items: newItems
		})
	}

	const getCards = (items)=>{
		return (items && items.length ) ? items.map( (item , i )=>{
			return (
				<SliderItem data={{item, index:i , removeImg,resetMedia ,onSelectMedia}}/>
				// <Card className="alex-slick-slider-item">
				// 		{  item.mediaUrl !== ""    ?
				// 	<CardHeader>
				// 		<MediaUploadCheck>
				// 			<MediaUpload
				// 				title={__('Replace image', 'alex-theme')}
				// 				value={item.mediaId}
				// 				onSelect={(media)=>{onSelectMedia(media , i)}}
				// 				allowedTypes={['image']}
				// 				render={({open}) => (
				// 					<Button onClick={open}  variant={`secondary`} isLarge>{__('Replace image', 'awp')}</Button>
				// 				)}
				// 			/>
				// 		</MediaUploadCheck>
				// 		<MediaUploadCheck>
				// 			<Button onClick={()=>{resetMedia(i)} }isLink isDestructive>{__('Reset image', 'alex-theme')}</Button>
				// 		</MediaUploadCheck>
				// 	</CardHeader>
				// 		: ''
				// 		}
				// 	<CardBody>
				// 		<MediaUploadCheck>
				// 			<MediaUpload
				// 				onSelect={(media)=>{onSelectMedia(media , i )}}
				// 				value={item.mediaId}
				// 				allowedTypes={ ['image'] }
				// 				render={({open}) => (
				// 					<Button
				// 						className={item.mediaId === 0 ? 'editor-post-featured-image__toggle' : 'editor-post-featured-image__preview'}
				// 						onClick={open}
				// 						style={{backgroundColor:"rgba(0 , 0 , 0 , 0.1)"}}
				// 					>
				// 						{ __('Choose an image', 'alex-theme')}
				// 						{ item.mediaUrl !== "" && <img style={{width: "100%"}} src={item.mediaUrl} /> }
				// 					</Button>
				// 				)}
				// 			/>
				// 		</MediaUploadCheck>
				// 	</CardBody>
				// 	<span onClick={()=>removeImg(i)} title={`Удалить`} className={`remove-img`}><b>&times;</b></span>
				// </Card>
			)
		}) : ''
	}

	const addImg  = ()=>{
		const newItem = {mediaId:0,mediaUrl:""};
		setAttributes({
			items: [...attributes.items , newItem]
		})
	}

	const content = <>
		<span>+</span>
		<span>добавить изображение</span>
	</>;


	return (
		<div className={`alex-slick-slider`}>
			{getCards(attributes.items)}
			<div  className={`add-img`}  onClick={addImg}>
				<AddListItemBtn   title={`Добавить изображение`} content={content} cssClass={`add-img-btn`}  />
			</div>
		</div>
	);
};
export default BlockEdit;
