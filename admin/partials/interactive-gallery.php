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
<section class="galleryGenerator" id="gallery">
  <div class="w-full max-w-3xl">
    <div class="mb-8">
      <p class="block text-gray-800 mb-1 font-bold">Catatan:</p>
      <p class="block text-gray-800">- Setiap input dengan tanda <sup class="text-red-600 font-bold text-sm">*</sup> wajib diisi. Sisanya boleh dikosongkan.</p>
      <p class="block text-gray-800">- Pemberian <b>Judul</b> tidak boleh sama dalam satu konten</p>
      <p class="block text-gray-800">- <b>Jumlah Gambar per Slide</b> untuk menampilakan jumlah foto setiap swipe</p>
      <p class="block text-gray-800">- Pada setiap input pastikan tidak ada karakter <b>"</b> dan <b>'</b></p>
    </div>
  </div>
  <div class="w-full max-w-3xl">
    <div class="mb-2">
      <div class="md:flex md:items-center mb-2">
        <div class="md:w-1/4">
          <label class="block text-gray-800 font-bold md:text-right mb-1 md:mb-0 pr-4">
            Judul Gallery<sup class="text-red-600 font-bold text-sm">*</sup>
          </label>
        </div>
        <div class="md:w-1/4">
          <input class="inputId bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="text" name="view" required placeholder="Wajib diisi" ref="inputId">
        </div>
        <div class="md:w-1/4 ml-4">
          <label class="w-full text-gray-600">
            <input class="mr-2 leading-tight" type="checkbox" ref="inputCheckBox">
            <span class="text-xs">
              Tampilkan Judul?
            </span>
          </label>
        </div>
      </div>
    </div>
    <div class="mb-2">
      <div class="md:flex md:items-center mb-2">
        <div class="md:w-1/4">
          <label class="block text-gray-800 font-bold md:text-right mb-1 md:mb-0 pr-4">
            Format Layout
          </label>
        </div>
        <div class="md:w-3/4 flex">
            <div class="pr-6">
                <label class="radio-inline">
                    <input type="radio" name="layout" value="top-to-bottom" v-model="layoutFormat" class="form-check-input" checked>Atas Bawah (Vertical)
                </label>
            </div>
            <div class="pr-2">
                <label class="radio-inline">
                    <input type="radio" name="layout" value="left-to-right" v-model="layoutFormat" class="form-check-input">Kiri Kanan (Horizontal)
                </label>
            </div>
        </div>
      </div>
    </div>
    <div class="mb-2">
      <div class="md:flex md:items-center mb-2">
        <div class="md:w-1/4">
          <label class="block text-gray-800 font-bold md:text-right mb-1 md:mb-0 pr-4">
            Tambahkan background pada text
          </label>
        </div>
        <div class="md:w-3/4 flex">
          <div class="w-full">
            <label class="w-full text-gray-600">
              <input class="mr-2 leading-tight" type="checkbox" ref="checkBoxBackground">
              <span class="text-xs">
                *caption akan memiliki warna background
              </span>
            </label>
          </div>
        </div>
      </div>
    </div>
    <div class="mb-8" v-if="layoutFormat !== 'left-to-right'">
      <div class="md:flex md:items-center mb-2">
        <div class="md:w-1/4">
          <label class="block text-gray-800 font-bold md:text-right mb-1 md:mb-0 pr-4">
            Jumlah Gambar per Slide
          </label>
        </div>
        <div class="md:w-1/4">
          <input class="inputView bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="text" name="view" value="1" ref="inputView">
        </div>
      </div>
    </div>
  </div>
  <div class="w-full max-w-3xl">
    <div class="mb-8" v-for="(item, key) in forms" :key="key">
      <div class="md:flex md:items-center mb-2">
        <div class="md:w-1/4">
          <label class="block text-gray-800 font-bold md:text-right mb-1 md:mb-0 pr-4">
            Link Gambar<sup class="text-red-600 font-bold text-sm">*</sup>
          </label>
        </div>
        <div class="md:w-3/4">
          <input class="inputUrl bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="text" name="url" required placeholder="Wajib diisi" readonly hidden>
          <img class="gallery-img-picked" src="" alt="picked-img" style="width:auto; height:100px;display:none;">
          <input type="button" class="button upload_image_button" value="<?php _e( 'Upload gambar' ); ?>" @click="galleryOpenMedia(key)" />
        </div>
      </div>
      <div class="md:flex md:items-center mb-2">
        <div class="md:w-1/4">
          <label class="block text-gray-800 font-bold md:text-right mb-1 md:mb-0 pr-4">
            Credit
          </label>
        </div>
        <div class="md:w-3/4">
          <input class="inputCredit bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="text" name="credit">
        </div>
      </div>
      <div class="md:flex md:items-center mb-2">
        <div class="md:w-1/4">
          <label class="block text-gray-800 font-bold md:text-right mb-1 md:mb-0 pr-4">
            Judul Gambar
          </label>
        </div>
        <div class="md:w-3/4">
          <input class="inputTitle bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="text" name="title">
        </div>
      </div>
      <div class="md:flex md:items-center mb-4">
        <div class="md:w-1/4">
          <label class="block text-gray-800 font-bold md:text-right mb-1 md:mb-0 pr-4">
            Caption Gambar
          </label>
        </div>
        <div class="md:w-3/4">
          <textarea class="inputText form-textarea appearance-none border-2 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" rows="8" name="text" maxlength="500" v-model="item.value"></textarea>
          <p class="text-right" :class="{'text-red-500' : item.value.length > 480}">{{ item.value.length }}/500</p>
        </div>
      </div>
      <div class="md:flex md:items-center mb-2">
        <div class="md:w-1/4">
          <label class="block text-gray-800 font-bold md:text-right mb-1 md:mb-0 pr-4">
            Action Button
          </label>
        </div>
        <div class="md:w-3/4 flex">
          <input class="w-1/4 mr-2 inputButtonLabel bg-gray-200 appearance-none border-2 border-gray-200 rounded py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="text" name="action-button" placeholder="Label">
          <input class="w-3/4 inputButton bg-gray-200 appearance-none border-2 border-gray-200 rounded py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="text" name="action-button" placeholder="Link">
        </div>
      </div>
    </div>
    <div class="md:flex md:items-center mb-8">
      <div class="md:w-1/4"></div>
      <div class="md:w-3/4">
        <div class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded inline-flex items-center cursor-pointer" @click="createShortCode()">
          <span>Generate Shortcode</span>
        </div>
        <div class="inline-flex float-right">
          <div class="bg-gray-300 hover:bg-gray-400 text-gray-800 text-white font-bold py-2 px-4 mr-2 text-base rounded-sm" v-if="forms.length>1" @click="forms.pop();showResult = false;">
            -
          </div>
          <div class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 text-base rounded-sm" @click="addForm();showResult = false;">
            +
          </div>
        </div>
      </div>
    </div>
    <div class="md:flex md:items-center mb-2 opacity-0" v-bind:class="{ show : showResult }">
      <div class="md:w-1/4">
        <label class="block text-gray-800 font-bold md:text-right mb-1 md:mb-0 pr-4">
          Salin Shortcode ini
        </label>
      </div>
      <div class="md:w-3/4">
        <textarea class="inputResult form-textarea appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 text-base" rows="30" name="text" ref="inputResult"></textarea>
      </div>
    </div>
</div>
</section>
