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
<section class="subtitleGenerator flex mt-10 w-full max-w-8xl" id="subtitle">
	<section class="input_block w-full flex-1 mr-2">
		<div class="w-full">
			<div class="mt-8">
				<p class="block text-gray-800 mb-1 font-bold">Catatan:</p>
				<p class="block text-gray-800">- Setiap input dengan tanda <sup class="text-red-600 font-bold text-sm">*</sup> wajib diisi. Sisanya boleh dikosongkan.</p>
				<p class="block text-gray-800">- Pemberian <b>Sub Judul</b> tidak boleh sama dalam satu konten</p>
			</div>
		</div>
		<!-- Subjudul --> 
		<div class="w-full max-w-3xl mb-4">
			<div class="mt-4">
				<div class="md:flex md:items-center mb-2">
					<div class="md:w-1/4">
						<label class="block text-gray-800 font-bold md:text-right mb-1 md:mb-0 pr-4">
							Sub Judul<sup class="text-red-600 font-bold text-sm">*</sup>
						</label>
					</div>
					<div class="md:w-3/4">
						<input 
							v-model="subtitleResult"
							class="inputId bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" 
							type="text" maxlength="120"
							name="view" required 
							placeholder="Wajib diisi" ref="inputId">
					</div>
				</div>
			</div>
		</div>

		<!-- fontSize Text --> 
		<div class="md:flex md:items-center mb-4">
			<div class="md:w-1/4">
				<label class="block text-gray-800 font-bold md:text-right mb-1 md:mb-0 pr-4">
					Ukuran Subjudul
				</label>
			</div>
			<div class="md:w-3/4">
				<select id="fontsize" name="fontsize" v-model="selectedFontSize">
					<option value="32">Small</option>
					<option value="36">Medium</option>
					<option value="40">Large</option>
				</select>
			</div>
		</div>

		<!-- Subjudul Background --> 
		<div class="md:flex md:items-center mb-4">
			<div class="md:w-1/4">
				<label class="block text-gray-800 font-bold md:text-right mb-1 md:mb-0 pr-4">
					Link Gambar
				</label>
			</div>
			<div class="md:w-4/6">
				<input class="inputUrl bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="text" name="url" required placeholder="Wajib diisi" readonly hidden>
				
				<img class="gallery-img-picked mb-2 relative" 
					src="" v-model="selectedBackground"
					alt="picked-img" 
					style="width:auto; height:100px; display:none;">
				<input type="button" class="button upload_image_button" value="<?php _e( 'Upload gambar' ); ?>" @click="galleryOpenMedia()" />
				<div @click="removeMedia()" class="close_media md:w-1/3 rounded uppercase p-1 text-center cursor-pointer bg-red-400 hidden">Hapus Gambar</div>
			</div>
		</div>

		<!-- Generate Shortcode --> 
		<div class="md:flex md:items-center mb-8 mt-8">
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
	</section>
	
	<!-- Preview Section -->
	<section class="preview_block w-full flex-1">
		<div class=" h-full flex justify-center items-center">
			<div class="preview-text flex justify-center max-w-2xl md:w-full py-16 bg-black bg-cover bg-center"
				:class="{ show: showResult }"
				:style="'background-image: url(' + selectedBackground + ')'">
				<p class="text-left text-white" v-bind:style="'font-size: ' + selectedFontSize + 'px'">{{ subtitleResult }}</p>
			</div>
		</div>
	</section>
</section>