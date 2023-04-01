/**
 * External dependencies
 */
import classnames from 'classnames';

/**
 * WordPress dependencies
 */
import {
	RichText,
	useBlockProps,
	useInnerBlocksProps,
	__experimentalGetElementClassName,
} from '@wordpress/block-editor';

/**
 * Internal dependencies
 */
import saveWithoutInnerBlocks from './v1/save';
import { isGalleryV2Enabled } from './shared';

export default function saveWithInnerBlocks( { attributes } ) {
	if ( ! isGalleryV2Enabled() ) {
		return saveWithoutInnerBlocks( { attributes } );
	}

	const { caption, columns, imageCrop } = attributes;

	const className = classnames( 'has-nested-images', {
		[ `columns-${ columns }` ]: columns !== undefined,
		[ `columns-default` ]: columns === undefined,
		'is-cropped': imageCrop,
		'alex-slick-slider': true , 'alex-slick-slider-advanced-v2':true ,'alex-gutenberg-slick-slider':true
	} );
	const blockProps = useBlockProps.save( { className } );
	const innerBlocksProps = useInnerBlocksProps.save( blockProps );

	return (
		<figure { ...innerBlocksProps }>
			<div className={`slider-img`}>
				{ innerBlocksProps.children }
				{ ! RichText.isEmpty( caption ) && (
					<RichText.Content
						tagName="figcaption"
						className={ classnames(
							'blocks-gallery-caption',
							__experimentalGetElementClassName( 'caption' )
						) }
						value={ caption }
					/>
				) }
			</div>
			<div className={`slider-nav`}>
				{ innerBlocksProps.children }
				{ ! RichText.isEmpty( caption ) && (
					<RichText.Content
						tagName="figcaption"
						className={ classnames(
							'blocks-gallery-caption',
							__experimentalGetElementClassName( 'caption' )
						) }
						value={ caption }
					/>
				) }
			</div>
		</figure>
	);
}
