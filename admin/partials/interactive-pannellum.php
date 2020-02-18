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
 * @subpackage Plugin_Name/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<section class="galleryGenerator" id="app">
  <div class="w-full max-w-3xl">
    <div class="mb-8">
      <p class="block text-gray-800 mb-1 font-bold">Catatan:</p>
      <p class="block text-gray-800">- Setiap input dengan tanda <sup class="text-red-600 font-bold text-sm">*</sup> wajib diisi. Sisanya boleh dikosongkan.</p>
      <p class="block text-gray-800">- Pemberian <b>Judul</b> tidak boleh sama dalam satu konten</p>
      <p class="block text-gray-800">- Foto yang bisa digunakan adalah foto yang ada pada "media" di situs yang sama</p>
      <p class="block text-gray-800">- Pada setiap input pastikan tidak ada karakter <b>"</b> dan <b>'</b></p>
    </div>
  </div>
  <div class="w-full max-w-3xl">
    <div class="mb-2">
      <div class="md:flex md:items-center mb-2">
        <div class="md:w-1/4">
          <label class="block text-gray-800 font-bold md:text-right mb-1 md:mb-0 pr-4">
            Judul 360<sup class="text-red-600 font-bold text-sm">*</sup>
          </label>
        </div>
        <div class="md:w-1/4">
          <input class="inputId bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="text" name="view" required placeholder="Wajib diisi" ref="inputId">
        </div>
      </div>
    </div>
  </div>
  <div class="w-full max-w-3xl">
    <div class="mb-2">
      <div class="md:flex md:items-center mb-2">
        <div class="md:w-1/4">
          <label class="block text-gray-800 font-bold md:text-right mb-1 md:mb-0 pr-4">
            Link Gambar<sup class="text-red-600 font-bold text-sm">*</sup>
          </label>
        </div>
        <div class="md:w-3/4">
          <input class="inputUrl bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="text" name="url" required placeholder="Wajib diisi">
        </div>
      </div>
    </div>
    <div class="mb-2">
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
    </div>
    <div class="mb-4">
      <div class="md:flex md:items-center mb-2">
        <div class="md:w-1/4">
          <label class="block text-gray-800 font-bold md:text-right mb-1 md:mb-0 pr-4">
            Caption
          </label>
        </div>
        <div class="md:w-3/4">
          <textarea class="inputText form-textarea appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" rows="8" name="text"></textarea>
        </div>
      </div>
    </div>
    <div class="md:flex md:items-center mb-8">
      <div class="md:w-1/4"></div>
      <div class="md:w-3/4">
        <div class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded inline-flex items-center" @click="createShortCodePannellum()">
          <span>Generate Shortcode</span>
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
