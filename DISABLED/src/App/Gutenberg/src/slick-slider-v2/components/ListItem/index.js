import {Card, CardBody, CardMedia, CardHeader, CardFooter, Placeholder} from '@wordpress/components';




const ListItem =  ({data}) => {

const { url , index , removeImg , changeImg} = data.attributes;

	const  alt = 'image';
	const  caption = 'caption';
	const  align = 'center';
	const  id = 0;
	const  width = '';
	const  height = '';
	const  sizeSlug = '';


const { setAttributes, attributes, isSelected, className, insertBlocksAfter, onReplace, context, clientId} = data;




	return (
		<li>
			<Card>
				<CardHeader>
					<label>
						<span>Вставьте ссылку на изображение</span>
						<input
							onChange={(event)=>{changeImg(event.target.value , index)}}
							type={`text`} value={ url } />
					</label>
				</CardHeader>
				<CardBody>
					<span onClick={()=>removeImg(index)} title={`Удалить`} className={`remove-img`}><b>&times;</b></span>
				</CardBody>
				{url ?
					<CardFooter>
						<CardMedia><img src={url} alt={`gallery img`} /> </CardMedia>
					</CardFooter>
					: ""}
			</Card>
		</li>
	);
}

export {  ListItem } ;
