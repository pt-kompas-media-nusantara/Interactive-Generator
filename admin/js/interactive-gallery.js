Vue.config.devtools = true
'use strict';

new Vue({
    el: "#gallery",
    data() {
        return {
					forms: [{ value: '' }],
					showResult: false,
					valUrl: [],
					valCredit: [],
					valTitle: [],
					valText: [],
					valInputButton: [],
					valInputButtonLabel: [],
					layoutFormat: 'top-to-bottom'
        }
    },
    methods: {
			addForm() {
				this.forms.push({ value: '' });
			},
		galleryOpenMedia(idx) {
			var file_frame;
			file_frame = wp.media.frames.file_frame = wp.media({
				title: 'Pilih gambar untuk di upload',
				button: {
					text: 'Gunakan gambar ini',
				},
				multiple: false // Set to true to allow multiple files to be selected
			});
			file_frame.on( 'select', function() {
				var attachment = file_frame.state().get('selection').first().toJSON();
				document.getElementsByClassName('gallery-img-picked')[idx-1].style.display = 'block'
				document.getElementsByClassName('gallery-img-picked')[idx-1].src = attachment.url
				document.getElementsByClassName('inputUrl')[idx-1].value = attachment.url
			});
			file_frame.open();
		},
		getInput(){
			this.valUrl = []
			this.valCredit = []
			this.valTitle = []
			this.valText = []
			this.valInputButton = []
            this.valInputButtonLabel = []
			for(var i=0;i<document.getElementsByClassName('inputUrl').length;i++){
				this.valUrl.push(document.getElementsByClassName('inputUrl')[i].value);
			}
			for(var i=0;i<document.getElementsByClassName('inputCredit').length;i++){
				this.valCredit.push(document.getElementsByClassName('inputCredit')[i].value);
			}
			for(var i=0;i<document.getElementsByClassName('inputTitle').length;i++){
				this.valTitle.push(document.getElementsByClassName('inputTitle')[i].value);
			}
			for(var i=0;i<document.getElementsByClassName('inputText').length;i++){
				this.valText.push(document.getElementsByClassName('inputText')[i].value);
			}
			for(var i=0;i<document.getElementsByClassName('inputButton').length;i++){
				this.valInputButton.push(document.getElementsByClassName('inputButton')[i].value);
			}
			for(var i=0;i<document.getElementsByClassName('inputButton').length;i++){
				this.valInputButton.push(document.getElementsByClassName('inputButton')[i].value);
			}
			for(var i=0;i<document.getElementsByClassName('inputButtonLabel').length;i++){
				this.valInputButtonLabel.push(document.getElementsByClassName('inputButtonLabel')[i].value);
			}
		},
		createShortCode(){
			this.showResult = true;
			this.getInput();
			var data = '',
                idGallery = this.$refs.inputId.value.split(' ').join('-')
            const inviewVal = this.layoutFormat === 'top-to-bottom' ? this.$refs.inputView.value : 1,
                titleGallery = this.$refs.inputCheckBox.checked ? this.$refs.inputId.value : '';

			for(var i=0;i<document.getElementsByClassName('inputUrl').length;i++){
				i == document.getElementsByClassName('inputUrl').length-1 ? data += `{'url': '${this.valUrl[i]}', 'title': '${this.valTitle[i]}','credit': '${this.valCredit[i]}','text': '${this.valText[i]}', 'actionLabel' : '${this.valInputButtonLabel[i]}', 'actionUrl' : '${this.valInputButton[i]}'}` : data += `{'url': '${this.valUrl[i]}', 'title': '${this.valTitle[i]}','credit': '${this.valCredit[i]}','text': '${this.valText[i]}', 'actionLabel' : '${this.valInputButtonLabel[i]}', 'actionUrl' : '${this.valInputButton[i]}'},`
			}
            const shortcodeName = this.layoutFormat === 'top-to-bottom' ? 'GallerySlide' : 'GallerySlideFull'
			const shortcode = `[${shortcodeName} name="${idGallery.toLowerCase()}" inview="${inviewVal}" title="${titleGallery}" hasbackground="${this.$refs.checkBoxBackground.checked}" data="${data}"/]`;
			this.$refs.inputResult.value = shortcode;
		}
    }
})