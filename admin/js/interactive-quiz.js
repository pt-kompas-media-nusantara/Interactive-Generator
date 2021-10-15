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
            choiceNumber: 2, 
            cover: {
                title: '',
                excerpt: '',
                thumbnail: '',
                buttonText: '',
            },
            question: [],
            valTypeQuiz: [],
            valQuestion: [],
            valAnswerChoice: [],
            valRightChoice: [],
            valQuestionImage: [],
            valQuestionAudio: [],
            valExpAudio: [],
            valExpImage: [],
            valExplanation: [],
            quiz: [{ value: '' }]
        }
    },
    computed: {
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
        }
    }, 
    methods: {
        addChoiceNumber() {
            max = 5;
            return this.choiceNumber <= max ? this.choiceNumber++ : max;
        },
        minChoiceNumber() {
            min = 2;
            return this.choiceNumber >= min ? this.choiceNumber-- : min;
        },
        updateExpType(idx) {
            // get media column & show it
            const type = document.getElementsByClassName('inputExpType')[idx].value;
            const img = document.getElementsByClassName('imageExpMedia')[idx];
            const audio = document.getElementsByClassName('audioExpMedia')[idx];
            console.log(type, 'type');
            switch (type) {
                case 'audio':
                    audio.style.display = 'flex';
                    img.style.display = 'none';
                    break;
                case 'image':
                    img.style.display = 'flex';
                    audio.style.display = 'none';
                    break;
                default:
                    img.style.display = 'none';
                    audio.style.display = 'none';
                    break;
            }
        },
        updateType(idx) {
            // get media column & show it
            const type = document.getElementsByClassName('inputQuizType')[idx].value;
            const img = document.getElementsByClassName('imageMedia')[idx];
            const audio = document.getElementsByClassName('audioMedia')[idx];
            switch (type) {
                case 'audio':
                    audio.style.display = 'flex';
                    img.style.display = 'none';
                    break;
                case 'image':
                    img.style.display = 'flex';
                    audio.style.display = 'none';
                    break;
                default:
                    img.style.display = 'none';
                    audio.style.display = 'none';
                    break;
            }
        },
        addForm(idx) {
            this.getInput();
			this.quiz.push({ value: '' });
            // data="({'question': {'type':'audio', 'url':'kompas.jpg', 'text': 'Apa makna gambar dibawah?'},'choices': ({'id': 1, 'text': 'Pilihan A'}, {'id': 2, 'text': 'Pilihan B'}, {'id': 3, 'text': 'Pilihan C'}),'choicecount': 1,'answer': {'correct': (1), 'header':{'type':'image', 'url':'kompas.jpg'}, 'text': 'Sumatera selatan memiliki banyak kota di Indonesia'}})" 
            const type = document.getElementsByClassName('inputQuizType')[idx].value;
            let media;
            if (type == 'image') {
                media = document.getElementsByClassName('inputMediaImage')[idx].value;
            } else if (type == 'audio') {
                media = document.getElementsByClassName('inputMediaAudio')[idx].value;
            } else {
                media = ''
            }
            const question = document.getElementsByClassName('inputQuestion')[idx].value;
            const choices = document.getElementsByClassName('choiceCols')[idx].childNodes;

            let choiceBox = []
            choices.forEach((e, idx) => {
                choiceBox.push({
                    'id': idx+1,
                    'text': e.value
                })
            });
            
 
            this.question.push({
                'type': type,
                'url': media,
                'text': question,
                'choices': choiceBox
            })

            console.log(this.question);
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
            this.valExpAudio = []
            this.valExpImage = []
            this.valExplanation = []

            // Input Explanation Textarea
            for(var i=0;i<document.getElementsByClassName('inputExplanation').length;i++){
                this.valExplanation.push(document.getElementsByClassName('inputExplanation')[i].value);
            }
            // input exp image
            for(var i=0;i<document.getElementsByClassName('inputExpImage').length;i++){
                if (document.getElementsByClassName('inputExpImage')[i].value !== '') {
                    this.valExpAudio.push(document.getElementsByClassName('inputExpImage')[i].value);
                }
            }
            // input exp audio
            for(var i=0;i<document.getElementsByClassName('inputExpAudio').length;i++){
                if (document.getElementsByClassName('inputExpAudio')[i].value !== '') {
                    this.valExpAudio.push(document.getElementsByClassName('inputExpAudio')[i].value);
                }
            }
            // input audio question 
            for(var i=0;i<document.getElementsByClassName('inputMediaAudio').length;i++){
                if (document.getElementsByClassName('inputMediaAudio')[i].value !== '') {
                    this.valQuestionAudio.push(document.getElementsByClassName('inputMediaAudio')[i].value);
                }
            }
            // input image question 
            for(var i=0;i<document.getElementsByClassName('inputMediaImage').length;i++){
                if (document.getElementsByClassName('inputMediaImage')[i].value !== '') {
                    this.valQuestionImage.push(document.getElementsByClassName('inputMediaImage')[i].value);
                }
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
        generateId() {
            let date = new Date();
            let d = date.getDate();
            let m = (date.getMonth() + 1); //Month from 0 to 11
            let y = date.getFullYear();
            // remove special character and spacing on title
            let title = this.cover.title ? (this.cover.title).replace(/[&\/\\#,+()$~%.'":*?<>{}]/g,' ').replace(/\s+/g, '-').toLowerCase() : '';
            return title + '-' + (d <= 9 ? '0' + d : d) +  (m<=9 ? '0' + m : m) +  y;
        },
        generateShortcode() {
            const self = this;
            this.getInput();
            self.showResult = true;

            let data = '',
                choices = '',
                quizId = this.generateId();

            for (var i=0; i<document.getElementsByClassName('inputQuestion').length; i++) {
                
            }

            // for (var i=0; i<document.getElementsByClassName('inputQuestion').length; i++) {
            //     data += `({
            //         'question': {
            //             'type': '${this.valTypeQuiz[i]}',
            //             'urlAudio': '${this.valQuestionAudio[i]}',
            //             'urlImage': '${this.valQuestionImage[i]}',
            //             'text': '${this.valQuestion[i]}',
            //         },
            //         'choices': ({
            //             'id': 1,
            //             'text': '${this.valAnswerChoice[i]}'
            //         })
            //     })`
            // }

            // return `[InteractiveQuiz 
            // id='${quizId}' cover= {'title': '${this.cover.title}', 'excerpt': '${this.cover.excerpt}', 'thumbnail': '${this.cover.thumbnail}', 'button': '${this.cover.buttonText}'}

            // data="({'question': {'type':'audio', 'url':'kompas.jpg', 'text': 'Apa makna gambar dibawah?'},'choices': ({'id': 1, 'text': 'Pilihan A'}, {'id': 2, 'text': 'Pilihan B'}, {'id': 3, 'text': 'Pilihan C'}),'choicecount': 1,'answer': {'correct': (1), 'header':{'type':'image', 'url':'kompas.jpg'}, 'text': 'Sumatera selatan memiliki banyak kota di Indonesia'}})" 
            // /]`
        }
    },
    mounted() {
    }
})