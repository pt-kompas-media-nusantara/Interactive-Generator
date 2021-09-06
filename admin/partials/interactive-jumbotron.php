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
<section class="jumbotronGenerator flex mt-10 w-full max-w-8xl" id="jumbotron">
    <section class="input_block w-full flex-1 mr-2">
        <div class="w-full">
            <div class="mt-8">
				<p class="block text-gray-800 mb-1 font-bold">Catatan:</p>
				<p class="block text-gray-800">- Setiap input dengan tanda <sup class="text-red-600 font-bold text-sm">*</sup> wajib diisi. Sisanya boleh dikosongkan.</p>
				<p class="block text-gray-800">- Pemberian <b>Sub Judul</b> tidak boleh sama dalam satu konten</p>
			</div>

            <!-- Jumbotron --> 
            <div class="md:flex md:items-center mb-2">
                <div class="md:w-1/4">
                    <label class="block text-gray-800 font-bold md:text-right mb-1 md:mb-0 pr-4">
                        Pilih gambar
                    </label>
                </div>
                <div class="md:w-4/6">
                    <input class="inputUrl bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="text" name="url" required placeholder="Wajib diisi" readonly hidden>
                    <img class="gallery-img-picked mb-2"
                        src="" v-model="selectedBackground"
                        alt="picked-img"
                        style="width:auto; height:100px; display:none;">
                    <input type="button" class="button upload_image_button" 
                        value="<?php _e( 'Upload gambar' ); ?>" @click="galleryOpenMedia()"
                    />
                </div>
            </div>

            <!-- shortcode -->
            <div class="md:flex md:items-center mb-8">
                <div class="md:w-1/4"></div>
                <div class="md:w-3/4">
                    <div class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded inline-flex items-center" @click="generateShortcode()">
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
                    <textarea class="inputResult form-textarea appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 text-base" rows="5" name="text" ref="inputResult"></textarea>
                </div>
            </div>
        </div>
    </section>
    <section class="preview_block w-full flex-1 mr-2">
        <div class="w-full bg-gray-500 h-full">
            <div v-bind:style="'background: url(' + selectedBackground + ') no-repeat center center / cover'" class="w-full h-full" >
            </div>
        </div>
    </section>
</section>