CKEDITOR.plugins.add("doksoft_rehost_image",{lang:["en","ru"],init:function(a){if(typeof a.lang.doksoft_rehost_image.doksoft_rehost_image!="undefined"){a.lang.doksoft_rehost_image=a.lang.doksoft_rehost_image.doksoft_rehost_image;}var b=a.addCommand("doksoft_rehost_image",new CKEDITOR.dialogCommand("doksoft_rehost_image"));b.modes={wysiwyg:1,source:0};b.canUndo=true;if(CKEDITOR.version.charAt(0)=="4"){a.ui.addButton("doksoft_rehost_image",{label:a.lang.doksoft_rehost_image.button_label,command:"doksoft_rehost_image",icon:this.path+"doksoft_rehost_image_4.png"});}else{a.ui.addButton("doksoft_rehost_image",{label:a.lang.doksoft_rehost_image.button_label,command:"doksoft_rehost_image",icon:this.path+"doksoft_rehost_image.png"});}CKEDITOR.dialog.add("doksoft_rehost_image",this.path+"dialogs/dlg_upload.js");}});