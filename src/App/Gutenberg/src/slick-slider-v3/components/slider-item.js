import {Button, Card, CardBody, CardFooter, CardHeader} from "@wordpress/components";
import {MediaUpload, MediaUploadCheck} from "@wordpress/block-editor";
import {__} from "@wordpress/i18n";

const SliderItem = ({data:{removeImg,resetMedia,onSelectMedia , item , index}})=>{

	return (
		<Card className="alex-slick-slider-item">
			<CardHeader>
				<h5>
					Добавьте изображение из библиотеки или загрузите изображение или введите ссылку.
				</h5>
			</CardHeader>
			<CardBody>
				<input
					onInput={(event)=>{
						const media = {id:0 , url: event.target.value};
						onSelectMedia(media , index);
					}}
					style={{margin:"10px 0"}}
					value={item.url}
					type={`text`}
					placeholder={`ссылка на изображение.`} />
			{  item.url !== ""  ?
				<>
					<MediaUploadCheck>
						<MediaUpload
							title={__('Replace image', 'alex-theme')}
							value={item.id}
							onSelect={(media)=>{onSelectMedia(media , index)}}
							allowedTypes={['image']}
							render={({open}) => (
								<Button onClick={open} variant={`secondary`} isLarge>{__('Replace image', 'awp')}</Button>
							)}
						/>
					</MediaUploadCheck>
					<MediaUploadCheck>
						<Button onClick={()=>{resetMedia(index)} }isLink isDestructive>{__('Reset image', 'alex-theme')}</Button>
					</MediaUploadCheck>
				</>
				: ''
			}
			</CardBody>
			<CardFooter>
				<MediaUploadCheck>
					<MediaUpload
						onSelect={(media)=>{onSelectMedia(media , index )}}
						value={item.id}
						allowedTypes={ ['image'] }
						render={({open}) => (
							<Button
								className={item.id === 0 ? 'editor-post-featured-image__toggle' : 'editor-post-featured-image__preview'}
								onClick={open}
								style={{height: "auto"  , backgroundColor: "rgba( 0 , 0 , 0 , 0.1 )"}}
							>
								{ __('Choose an image', 'alex-theme')}
								{ item.url !== "" && <img alt={`image`} style={{width: "100%"}} src={item.url} /> }
							</Button>
						)}
					/>
				</MediaUploadCheck>
			</CardFooter>
			<span onClick={()=>removeImg(index)} title={`Удалить`} className={`remove-img`}><b>&times;</b></span>
		</Card>
	)
}
export default  SliderItem;
