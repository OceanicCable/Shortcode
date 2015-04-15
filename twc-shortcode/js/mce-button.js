(function() {
	tinymce.PluginManager.add('twc_mce_button', function( editor, url ) {
		editor.addButton( 'twc_mce_button', {
			text: 'Insert CTA',
			icon: false,
			type: 'menubutton',
			menu: [
				{	// 
					text: 'Order Now Button',
						onclick: function() {
							editor.windowManager.open( {
								title: 'Insert TWC Link',
								body: [
									{
										type: 'listbox',
										name: 'ctype',
										label: 'Type',
										'values': [
											{text: 'Buy Flow', value: 'ebf'}
										]
									},
									{
										type: 'listbox',
										name: 'ctarget',
										label: 'Target',
										'values': [
											{text: 'Direct', value: 'direct'},
											{text: 'Modal Popup', value: 'modal'}
										]
									},
									{
										type: 'textbox',
										name: 'ctitle',
										label: 'Title',
										value: 'Order Now'
									},
									{
										type: 'textbox',
										name: 'iid',
										label: 'Campaign',
										value: ''
									},
									{
										type: 'listbox',
										name: 'button',
										label: 'Button',
										'values': [
											{text: 'Order Now', value: 'ordernow'},
											{text: 'Text Link', value: 'text'}
										]
									}
								],
								onsubmit: function( e ) {
									editor.insertContent( '[twc type="' + e.data.ctype + '" target="' + e.data.ctarget + '" title="' + e.data.ctitle + '" iid="' + e.data.iid + '" button="' + e.data.button + '"]');
								}
							});
					}
				}
			]
		});
	});
})();