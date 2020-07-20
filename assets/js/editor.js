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
			name: 'gray-title',
			label: 'Gray (Title)',
		}
	]);
});
