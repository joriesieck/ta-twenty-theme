// add styling for custom blocks
wp.domReady(() => {
	wp.blocks.registerBlockStyle('gccustom/quote-box',[
		{
			name: 'default',
			label: 'Default',
			isDefault: true,
		},
		{
			name: 'gray',
			label: 'Gray',
		},
		{
			name: 'gray-green-button',
			label: 'Gray (Green Button)',
		},
		{
			name: 'gray-orange-button',
			label: 'Gray (Orange Button)',
		},
		{
			name: 'gray-black-button',
			label: 'Gray (Black Button)',
		}
	]);
	wp.blocks.registerBlockStyle('core/list',[
		{
			name: 'default',
			label: 'Default',
			isDefault: true,
		},
		{
			name: 'green-checks',
			label: 'Green Checks',
		},
		{
			name: 'red-checks',
			label: 'Red Checks',
		}
	]);
});
