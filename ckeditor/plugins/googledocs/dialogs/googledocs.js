CKEDITOR.dialog.add('googledocs', function (editor) {

	function onChangeSrc() {
		return true;
	}

	var hasFileBrowser = !!( editor.config.filebrowserImageBrowseUrl || editor.config.filebrowserBrowseUrl ),
		srcBoxChildren = [
			{
	            type: 'text',
				id: 'txtUrl',
	            label: editor.lang.googledocs.url,
	            required: true,
				onChange: onChangeSrc,
	            validate: CKEDITOR.dialog.validate.notEmpty( editor.lang.googledocs.alertUrl )
			}
		];

/* Comment by Mai Minh : Can phai chinh lai, phan browse co loi
	if ( hasFileBrowser ) {
		srcBoxChildren.push( {
			type: 'button',
			id: 'browse',
			style: 'display:inline-block;margin-top:16px;',
			align: 'center',
			label: editor.lang.common.browseServer,
			hidden: true,
			filebrowser: 'settingsTab:txtUrl'
		} );
	} */

  return {
    title: editor.lang.googledocs.title,
    width: 400,
    height: 350,

    onLoad : function() {
      getDocuments();
    },

    contents:
    [
      //  document settings tab
      {
        id: 'settingsTab',
        label: editor.lang.googledocs.settingsTab,
        elements:
        [
          //  select
          {
            type: 'select',
            id: 'documents',
            className: 'googledocs',
            label: editor.lang.googledocs.selectDocument,
            items: [],
            'default': '',
            size: 4,
            onChange: function( api ) {
              var dialog = CKEDITOR.dialog.getCurrent();
              var url = dialog.getContentElement('settingsTab', 'txtUrl');
              url.setValue( this.getValue() );
            }
          },
          //  url
          {
			type: 'vbox',
			padding: 0,
			children: [
				{
					type: 'hbox',
					widths: [ '100%' ],
					children: srcBoxChildren
				}
			]
          },
          //  options
          {
            type: 'hbox',
            widths: [ '60px', '330px' ],
            className: 'googledocs',
            children:
            [
              //  width
              {
                type: 'text',
                width: '45px',
                id: 'txtWidth',
                label: editor.lang.common.width,
                'default': 710,
                required: true,
                validate: CKEDITOR.dialog.validate.integer( editor.lang.googledocs.alertWidth )
              },
              //  height
              {
                type: 'text',
                id: 'txtHeight',
                width: '45px',
                label: editor.lang.common.height,
                'default': 920,
                required: true,
                validate: CKEDITOR.dialog.validate.integer( editor.lang.googledocs.alertHeight )
              }
            ]
          }
        ]
      },
      //  upload tab
      {
        id: 'uploadTab',
        label: editor.lang.googledocs.uploadTab,
        filebrowser: 'uploadButton',
        elements:
        [
          //  file input
          {
            type: 'file',
            id: 'upload'
          },
          //  submit button
          {
            type: 'fileButton',
            id: 'uploadButton',
            label: editor.lang.googledocs.btnUpload,
            filebrowser: {
              action: 'QuickUpload',
              target: 'settingsTab:txtUrl',
              onSelect: function( fileUrl, data ) {
                getDocuments( fileUrl );
              }
            },
            'for': [ 'uploadTab', 'upload' ]
          }
        ]
      }
    ],
    onOk: function() {
		var dialog = this;
		var iframe = editor.document.createElement( 'iframe' );
		var txtUrl = dialog.getValueOf( 'settingsTab', 'txtUrl' );
		var regexp = /(ftp|http|https):\/\//;
		if( ! regexp.test( txtUrl ) ) {
			txtUrl = window.location.protocol + '//' + window.location.host + txtUrl;
		}
		var srcEncoded = encodeURIComponent( txtUrl );

		iframe.setAttribute( 'src',     'http://docs.google.com/viewer?url=' + srcEncoded + '&embedded=true' );
		iframe.setAttribute( 'width',   dialog.getValueOf( 'settingsTab', 'txtWidth' ) );
		iframe.setAttribute( 'height',  dialog.getValueOf( 'settingsTab', 'txtHeight' ) );
		iframe.setAttribute( 'style',   'border: none;' );
		editor.insertElement( iframe );
    }
  };
});

//  get documents list in format [[document1_name, document1_url],[document2_name, document2_url], ...]
var getDocuments = function( url ) {
  if( CKEDITOR.env.ie7Compat ) {
    fixIE7display();
  }
  $.get( CKEDITOR.currentInstance.config.filebrowserGoogledocsBrowseUrl, function( data ) {
    var dialog = CKEDITOR.dialog.getCurrent();
    var documents = dialog.getContentElement('settingsTab', 'documents');
    documents.clear();
    $.each( data, function( index, document ) {
      documents.add( document.name, document.url );
    });
    documents.setValue( url );
    console.log( url );
    url && documents.focus();
  }, "json" );
};