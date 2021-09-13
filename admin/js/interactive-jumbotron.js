Vue.config.devtools = true
'use strict';

new Vue({
    el: "#jumbotron",
    data() {
        return {
            showResult: false,
            backgroundResult: '',
            videoResult: '',
            jumbotronType: 'Image',
            subtitleResult: '',
            titlePos: 'center',
            titleColor: 'black',
            videoSource: '',
            alignText: 'center'
        }
    },
    computed: {
        selectedBackground() {
            return this.backgroundResult;
        },
        titlePosResult() {
            switch (this.titlePos) {
                case "center":
                    return 'justify-center items-center'
                    break;
                case "center-top":
                    return 'justify-center items-start'
                    break;
                case "center-bottom":
                    return 'justify-center items-end'
                    break;
                case "left":
                    return 'justify-start items-center'
                    break;
                case "left-top":
                    return 'justify-start items-start'
                    break;
                case "left-bottom":
                    return 'justify-start items-end'
                    break;
                case "right":
                    return 'justify-end items-center'
                    break;
                case "right-top":
                    return 'justify-end items-start'
                    break;
                case "right-bottom":
                    return 'justify-end items-end'
                    break;
                default:
                    return 'justify-center items-center'
                    break;
            }
        },
        selectedVideo() {
            return this.videoSource;
        },
        alignTextResult() {
            switch (this.alignText) {
                case 'right':
                    return 'text-right'
                    break;
                case 'left':
                    return 'text-left'
                    break;
                default:
                    return 'text-center'
                    break;
            }
        }
    }, 
    methods: {
        galleryOpenMedia(idx) {
            const self = this;
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
				document.getElementsByClassName('gallery-img-picked')[0].style.display = 'block'
				document.getElementsByClassName('gallery-img-picked')[0].src = attachment.url
				document.getElementsByClassName('inputUrl')[0].value = attachment.url
                self.backgroundResult = attachment.url;

                document.getElementsByClassName('close_media')[0].style.display = 'block'
                document.getElementsByClassName('upload_image_button')[0].style.display = 'none'
			});
            
			file_frame.open();
		}, 
        removeMedia() {
            const self = this;
            self.backgroundResult = '';
            document.getElementsByClassName('inputUrl')[0].value = '';
            document.getElementsByClassName('gallery-img-picked')[0].src = '';
            document.getElementsByClassName('gallery-img-picked')[0].style.display = 'none'

            document.getElementsByClassName('close_media')[0].style.display = 'none'
            document.getElementsByClassName('upload_image_button')[0].style.display = 'block'
        },
        generateShortcode() {
            const self = this;

            let img = document.getElementsByClassName('gallery-img-picked')[0],
                vid = document.getElementsByClassName('gallery-vid-picked')[0],
                shortcode;
            
            self.showResult = true;
            
            // type video
            if (img == undefined || null) {
                this.backgroundResult = ''
                this.videoResult = document.getElementsByClassName('gallery-vid-picked')[0].value;
                shortcode = `{ 'type': '${this.jumbotronType}', 'url': '${this.videoResult}', 'titlePos' : '${this.titlePos}', 'color': '${this.titleColor}', 'titleAlign': '${this.alignText}' }`;
            }
            // type image
            else if(vid == undefined || null) {
                this.videoResult = ''
                shortcode = `{ 'type': '${this.jumbotronType}', 'url': '${this.backgroundResult}', 'titlePos' : '${this.titlePos}', 'color': '${this.titleColor}', 'titleAlign': '${this.alignText}' }`;
            } else {
                shortcode = `{}`
            }

            self.$refs.inputResult.value = shortcode;

        }
    }
})