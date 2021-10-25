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
            this.quiz.push({ value: '' });
            // remove column after add form
            const addForm = document.getElementsByClassName('addColumn')[idx];
            addForm.style.display = 'none'
        },
        getInput(){
            const questionLength = document.getElementsByClassName('question_block').length;
            if (questionLength == this.question.length) {
                return;
            }
            console.log(questionLength, 'length now')
            console.log(this.question.length, 'question')
            for (let i = 0; i < questionLength; i++) {
                let type, media, question, choices, rightChoiceNumber, inputAnswer, input, jawaban, choiceBox, expType, explanation, expUrl;
                type = document.getElementsByClassName('inputQuizType')[i].value;
                media; // media for question
                if (type == 'image') {
                    media = document.getElementsByClassName('inputMediaImage')[i].value;
                } else if (type == 'audio') {
                    media = document.getElementsByClassName('inputMediaAudio')[i].value;
                } else {
                    media = ''
                }
                question = document.getElementsByClassName('inputQuestion')[i].value;
                choices = document.getElementsByClassName('choiceCols')[i].childNodes;
                rightChoiceNumber = document.getElementsByClassName('inputAnswerCount')[i].value;
                inputAnswer = document.getElementsByClassName('inputAnswerCover')[i];
                input = inputAnswer.querySelectorAll('input.inputAnswer:checked');
                jawaban = []
                input.forEach(e => {
                    jawaban.push(e.value)
                });

                choiceBox = []
                choices.forEach((e, idx) => {
                    choiceBox.push({
                        'id': idx+1,
                        'text': e.value
                    })
                });

                // explanation value
                expType = document.getElementsByClassName('inputExpType')[i].value;
                explanation = document.getElementsByClassName('inputExplanation')[i].value;
                expUrl;
                if (expType == 'image') {
                    expUrl = document.getElementsByClassName('inputExpImage')[i].value;
                } else if (expType == 'audio') {
                    expUrl = document.getElementsByClassName('inputExpAudio')[i].value;
                } else {
                    expUrl = ''
                }

                console.log(question, 'question')
                console.log(explanation, 'exp')
                
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
                
            }
        },
        generateShortcode() {
            const self = this;
            // add last question to array
            self.getInput();

            self.showResult = true;
            let data = '',
                choices= '',
                answers= '',
                quizId = this.generateId();            

            // loop sesuai jumlah array pertanyaan
            for (let i=0; i<this.question.length; i++) {
                choices = '';
                this.question[i].choices.forEach(e => {
                  choices += `{'id': ${e.id},'text': '${e.text}'},`
                })
                choices = choices.replace(/.$/, "");
                answers = `{'correct': (${this.question[i].answer.correct}),'header': {'type': '${this.question[i].answer.header.type}','url': '${this.question[i].answer.header.url ? this.question[i].answer.header.url:null}'},'text': '${this.question[i].answer.text}'}`
                data += `{'question': {'type': '${this.question[i].type}','url': '${this.question[i].url ? this.question[i].url : null}','text': '${this.question[i].text}'},'choices': (${choices}),'choicecount': ${this.question[i].choicecount},'answer': ${answers}},`
            }
            data = data.replace(/.$/, "");
            
            const shortcode = 
            `[InteractiveQuiz id='${quizId}' cover= "{'title': '${this.cover.title}', 'excerpt': '${this.cover.excerpt}', 'thumbnail': '${this.cover.image}', 'button': '${this.cover.button}'}", data="(${data})" /]`

            // reset array to zero!
            this.question = [];
            // put shortcode to 
			this.$refs.inputResult.value = shortcode;
        }
    }
})