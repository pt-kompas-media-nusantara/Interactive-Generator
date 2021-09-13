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
				<p class="block text-gray-800 mb-4 font-bold">Catatan:</p>
				<p class="block text-gray-800 mb-4">- Setiap input dengan tanda <sup class="text-red-600 font-bold text-sm">*</sup> wajib diisi. Sisanya boleh dikosongkan.</p>
			</div>

            <!-- Jumbotron Type --> 
            <div class="md:flex md:items-center mb-2">
                <div class="md:w-1/4">
                    <label class="block text-gray-800 font-bold md:text-right mb-1 md:mb-0 pr-4">
                        Tipe Jumbotron
                    </label>
                </div>
                <div class="md:w-4/6">
                    <select id="jumbotronType" name="jumbotronType" v-model="jumbotronType">
                        <option value="Image">Image</option>
                        <option value="Video">Video</option>
                    </select>
                </div>
            </div>

            <!-- Include Excerpt on Jumbotron Checkbox --> 
            <div class="md:flex md:items-center mb-2">
                <div class="md:w-1/4">
                    <label class="block text-gray-800 font-bold md:text-right mb-1 md:mb-0 pr-4">
                        Sertakan excerpt?<sup class="text-red-600 font-bold text-sm">*</sup>
                    </label>
                </div>
                <div class="md:w-4/6">
                    <select v-model="useExcerpt">
                        <option value="true">Yes</option>
                        <option value="false">No</option>
                    </select>
                </div>
            </div>

            <!-- Input Url -->
            <div class="md:flex md:items-center mb-2">
                <div class="md:w-1/4">
                    <label class="block text-gray-800 font-bold md:text-right mb-1 md:mb-0 pr-4">
                        Input<sup class="text-red-600 font-bold text-sm">*</sup>
                    </label>
                </div>
                <div class="md:w-3/4">
                    <input class="inputUrl bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="text" name="url" required placeholder="Wajib diisi" readonly hidden>

                    <img class="gallery-img-picked mb-2 relative" 
                        v-if="jumbotronType === 'Image'"
                        src="" v-model="selectedBackground"
                        alt="picked-img"
                        style="width:auto; height:100px; display:none;">

                    <div @click="removeMedia()" v-if="jumbotronType === 'Image'"
                    class="close_media md:w-1/3 rounded uppercase p-1 text-center cursor-pointer bg-red-400 hidden">Hapus Gambar</div>

                    <input type="button" 
                        v-if="jumbotronType === 'Image'"
                        class="button upload_image_button"
                        value="<?php _e( 'Upload gambar' ); ?>" @click="galleryOpenMedia()"
                    />

                    <input v-else v-model="videoSource"
                        class="inputId gallery-vid-picked bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" 
                        type="text" maxlength="120"
                        name="view" required 
                        placeholder="Paste url video disini" ref="inputId"
                    />
                </div>
            </div>

            <!-- Title Input --> 
            <div class="md:flex md:items-center mb-2">
                <div class="md:w-1/4">
                    <label class="block text-gray-800 font-bold md:text-right mb-1 md:mb-0 pr-4">
                        Judul
                    </label>
                </div>
                <div class="md:w-3/4">
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

            <!-- Title Position, Color, Align -->
            <div class="md:flex md:items-center mb-2">
                <div class="md:w-1/4">
                    <label class="block text-gray-800 font-bold md:text-right mb-1 md:mb-0 pr-4">
                        Letak Judul
                    </label>
                </div>
                <div class="md:w-3/4 md:flex">
                    <div class="md:w-1/3">
                        <select id="titlePosition" name="titlePosition" v-model="titlePos">
                            <option value="center">Center</option>
                            <option value="center-top">Center Top</option>
                            <option value="center-bottom">Center Bottom</option>
                            <option value="left">Left Center</option>
                            <option value="left-top">Left Top</option>
                            <option value="left-bottom">Left Bottom</option>
                            <option value="right">Right Center</option>
                            <option value="right-top">Right Top</option>
                            <option value="right-bottom">Right Bottom</option>
                        </select>
                    </div>

                    <!-- Title Color -->
                    <div class="md:w-1/3">
                        <div class="md:flex md:items-center mb-2">
                            <div class="md:w-1/4 mr-2">
                                <label class="block text-gray-800 font-bold md:text-right mb-1 md:mb-0 pr-4">
                                    Warna
                                </label>
                            </div>
                            <div class="md:w-3/4">
                                <select id="titlePosition" name="titlePosition" v-model="titleColor">
                                    <option value="black">Black</option>
                                    <option value="white">White</option>
                                    <option value="theme">Tema</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="md:w-1/3">
                        <div class="md:flex md:items-center mb-2">
                            <div class="md:w-1/4 mr-2">
                                <label class="block text-gray-800 font-bold md:text-right mb-1 md:mb-0 pr-4">
                                    Align
                                </label>
                            </div>
                            <div class="md:w-3/4">
                                <select id="titlePosition" name="titlePosition" v-model="alignText">
                                    <option value="center">Center</option>
                                    <option value="left">Left</option>
                                    <option value="right">Right</option>
                                </select>
                            </div>
                        </div>
                    </div>
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
    </section>
    <section class="preview_block w-full flex-1">
        <div class="flex relative w-full h-full" :class="titlePosResult">
            <div class="w-full bg-gray-500 h-full absolute top-0 left-0">
                <div class="w-full h-full flex bg-cover bg-center"
                    v-if="jumbotronType == 'Image'"
                    :style="'background-image: url(' + selectedBackground + ')'"
                    >
                </div>
                <video v-if="jumbotronType == 'Video'" 
                    class="w-full h-full flex absolute top-0 left-0 object-cover object-center" id="jumbotronVideo" autoplay loop muted
                    poster="https://interaktif.kompas.id/wp-content/uploads/sites/316/2021/06/panji_koming_vid_poster.jpg"
                    :src="selectedVideo"
                    >
                </video>
            </div>
            <p class="text-3xl rounded max-w-screen-sm p-4 lg:p-12 max-w-2xl z-10 break-words"
                :class="alignTextResult"
                :style="'color:' + titleColor"
                style="text-shadow: 3px 2px 12px rgb(0 0 0 / 92%);"
                >
                {{ subtitleResult }}
            </p>
        </div>
    </section>
</section>