import ImageEdit from "./edit";

import {AddListItemBtn} from "../../assets/common-components/AddListItemBtn";


export default (data)=>{

	const content = <>
		<span>+</span><span>добавить изображение</span>
	</>;

	const addImg = ()=>{
		const item = {url: "" , alt: "" , caption:"" ,
			title: "",href: "",id: 0 , align: "" ,rel: "",
			linkClass: "",width: "",height: "",sizeSlug: "",
			linkDestination: "",linkTarget: ""};
		const allItems = [ ...data.attributes.items , item ];

		data.setAttributes( { items: [  ] } );

		setTimeout(()=>{
			data.setAttributes( { items: [ ...allItems ] } );
		}, 50);

	}

	return (

	<div   className={`alex-slick-slider-advanced-wrapper`}  >
		<ul>
		{
			(
				data.attributes.items &&
			data.attributes.items.length) ?
			data.attributes.items.map((e , i)=>{

				const setAttributesCustom = (dataObj)=>{
					const currentData =  {...data.attributes.items[i] , ...dataObj};
					const allItems = data.attributes.items;
					allItems[i] = currentData;
					data.setAttributes({items: [  ...allItems ] })
				}
				const removeImg = (index)=>{
					const allItems = data.attributes.items.filter( (e , i)=>{
						return i !== index;
					})
					data.setAttributes({items: [] });
					setTimeout(()=>{
						data.setAttributes({items: [ ...allItems ]  });
					}, 50 )

				}

				return (
						<li className={`slick-item`}>
							<span onClick={()=>removeImg(i)} title={`Удалить`} className={`remove-img`}><b>&times;</b></span>
							{ImageEdit({ ...data , attributes: data.attributes.items[i] , setAttributes: setAttributesCustom})}
						</li>
				)
			}) : ''
		}
			<li className={`add-img`} onClick={addImg}>
				<AddListItemBtn title={`Add image`} content={content}  cssClass={`add-img-btn`}/>
			</li>
		</ul>
	</div>
	)
}
