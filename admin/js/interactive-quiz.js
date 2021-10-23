Vue.config.devtools = true
'use strict';

new Vue({
    el: "#quiz",
    data() {
        return {
            id: '',
            rightAnswerSum: 1,
            showResult: false,
            showPreview: false,
            questionType: '',
            choiceNumber: [],
            cover: {
                image: '',
                title: '',
                excerpt: '',
                button: ''
            },
            quiz: [{ value: '' }],
            question: []
        }
    },
    computed: {
        updateQuizValue() {
            return this.quiz[0].value
        },
        selectedBackground() {
            return this.cover.image;
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
        updateChoiceNumber(){
            return this.choiceNumber;
        }
    }, 
    methods: {
        inputChoicesNumber(idx) {
            let number = parseInt(document.getElementsByClassName('inputChoices')[idx].value);
            if (this.choiceNumber.length == idx) {
                this.choiceNumber.push(number)
            } else {
                this.choiceNumber.splice(idx, 1)
                this.choiceNumber.push(number)
            }
        },
        updateAnswerChoice(idx) {
            let choiceNumber = this.choiceNumber[idx];
            let inputCover = document.getElementsByClassName('inputAnswerCover')[idx];
            let inputAnswer = inputCover.querySelectorAll('input.inputAnswer');
            for(let i=0; i<inputAnswer.length; i++) {
                if (i < choiceNumber) {
                    inputAnswer[i].disabled = false;
                } else {
                    inputAnswer[i].disabled = true;
                }
            }
        },
        updateAnswerCount(idx) {
            const limit = document.getElementsByClassName('inputAnswerCount')[idx].value;
            const column = document.getElementsByClassName('answerColumn')[idx];
            column.style.display = 'flex';
            this.updateAnswerChoice(idx)
            return limit;
        },
        updateExpType(idx) {
            // get media column & show it
            const type = document.getElementsByClassName('inputExpType')[idx].value;
            const img = document.getElementsByClassName('imageExpMedia')[idx];
            const audio = document.getElementsByClassName('audioExpMedia')[idx];
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
        quizMediaGallery(idx) {
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
        showColBefore(idx) {
            const form = document.getElementsByClassName('addColumn')[idx-1];
            form.style.display = 'flex'
        },
        expMediaGallery(idx) {
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
                document.getElementsByClassName('inputExpImage')[idx].value = attachment.url;
                document.getElementsByClassName('upload_image_exp_btn')[idx].style.display = 'none'
                document.getElementsByClassName('close_image_exp_btn')[idx].style.display = 'block'
            })

			file_frame.open();
        },
        chooseCoverImage() {
            const self = this;
			var file_frame;
			file_frame = wp.media.frames.file_frame = wp.media({
				title: 'Pilih gambar untuk di upload',
				button: {
					text: 'Gunakan gambar ini',
				},
				multiple: false // Set to true to allow multiple files to be selected
			});

            
            
			file_frame.on('select', function() {
				var attachment = file_frame.state().get('selection').first().toJSON();
				document.getElementsByClassName('gallery-img-picked')[0].style.display = 'block';
				document.getElementsByClassName('gallery-img-picked')[0].src = attachment.url;
				document.getElementsByClassName('inputCoverImage')[0].value = attachment.url;
                self.cover.image = attachment.url;
                // document.getElementsByClassName('close_media')[0].style.display = 'block'
                // document.getElementsByClassName('upload_image_button')[0].style.display = 'none'
			});
            // this.cover.thumbnail = document.getElementsByClassName('inputCoverImage')[0].value;
			file_frame.open();
            // console.log(document.getElementsByClassName('inputCoverImage')[0].value, 'src')

		}, 
        removeCoverImage() {
            const self = this;
            self.cover.image = '';
            document.getElementsByClassName('inputCoverImage')[0].value = '';
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
        // add new empty form for question
        addForm(idx) {
            console.log('index added: ', idx)
            this.getInput(idx);
            this.quiz.push({ value: '' });
            // remove column after add form
            const addForm = document.getElementsByClassName('addColumn')[idx];
            addForm.style.display = 'none'
		},
        getInput(idx=0){
            console.log(this.question, ' idx:'+idx)
            
            // every time addform clicked, add input form before to array 
            const type = document.getElementsByClassName('inputQuizType')[idx].value;
            let media; // media for question
            if (type == 'image') {
                media = document.getElementsByClassName('inputMediaImage')[idx].value;
            } else if (type == 'audio') {
                media = document.getElementsByClassName('inputMediaAudio')[idx].value;
            } else {
                media = ''
            }
            const question = document.getElementsByClassName('inputQuestion')[idx].value;
            const choices = document.getElementsByClassName('choiceCols')[idx].childNodes;
            const rightChoiceNumber = document.getElementsByClassName('inputAnswerCount')[idx].value;
            const inputAnswer = document.getElementsByClassName('inputAnswerCover')[idx];
            let input = inputAnswer.querySelectorAll('input.inputAnswer:checked');
            let jawaban = []
            input.forEach(e => {
                jawaban.push(e.value)
            });

            let choiceBox = []
            choices.forEach((e, idx) => {
                choiceBox.push({
                    'id': idx+1,
                    'text': e.value
                })
            });

            // explanation value
            let expType = document.getElementsByClassName('inputExpType')[idx].value;
            let explanation = document.getElementsByClassName('inputExplanation')[idx].value;
            let expUrl;
            if (expType == 'image') {
                expUrl = document.getElementsByClassName('inputExpImage')[idx].value;
            } else if (expType == 'audio') {
                expUrl = document.getElementsByClassName('inputExpAudio')[idx].value;
            } else {
                expUrl = ''
            }
            
            this.question.push({
                'type': type,
                'url': media,
                'text': question,
                'choices': choiceBox,
                'choicecount': rightChoiceNumber,
                'answer': {
                    'correct': jawaban,
                    'header': {
                        'type': expType,
                        'url': expUrl
                    },
                    'text': explanation
                }
            })
		},
        generateShortcode() {
            const self = this;

            // add last question to array
            let last = document.getElementsByClassName('inputQuestion').length;
            this.getInput(last-1);

            self.showResult = true;
            let data = '',
                choices= '',
                answers= '',
                quizId = this.generateId();

            // loop array pertanyaan
            
            for (let i=0; i<this.question.length; i++) {
                // console.log(this.question[i], ' i:',i)
                this.question[i].choices.forEach(e => {
                    choices = `
                    {
                        'id': ${e.id},
                        'text': ${e.text}
                    },`
                })
                answers = `{
                    'correct': (${this.question[i].answer.correct}),
                    'header': {
                        'type': '${this.question[i].answer.header.type}',
                        'url': '${this.question[i].answer.header.url ? this.question[i].answer.header.url:null}',
                    },
                    'text': ${this.question[i].answer.text}
                }`
                data += `
                'question': {
                    'type': '${this.question[i].type}',
                    'url': '${this.question[i].url ? this.question[i].url : null}',
                    'text': '${this.question[i].text}'
                },
                'choicecount': ${this.question[i].choicecount},
                'choices': (${choices}),
                'answer': ${answers}
                `
                // console.log(data)
                // console.log('i: 2' + i, ' ' + this.question[2].text)
            }

            choices = choices.replace(/.$/, "");
            
            const shortcode = 
            `[InteractiveQuiz id='${quizId}' cover= "{'title': '${this.cover.title}', 'excerpt': '${this.cover.excerpt}', 'thumbnail': '${this.cover.image}', 'button': '${this.cover.button}'}", 
            data="({${data}})," 
            /]`

            // [InteractiveQuiz id="111021132801" cover= "{ 'title': 'Kuis Kemeredekaan', 'excerpt': 'Memasuki masa kemerdekaan, kereta berperan penting “menyelamatkan” para pemimpin bangsa yang menghindar dari?', 'thumbnail': 'kompas.jpg', 'button': 'Yuk Main'}" 
            // data="({
            //     'question': {
            //         'type':'audio', 
            //         'url':'kompas.jpg', 
            //         'text': 'Apa makna gambar dibawah?'
            //     },
            //     'choices': (
            //         {'id': 1, 'text': 'Pilihan A'}, 
            //         {'id': 2, 'text': 'Pilihan B'}, 
            //         {'id': 3, 'text': 'Pilihan C'}
            //         ),
            //     'choicecount': 1,
            //     'answer': {
            //         'correct': (1), 
            //         'header':{
            //             'type':'image', 
            //             'url':'kompas.jpg'
            //         }, 
            //         'text': 'Sumatera selatan memiliki banyak kota di Indonesia'
            //     }
            // })" 
            // /]

			this.$refs.inputResult.value = shortcode;
        }
    }
})