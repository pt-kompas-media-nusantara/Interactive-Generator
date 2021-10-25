<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Interactive Generator
 * @subpackage Interactive_Generator/admin/partials
 */
wp_enqueue_media();
?>


<div class="mt-8">
  <p class="block text-gray-800 mb-4 font-bold">Catatan:</p>
  <p class="block text-gray-800 mb-4">- Setiap input dengan tanda <sup class="text-red-600 font-bold text-sm">*</sup> wajib diisi. sisanya boleh dikosongkan.</p>
</div>
<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<section class="quizGenerator flex flex-col mt-10 w-full max-w-8xl" id="quiz">
  <!-- COVER SECTION -->
  <h2 class="font-bold text-2xl leading-normal mb-2">Sampul</h2>
  <div class="flex mb-6">
    <!-- Input Cover -->
    <section class="input_block w-full flex-1 mr-2">
      <div class="w-full">
  
        <!-- cover -->
        <div class="md:flex md:flex-col md:items-center mb-3 p-6 rounded" 
            style="background: rgb(229 229 229)"  >
          <!-- Judul -->
          <div class="md:w-full flex mb-3">
            <div class="md:w-1/4 flex justify-end">
              <label class="block text-gray-800 font-bold md:text-right mb-1 md:mb-0 pr-4">
                Judul <sup class="text-red-600 font-bold text-sm">*</sup>
              </label>
            </div>
            <div class="md:w-3/4 relative">
              <div class="md:w-full">
                <input 
                  v-model="cover.title"
                  class="inputId bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" 
                  type="text" maxlength="120"
                  name="view" required 
                  placeholder="Wajib diisi" ref="coverTitle">
              </div>
            </div>
          </div>
  
          <!-- Excerpt -->
          <div class="md:w-full flex mb-3">
            <div class="md:w-1/4 flex justify-end">
              <label class="block text-gray-800 font-bold md:text-right mb-1 md:mb-0 pr-4">
                Excerpt <sup class="text-red-600 font-bold text-sm">*</sup>
              </label>
            </div>
            <div class="md:w-3/4 relative">
              <div class="md:w-full">
                <input 
                  v-model="cover.excerpt"
                  class="inputId bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" 
                  type="text" maxlength="120"
                  name="view" required 
                  placeholder="Excerpt untuk cover" ref="coverExcerpt">
              </div>
            </div>
          </div>
  
          <!-- Thumbnail  -->
          <div class="md:w-full flex mb-3">
            <div class="md:w-1/4 flex justify-end">
              <label class="block text-gray-800 font-bold md:text-right mb-1 md:mb-0 pr-4">
                Url Foto<sup class="text-red-600 font-bold text-sm">*</sup>
              </label>
            </div>
            <div class="md:w-3/4 relative">
              <div class="md:w-full">
                <input 
                  class="inputCoverImage bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 mb-3" type="text" name="thumbnailUrl" placeholder="pilih gambar untuk cover">

                <input type="button" 
                  class="button upload_image_button"
                  value="<?php _e( 'Upload gambar' ); ?>" @click="chooseCoverImage()"/>
  
                <div @click="removeCoverImage()"
                class="close_media md:w-1/3 rounded uppercase p-1 text-center cursor-pointer bg-red-400 hidden">Hapus Gambar</div>
              </div>
            </div>
          </div>
  
          <!-- Button Text -->
          <div class="md:w-full flex mb-3">
            <div class="md:w-1/4 flex justify-end">
              <label class="block text-gray-800 font-bold md:text-right mb-1 md:mb-0 pr-4">
                Button <sup class="text-red-600 font-bold text-sm">*</sup>
              </label>
            </div>
            <div class="md:w-3/4 relative">
              <div class="md:w-1/3">
                <input 
                  v-model="cover.button"
                  class="inputId bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" 
                  type="text" maxlength="20"
                  name="view" required
                  placeholder="Text Button">
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  
    <!-- Preview Cover -->
    <section class="preview_block w-full flex-1">
      <div class="w-full">
        <div class="md:w-3/4 flex justify-center mx-auto">
          <p class="text-2xl font-bold rounded max-w-screen-sm text-center py-2 max-w-2xl z-10 break-words leading-tight capitalize">
            {{ cover.title }}
          </p>
        </div>
        <div class="md:w-3/4 flex justify-center mx-auto">
          <p class="text-lg rounded max-w-screen-sm py-2 max-w-2xl text-center z-10 break-words">
            {{ cover.excerpt }}
          </p>
        </div>
        <div class="md:w-3/4 flex justify-center mx-auto">
          <img class="gallery-img-picked mb-2 relative rounded hidden"
            v-model="cover.image"
            alt="picked-img"
            style="width:auto;">
        </div>
        <div class="w-full flex justify-center">
          <div v-if="cover.button"
            class="text-white font-bold py-2 px-4 rounded inline-flex items-center" style="width:auto; background: #50A718">
            <p class="text-center">{{ cover.button }}</p>
          </div>
        </div>
      </div>
    </section>
  </div>


  <h2 class="font-bold text-2xl leading-normal mb-2">Data Kuis</h2>
  <!-- KUIS BLOCK -->  
  <div v-for="(item, key) in quiz" :key="key" class="flex mb-4" :class="updateQuizId">
    <section class="input_block w-full flex-1 mr-2 question_block">
      <div class="w-full relative flex flex-col py-4 px-3" style="background: rgb(229 229 229)">
        <span class="text-xs font-bold mb-4" style="color: #ababab;">Pertanyaan nomor {{ key+1 }}</span>
        <!-- Type -->
        <div class="w-full relative flex mt-2">
          <div class="md:w-1/4 flex justify-end">
            <label class="block text-gray-800 font-bold md:text-right mb-1 md:mb-0 pr-4 py-2">
              Tipe Pertanyaan <sup class="text-red-600 font-bold text-sm">*</sup>
            </label>
          </div>
          <select @change="updateType(key) "
            class="inputQuizType md:w-1/6 flex relative items-center" name="inputQuizType">
            <option value="default" selected="selected">default</option>
            <option value="image">image</option>
            <option value="audio">audio</option>
          </select>
        </div>

        <!-- Media Input (Image) -->
        <div class="imageMedia w-full relative mt-2 hidden">
          <div class="md:w-1/4 flex justify-end">
            <label class="block text-gray-800 font-bold md:text-right mb-1 md:mb-0 pr-4">
              Url Foto
            </label>
          </div>
          <div class="md:w-3/4 relative">
            <div class="md:w-5/6">
              <input class="inputMediaImage bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 mb-3" type="url" name="url">
              <input type="button" 
                class="button upload_image_quiz_btn"
                value="<?php _e( 'Upload gambar' ); ?>" @click="quizMediaGallery(key)"/>

              <div @click="quizMediaRemove(key)"
              class="close_image_quiz_btn md:w-1/3 rounded uppercase p-1 text-center cursor-pointer bg-red-400 hidden">Hapus Gambar</div>
            </div>
          </div>
        </div>
        <!-- Media Input (Audio) -->
        <div class="audioMedia w-full relative mt-2 hidden">
          <div class="md:w-1/4 flex justify-end">
            <label class="block text-gray-800 font-bold md:text-right mb-1 md:mb-0 pr-4">
              File Audio
            </label>
          </div>
          <div class="md:w-3/4 relative">
            <div class="md:w-5/6">
              <input class="inputMediaAudio bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 mb-3" type="url" name="url">
            </div>
          </div>
        </div>

        <!-- Question -->
        <div class="w-full relative flex">
          <div class="md:w-1/4 flex justify-end">
            <label class="block text-gray-800 font-bold md:text-right mb-1 md:mb-0 pr-4 py-4">
              Pertanyaan <sup class="text-red-600 font-bold text-sm">*</sup>
            </label>
          </div>
          <div class="md:w-3/4 flex relative items-center">
            <input class="inputQuestion md:w-11/12 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="text" name="inputQuestion" placeholder="Masukkan pertanyaan disini">
          </div>
        </div>

        <!-- Choices -->
        <div class="w-full relative flex items-center">
          <div class="md:w-1/4 flex justify-end items-center">
            <label class="block text-gray-800 font-bold md:text-right mb-1 md:mb-0 pr-4 py-4">
              Jumlah Pilihan<sup class="text-red-600 font-bold text-sm">*</sup> Jawaban 
            </label>
          </div>
          <div class="md:w-3/4 flex flex-col relative justify-start">
            <select @click="inputChoicesNumber(key)" @change="inputChoicesNumber(key)"
              class="inputChoices md:w-1/6 flex relative" name="inputChoices">
              <option v-for="item in 5" :key="item" :value="item" v-if="item >= 2">{{ item }}</option>
            </select>
          </div>
        </div>

        <!-- Choices-Text -->
        <div class="w-full relative flex">
          <div class="md:w-1/4 flex justify-end items-center"></div>
          <div class="choiceCols md:w-3/4 flex flex-col relative justify-start">
            <input v-for="(item, index) in choiceNumber[key]" :key="index" placeholder="Text Pilihan Jawaban"
              class="inputAnswerChoice mb-2 md:w-11/12 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="text">
          </div>
        </div>

        <!-- Answer-Count -->
        <div class="w-full relative flex">
          <div class="md:w-1/4 flex justify-end">
            <label class="block text-gray-800 font-bold md:text-right mb-1 md:mb-0 pr-4 py-4">
              Jumlah Jawaban<sup class="text-red-600 font-bold text-sm">*</sup> Benar 
            </label>
          </div>
          <div class="md:w-3/4 flex relative items-center">
            <select @click="updateAnswerCount(key)" @change="updateAnswerCount(key)"
              class="inputAnswerCount md:w-1/6 flex relative items-center" name="inputAnswerCount">
              <option v-for="(item, id) in choiceNumber[key]" :key="id" :value="id+1">{{ id + 1 }}</option>
            </select>
            <div class="ml-3 flex justify-start text-gray">&#42 Centang jawaban sesuai jumlah</div>
          </div>
        </div>

        <!-- Answer -->
        <div class="answerColumn w-full relative flex hidden">
          <div class="md:w-1/4 flex justify-end">
            <label class="block text-gray-800 font-bold md:text-right mb-1 md:mb-0 pr-4 py-4">
              Jawaban Benar<sup class="text-red-600 font-bold text-sm">*</sup>
            </label>
          </div>
          <div class="inputAnswerCover md:w-1/3 flex relative items-center">
            <input class="inputAnswer" type="checkbox" id="1" name="1" value="1"><span class="block mr-4 leading-none" style="margin-top: -6px;">A</span>
            <input class="inputAnswer" type="checkbox" id="2" name="2" value="2"><span class="block mr-4 leading-none" style="margin-top: -6px;">B</span>
            <input class="inputAnswer" type="checkbox" id="3" name="3" value="3"><span class="block mr-4 leading-none" style="margin-top: -6px;">C</span>
            <input class="inputAnswer" type="checkbox" id="4" name="4" value="4"><span class="block mr-4 leading-none" style="margin-top: -6px;">D</span>
            <input class="inputAnswer" type="checkbox" id="5" name="5" value="5"><span class="block mr-4 leading-none" style="margin-top: -6px;">E</span>
          </div>
        </div>

        <div class="md:w-full">
          <div class="md:w-5/6 border-t-2 border-fuchsia-600 mx-auto"></div>
        </div>

        <!-- Explanation -->
        <!-- Exp-Type -->
        <div class="w-full relative flex mt-2 mb-2">
          <div class="md:w-1/4 flex justify-end">
            <label class="block text-gray-800 font-bold md:text-right mb-1 md:mb-0 pr-4 py-2">
              Tipe Penjelasan <sup class="text-red-600 font-bold text-sm">*</sup>
            </label>
          </div>
          <select @change="updateExpType(key)"
            class="inputExpType md:w-1/6 flex relative items-center" name="inputExpType">
            <option value="default" selected="selected">default</option>
            <option value="image">image</option>
            <option value="audio">audio</option>
          </select>
        </div>
        <!-- Media Exp Input (Image) -->
        <div class="imageExpMedia w-full relative mt-2 hidden">
          <div class="md:w-1/4 flex justify-end">
            <label class="block text-gray-800 font-bold md:text-right mb-1 md:mb-0 pr-4">
              Url Foto
            </label>
          </div>
          <div class="md:w-3/4 relative mb-3">
            <div class="md:w-5/6">
              <input class="inputExpImage bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 mb-3" type="url" name="url">
              <input type="button" 
                class="button upload_image_exp_btn"
                value="<?php _e( 'Upload gambar' ); ?>" @click="expMediaGallery(key)"/>

              <div @click="expMediaRemove(key)"
              class="close_image_exp_btn md:w-1/3 rounded uppercase p-1 text-center cursor-pointer bg-red-400 hidden">Hapus Gambar</div>
            </div>
          </div>
        </div>
        <!-- Media Exp Input (Audio) -->
        <div class="audioExpMedia w-full relative mt-2 hidden">
          <div class="md:w-1/4 flex justify-end">
            <label class="block text-gray-800 font-bold md:text-right mb-1 md:mb-0 pr-4">
              Audio File
            </label>
          </div>
          <div class="md:w-3/4 relative">
            <div class="md:w-5/6">
              <input class="inputExpAudio bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 mb-3" type="url" name="url">
            </div>
          </div>
        </div>
        <!-- Exp Textarea -->
        <div class="w-full relative flex mb-3">
          <div class="md:w-1/4 flex justify-end">
            <label class="block text-gray-800 font-bold md:text-right mb-1 md:mb-0 pr-4 py-4">
              Penjelasan<sup class="text-red-600 font-bold text-sm">*</sup>
            </label>
          </div>
          <div class="md:w-3/4 flex">
            <textarea class="inputExplanation p-2" name="inputExp" rows="4" cols="75" placeholder="Masukkan penjelasan disini" maxlength="200"></textarea>
          </div>
        </div>
      </div>

      <div class="addColumn flex mt-4 max-w-3xl">
        <div class="md:w-1/4"></div>
        <div class="md:w-3/4">
          <div class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded inline-flex items-center cursor-pointer" @click="generateShortcode()">
            <span>Generate Shortcode</span>
          </div>
          <div class="inline-flex float-right">
            <div class="bg-gray-300 hover:bg-gray-400 text-gray-800 text-white font-bold py-2 px-4 mr-2 text-base rounded-sm" v-if="quiz.length>1" @click="quiz.pop();question.pop();showResult = false; showColBefore(key)">
              -
            </div>
            <div class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 text-base rounded-sm" @click="addForm(key);showResult = false;">
              +
            </div>
          </div>
        </div>
      </div>
    </section>
  
    <!-- Preview Kuis -->
    <!-- rgb(229 229 229) -->
    <section class="preview_block w-full flex-1">
      <div v-if="showPreview" class="w-full" style="background: rgb(229 229 229)">
        <div class="md:w-3/4 flex justify-center mx-auto">
          <p class="text-2xl font-bold rounded max-w-screen-sm text-center py-2 max-w-2xl z-10 break-words leading-tight capitalize">
            {{ updateQuizValue }}
          </p>
        </div>
        <div class="md:w-3/4 flex justify-center mx-auto">
          <p class="text-lg rounded max-w-screen-sm py-2 max-w-2xl text-center z-10 break-words">
            {{ cover.excerpt }}
          </p>
        </div>
        <div class="md:w-3/4 flex justify-center mx-auto">
          <img class="gallery-img-picked mb-2 relative rounded" 
            alt="picked-img"
            style="width:auto; display:none;">
        </div>
        <div class="w-full flex justify-center">
          <div v-if="cover.buttonText"
            class="text-white font-bold py-2 px-4 rounded inline-flex items-center" style="width:auto; background: #50A718">
            <p class="text-center">{{ cover.buttonText }}</p>
          </div>
        </div>
      </div>
    </section>
  </div>

  <div class="md:flex md:items-center mb-2 opacity-0 mt-3" v-bind:class="{ show : showResult }">
    <div class="md:w-1/6">
      <label class="block text-gray-800 font-bold md:text-right mb-1 md:mb-0 pr-4">
        Salin Shortcode ini
      </label>
    </div>
    <div class="md:w-3/4">
      <textarea class="inputResult form-textarea appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 text-base" rows="30" name="text" ref="inputResult"></textarea>
    </div>
  </div>
</section>
