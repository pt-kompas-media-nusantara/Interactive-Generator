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
<div id='app' class="container-fluid mt-10">
  <div class="w-full max-w-3xl">
    <div class="mb-8">
      <p class="block text-gray-800 mb-1 font-bold">Catatan:</p>
      <p class="block text-gray-800">- Setiap input wajib diisi. Kecuali Satuan Data yang bisa dikosongkan apabila tidak diperlukan.</p>
      <p class="block text-gray-800">- Pemberian <b>Judul</b> tidak boleh sama dalam satu konten</p>
      <p class="block text-gray-800">- Dalam mode live build, setiap melakukan input, hasil highcharts bisa langsung dilihat pada bagian kanan.</p>
      <p class="block text-gray-800">- Pada setiap input pastikan tidak ada karakter <b>"</b> dan <b>'</b></p>
    </div>
  </div>
  <div class="min-height-100">
    <div id="bar-chart" class="w-full">
        <div class="w-full check-status active flex charts">
            <div class="w-6/12">
                <form class="form-horizontal" v-on:submit.prevent="submitPieForm" id="pie-form">
                    <div class="mb-6">
                        <h4 class="text-2xl mb-3">Judul</h4>
                        <input id="pie-chart-title" name="pie-chart-title" placeholder="Judul Highcharts" maxlength="100" class="border-2 border-gray-400 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" v-on:keyup.prevent="onChangePie">
                    </div>
                    <div class="mb-10">
                        <h4 class="text-2xl mb-3">Sumber Data</h4>
                        <input id="pie-chart-data-source" name="pie-chart-data-source" placeholder="Sumber data" maxlength="100" class="border-2 border-gray-400 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" v-on:keyup.prevent="onChangePie">
                    </div>
                    <div class="mb-10">
                        <h4 class="text-2xl mb-3">Baris Data</h4>
                        <div class="flex">
                            <div class="w-5/12 px-1">
                                <label class="text-base mb-1 block">Judul Data</label>
                            </div>
                            <div class="w-3/12 px-1">
                                <label class="text-base mb-1 block">Baris Data(Angka)</label>
                            </div>
                            <div class="w-1/12 px-1">
                                <label class="text-base mb-1 block">Warna</label>
                            </div>
                            <div class="w-3/12 px-1 text-right">
                                <a v-on:click.prevent="addTablePie" class="text-green-600" href="#">Tambah Baris</a>
                            </div>
                        </div>
                        <div class="pie-data-content flex mb-2 items-center" v-for="d in pierow">
                            <div class="w-5/12 px-1">
                                <input placeholder="Judul Data" maxlength="25" class="border-2 border-gray-400 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 pie-data-title" v-on:keyup.prevent="onChangePie">
                            </div>
                            <div class="w-3/12 px-1">
                                <input class="border-2 border-gray-400 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 pie-data" v-on:keyup.prevent="onChangePie" value="0">
                            </div>
                            <div class="w-1/12 px-1">
                                <input class="jscolorpie" placeholder="Warna" type="color" value="#7cb5ec" v-on:change.prevent="onChangePie">
                            </div>
                            <div class="w-3/12 px-1 text-right">
                                <a class="text-red-600" v-on:click.prevent="removeTablePie" href="#">Kurangi Baris</a>
                            </div>
                        </div>
                    </div>
                    <div class="mb-10">
                        <div class="col-12">
                            <h4 class="text-2xl mb-3">Label Data <span class="text-lg">- Berat, Luas, Jumlah, Tahun</span></h4>
                            <label class="text-base mb-1 block">Judul Label Data</label>
                            <input id="data-value-name" name="data-value-name" placeholder="ex: Berat" maxlength="100" class="border-2 border-gray-400 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 pie-data" v-on:keyup.prevent="onChangePie">
                        </div>
                    </div>
                    <div class="mb-6">
                        <div class="col-12">
                            <h4 class="text-2xl mb-3">Satuan Data <span class="text-lg">- Sebelum/sesudah data(Rp, Kg/tahun, %, Kasus) - Kosongkan apabila kosong</span></h4>
                            <div class="flex">
                                <div class="w-6/12">
                                    <label class="text-base mb-1 block">Sebelum data</label>
                                </div>
                                <div class="w-6/12">
                                    <label class="text-base mb-1 block">Setelah data</label>
                                </div>
                            </div>
                            <div class="flex">
                                <div class="w-6/12 px-1">
                                    <input id="value-prefix" name="value-prefix" placeholder="ex: Rp" maxlength="100" class="border-2 border-gray-400 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 pie-data" v-on:keyup.prevent="onChangePie">
                                </div>
                                <div class="w-6/12 px-1">
                                    <input id="value-suffix" name="value-suffix" placeholder="ex: Kg" maxlength="100" class="border-2 border-gray-400 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 pie-data" v-on:keyup.prevent="onChangePie">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-6">
                        <div class="col-12 text-right">
                            <button id="btn-submit" type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded inline-flex items-center">Generate Shortcode</button>
                        </div>
                    </div>
                    <div class="mb-6">
                        <div class="w-full">
                            <h4 class="text-2xl mb-3">Salin kode berikut:</h4>
                        </div>
                        <div class="w-full">
                            <textarea id="chart-code-pie" class="inputText form-textarea appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 text-base" rows="10"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="w-6/12">
                <div id="pieresult" class="sticky top-0 pt-2" style="top: 62px;"></div>
            </div>
        </div>
    </div>
  </div>
</div>
