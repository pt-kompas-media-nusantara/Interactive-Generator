Vue.config.devtools = true
'use strict';

new Vue({
    el: "#quiz",
    data() {
        return {
            id: '',
            showResult: false,
            showPreview: false,
            questionType: '',
            cover: {
                titleResult: '',
                excerptResult: '',
                thumbnail: '',
                buttonText: '',
            },
            valTypeQuiz: [],
            valQuestion: [],
            valAnswerChoice: [],
            valRightChoice: [],
            valQuestionImage: [],
            valQuestionAudio: [],
            quiz: [{ value: '' }]
        }
    },
    computed: {
        // inputTypeIndex() {
        //     return document.getElementsByClassName('inputQuizType').length - 1;
        // },
        updateQuizValue() {
            return this.quiz[0].value
        },
        selectedBackground() {
            return this.backgroundResult;
        },
        updateQuizId() {
            this.id = this.generateId();
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
        },
        // updateType() {
        //     let type = document.getElementsByClassName('inputQuizType');
        //     return document.getElementsByClassName('inputQuizType')[type.length-1].value
        // }
    }, 
    methods: {
        updateType(idx) {
            this.questionType = document.getElementsByClassName('inputQuizType')[idx].value;
        },
        addForm() {
            this.getInput();
			this.quiz.push({ value: '' });
		},
		getInput(){
			this.valUrl = []
			this.valCredit = []
			this.valTitle = []
			this.valText = []
			this.valInputButton = []
            this.valInputButtonLabel = []
            this.valTypeQuiz = []
            this.valQuestion = []
            this.valAnswerChoice = []
            this.valRightChoice = []
            this.valQuestionImage = []
            this.valQuestionAudio = []

            // input audio question 
            for(var i=0;i<document.getElementsByClassName('inputMediaImage').length;i++){
                this.valQuestionImage.push(document.getElementsByClassName('inputMediaImage')[i].value);
            }
            // input image question 
            for(var i=0;i<document.getElementsByClassName('inputMediaImage').length;i++){
                this.valQuestionImage.push(document.getElementsByClassName('inputMediaImage')[i].value);
            }            
            // input answer choice
            for(var i=0;i<document.getElementsByClassName('inputAnswer').length;i++){
                this.valRightChoice.push(document.getElementsByClassName('inputAnswer')[i].value);
            }
            // input answer choice
            for(var i=0;i<document.getElementsByClassName('inputAnswerChoice').length;i++){
				this.valAnswerChoice.push(document.getElementsByClassName('inputAnswerChoice')[i].value);
			}
            // input type question
            for(var i=0;i<document.getElementsByClassName('inputQuizType').length;i++){
				this.valTypeQuiz.push(document.getElementsByClassName('inputQuizType')[i].value);
			}
            // input question
            for(var i=0;i<document.getElementsByClassName('inputQuestion').length;i++){
				this.valQuestion.push(document.getElementsByClassName('inputQuestion')[i].value);
			}
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
			for(var i=0;i<document.getElementsByClassName('inputButtonLabel').length;i++){
				this.valInputButtonLabel.push(document.getElementsByClassName('inputButtonLabel')[i].value);
			}
		},
        quizMediaGallery(idx) {
            const self = this;
            let file_frame;
            file_frame = wp.media.frames.file_frame = wp.media({
                title: 'Pilih gambar untuk di upload',
                button: {
                    text: 'Gunakan gambar ini',
                },
                multiple: false
            });

            file_frame.on( 'select', function() {
                var attachment = file_frame.state().get('selection').first().toJSON();
                // document.getElementsByClassName('gallery-img-picked')[0].src = attachment.url;
                document.getElementsByClassName('inputMediaImage')[idx].value = attachment.url;
                document.getElementsByClassName('upload_image_quiz_btn')[idx].style.display = 'none'
                document.getElementsByClassName('close_image_quiz_btn')[idx].style.display = 'block'
            })

			file_frame.open();
        },
        quizMediaRemove(idx) {
            const self = this;
            self.backgroundResult = '';
            document.getElementsByClassName('inputMediaImage')[idx].value = '';
            document.getElementsByClassName('upload_image_quiz_btn')[idx].style.display = 'block'
            document.getElementsByClassName('close_image_quiz_btn')[idx].style.display = 'none'
            // document.getElementsByClassName('gallery-img-picked')[0].style.display = 'none'
            // document.getElementsByClassName('gallery-img-picked')[0].src = '';
        },
        galleryOpenMedia() {
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
            
            // self.showResult = true;
            
            // type video
            // if (img == undefined || null) {
            //     this.backgroundResult = ''
            //     this.videoResult = document.getElementsByClassName('gallery-vid-picked')[0].value;
            //     shortcode = `{ 'type': '${this.jumbotronType}', 'excerpt': '${this.useExcerpt}', 'url': '${this.videoResult}', 'titlePos' : '${this.titlePos}', 'color': '${this.titleColor}', 'titleAlign': '${this.alignText}' }`;
            // }
            // type image
            // else if(vid == undefined || null) {
            //     this.videoResult = ''
            //     shortcode = `{ 'type': '${this.jumbotronType}', 'excerpt': '${this.useExcerpt}', 'url': '${this.backgroundResult}', 'titlePos' : '${this.titlePos}', 'color': '${this.titleColor}', 'titleAlign': '${this.alignText}' }`;
            // } else {
            //     shortcode = `{}`
            // }

            // self.$refs.inputResult.value = shortcode;

        },
        generateId() {
            let date = new Date();
            let d = date.getDate();
            let m = (date.getMonth() + 1); //Month from 0 to 11
            let y = date.getFullYear();
            // remove special character and spacing on title
            let title = this.cover.titleResult ? (this.cover.titleResult).replace(/[&\/\\#,+()$~%.'":*?<>{}]/g,' ').replace(/\s+/g, '-').toLowerCase() : '';
            return title + '-' + (d <= 9 ? '0' + d : d) +  (m<=9 ? '0' + m : m) +  y;
        }
    },
    mounted() {
    }
})