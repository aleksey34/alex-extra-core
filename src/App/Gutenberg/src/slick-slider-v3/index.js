import { registerBlockType } from   "@wordpress/blocks";// = wp.blocks;
// import { withSelect } from   "@wordpress/data";   //=  // wp.data;


import metadata from './block.json';


import Edit from "./edit";
import save from "./save";



registerBlockType( metadata.name , {
	edit: Edit,
	save: save
});
