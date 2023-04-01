import edit from "./edit-wrapper";

const EditCustomWrapper = (props)=>(
	<>
		<div style={ {  textAlign: "center" , padding: "10px"  } }>
			<h4 style={ { fontSize:"24px", textAlign: "center" , padding: "15px"  } }>
				Slider.
			</h4>
			<span>Slider based on slick slider js lib and default gallery block</span>
		</div>
		{edit(props)}
	</>
)
export default EditCustomWrapper;
