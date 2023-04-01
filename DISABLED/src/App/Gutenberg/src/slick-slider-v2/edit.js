import { useBlockProps  } from '@wordpress/block-editor';
import {useEffect} from '@wordpress/element';

import { ListItem } from "./components/ListItem";
import { AddListItemBtn } from "../../assets/common-components/AddListItemBtn";

import './editor.scss';



const Edit = ( prop )=>{

	const { setAttributes , attributes } = prop;
	let items = attributes.items;

	useEffect( ()=>{
		items = [...items];
	}, [items]);



	const changeImg = (value, index)=>{
		items[index].url = value;
		setAttributes({ items: items });
	}

	const removeImg = (index)=>{
		const newItems = items.filter((el , i)=>{
			return  i !== index;
		})
		setAttributes({ items: newItems });
	}

	const addImg = ()=>{
		const newItem = {url:""}
		const newItems = [ ...items , newItem ];
		setAttributes({ items: newItems });
	}

	const getImg = (items) =>{

		return items.map((item , index )=>(
			<ListItem
				data={
					{...prop ,
						attributes: {...prop.attributes ,id: item.id , url: item.url , index , changeImg , removeImg }
					}
				}
			/>))
	}
	const content = <>
		<span>+</span>
		<span>добавить изображение</span>
	</>;

	return (
		<div { ...useBlockProps() } className={`alex-slick-slider_editor`}>
			<h2 className={`alex-slick-slider-title`}>Slick Slider, добавьте изображения в слайдер.</h2>
			<span className={`alex-slick-slider-desc`}>Для корректной работы , размеры изображений должны быть одинаковые.</span>
			<ul>
				{ items.length ? getImg(items) : ''}
				<li className={`add-img`}  onClick={addImg}>
					<AddListItemBtn   title={`Добавить изображение`} content={content} cssClass={`add-img-btn`}  />
				</li>
			</ul>
		</div>
	);
}

export default Edit;
