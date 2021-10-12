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


<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<section class="quizGenerator flex mt-10 w-full max-w-8xl" id="quiz">
  <!-- INPUT BLOCK -->
  <section class="input_block w-full flex-1 mr-2">
    <div class="w-full">
      <div class="mt-8">
        <p class="block text-gray-800 mb-4 font-bold">Catatan:</p>
        <p class="block text-gray-800 mb-4">- Setiap input dengan tanda <sup class="text-red-600 font-bold text-sm">*</sup> wajib diisi. sisanya boleh dikosongkan.</p>
      </div>

      <!-- cover -->
      <div class="md:flex md:flex-col md:items-center mb-3 p-3 rounded" 
          style="background: #acf"  >
        <!-- Judul -->
        <div class="md:w-full flex mb-3">
          <div class="md:1/4">
            <label class="block text-gray-800 font-bold md:text-right mb-1 md:mb-0 pr-4">
              Judul <sup class="text-red-600 font-bold text-sm">*</sup>
            </label>
          </div>
          <div class="md:w-3/4 relative">
            <div class="md:w-full">
              <input 
                v-model="cover.titleResult"
                class="inputId bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" 
                type="text" maxlength="120"
                name="view" required 
                placeholder="Wajib diisi" ref="coverTitle">
            </div>
          </div>
        </div>

        <!-- Excerpt -->
        <div class="md:w-full flex mb-3">
          <div class="md:1/4">
            <label class="block text-gray-800 font-bold md:text-right mb-1 md:mb-0 pr-4">
              Excerpt
            </label>
          </div>
          <div class="md:w-3/4 relative">
            <div class="md:w-full">
              <input 
                v-model="cover.excerptResult"
                class="inputId bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" 
                type="text" maxlength="120"
                name="view" required 
                placeholder="Wajib diisi" ref="coverExcerpt">
            </div>
          </div>
        </div>

        <!-- Thumbnail  -->
        <div class="md:w-full flex mb-3">
          <div class="md:1/4">
            <label class="block text-gray-800 font-bold md:text-right mb-1 md:mb-0 pr-4">
              Thumbnail
            </label>
          </div>
          <div class="md:w-3/4 relative">
            <div class="md:w-5/6">
              <input class="inputUrl bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 mb-3" type="url" name="url">
              <input type="button" 
                class="button upload_image_button"
                value="<?php _e( 'Upload gambar' ); ?>" @click="galleryOpenMedia()"/>

              <div @click="removeMedia()"
              class="close_media md:w-1/3 rounded uppercase p-1 text-center cursor-pointer bg-red-400 hidden">Hapus Gambar</div>
            </div>
          </div>
        </div>

        <!-- Button Text -->
        <div class="md:w-full flex mb-3">
          <div class="md:1/4">
            <label class="block text-gray-800 font-bold md:text-right mb-1 md:mb-0 pr-4">
              Button <sup class="text-red-600 font-bold text-sm">*</sup>
            </label>
          </div>
          <div class="md:w-3/4 relative">
            <div class="md:w-1/3">
              <input 
                v-model="cover.buttonText"
                class="inputId bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" 
                type="text" maxlength="20"
                name="view" required 
                placeholder="Text Button" ref="buttonText">
            </div>
          </div>
        </div>
      </div>

      <!-- shortcode -->
      <div class="shortcode_block">
        <div class="md:flex md:items-center mb-8">
          <div class="md:w-1/4"></div>
          <div class="md:w-3/4">
              <div class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded inline-flex items-center" @click="generateShortcode()">
                  <span>Generate Shortcode</span>
              </div>
          </div>
        </div>
        <div class="md:flex md:items-center mb-2 opacity-0" :class="{ show : showResult }">
            <div class="md:w-1/4">
                <label class="block text-gray-800 font-bold md:text-right mb-1 md:mb-0 pr-4">
                Salin Shortcode ini
                </label>
            </div>
            <div class="md:w-3/4">
                <textarea class="inputResult form-textarea appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 text-base" rows="5" name="text" ref="inputResult"></textarea>
            </div>
        </div>
      </div>
    </div>
  </section>

  <!-- PREVIEW BLOCK -->
  <section class="preview_block w-full flex-1">
    <div class="w-full">
      <div class="md:w-3/4 flex justify-center mx-auto" :class="titlePosResult">
        <p class="text-2xl font-bold rounded max-w-screen-sm text-center py-2 max-w-2xl z-10 break-words leading-tight capitalize">
          {{ cover.titleResult }}
        </p>
      </div>
      <div class="md:w-3/4 flex justify-center mx-auto" :class="titlePosResult">
        <p class="text-lg rounded max-w-screen-sm py-2 max-w-2xl text-center z-10 break-words">
          {{ cover.excerptResult }}
        </p>
      </div>
      <div class="md:w-3/4 flex justify-center mx-auto">
        <img class="gallery-img-picked mb-2 relative rounded" 
          v-model="cover.thumbnail"
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
</section>
