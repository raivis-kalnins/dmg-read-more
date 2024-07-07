import { RichText, useBlockProps } from '@wordpress/block-editor';
import classnames from 'classnames';

export default function save({ attributes }) {
	const { url, buttonText, linkTarget, rel, bootClass, bootSizesClass, bootAlign, bgColor, txtColor, borderColor, bSize } = attributes;
	const classNames = classnames( bootClass, bootAlign, bootSizesClass );
	return (
		<div {...useBlockProps.save()}>
			<RichText.Content tagName="a" className={ 'btn dmg-read-more ' + classNames }	value={ buttonText } target={ linkTarget } href={ url } rel={ rel } style={{backgroundColor: bgColor, color: txtColor, borderBottom: borderColor + ' solid ' + bSize + 'px'}}/>
		</div>
	);
};