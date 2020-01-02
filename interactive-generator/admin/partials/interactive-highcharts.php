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
      <p class="block text-gray-800">- Setiap input wajib diisi</p>
      <p class="block text-gray-800">- Pemberian <b>Judul</b> tidak boleh sama dalam satu konten</p>
      <p class="block text-gray-800">- Jangan lupa untuk mencentang salah satu jenis highcharts</p>
      <p class="block text-gray-800">- Dalam mode live build, setiap melakukan input, hasil highcharts bisa langsung dilihat pada bagian kanan.</p>
    </div>
  </div>
  <div class="min-height-100">
    <div id="bar-chart" class="w-full">
        <div class="w-full check-status active flex">
            <div class="w-6/12">
                <form class="form-horizontal" id="proses-form" v-on:submit.prevent="submitForm">
                    <div class="mb-6">
                        <h4 class="text-2xl mb-3">Jenis Highcharts</h4>
                        <div class="flex">
                            <div class="pr-2" v-for="jenis in jenisHighcharts">
                                <label class="radio-inline">
                                    <input type="radio" name="jenis" v-bind:value="jenis.val" v-model="pilihJenis" checked v-on:change.prevent="onChange" class="form-check-input">{{jenis.txt}}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-6">
                        <div class="w-full">
                            <h4 class="text-2xl mb-3">Judul</h4>
                            <input id="chart-title" name="chart-title" placeholder="Judul Highcharts" maxlength="100" class="border-2 border-gray-400 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" v-on:keyup.prevent="onChange" v-model.trim="charttitle">
                        </div>
                    </div>
                    <div class="mb-6">
                        <div class="w-full">
                            <h4 class="text-2xl mb-3">Sumber Data</h4>
                            <input id="chart-data-source" name="chart-data-source" placeholder="Sumber data" maxlength="100" class="border-2 border-gray-400 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" v-on:keyup.prevent="onChange">
                        </div>
                    </div>
                    <div class="mb-8">
                        <div class="w-full">
                            <h4 class="text-2xl mb-3">Data xAxis <span class="text-lg">- Data Horizontal (tahun, kota,nama benda)</span> </h4>
                            <div class="mb-3">
                                <label class="text-base mb-1 block">Judul xAxis</label>
                                <input maxlength="25" class="border-2 border-gray-400 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="judul_kolom" placeholder="Text" maxlength="100" v-on:keyup.prevent="onChange" v-model.trim="judulkolom">
                            </div>
                            <div class="flex">
                                <div class="w-2/4">
                                    <label class="text-base mb-1 block">Nama Kolom</label>
                                </div>
                                <div class="w-2/4 text-right">
                                    <label class="control-label"> 
                                        <a id="btn-add-table-column" class="text-green-600" v-on:click.prevent="addColumn" href="#">Tambah kolom</a>
                                        &nbsp;|&nbsp;
                                        <a id="btn-remove-table-column" class="text-red-600" v-on:click.prevent="removeColumn" href="#">Kurangi kolom</a>
                                    </label>
                                </div>
                            </div>
                            <div class="flex">
                                <div class="pr-2" v-for="x in column">
                                    <input maxlength="25" class="table-column-names border-2 border-gray-400 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" placeholder="ex: 2016" v-on:keyup.prevent="onChange">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-8">
                        <div class="w-full">
                            <h4 class="text-2xl mb-3">Data yAxis <span class="text-lg">- Data Vertical (jumlah, orang, kasus, kg)</span> </h4>
                            <div class="mb-3">
                                <label class="text-base mb-1 block">Judul yAxis</label>
                                <input maxlength="25" class="border-2 border-gray-400 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="judul_baris" placeholder="Text" maxlength="100" v-on:keyup.prevent="onChange" v-model.trim="judulbaris">
                            </div>
                            <div class="flex">
                                <div class="w-2/4">
                                    <label class="text-base mb-1 block">Baris Data (Angka)</label>
                                </div>
                                <div class="w-2/4 text-right">
                                    <a v-on:click.prevent="addTable" class="text-green-600" id="btn-add-table-row" href="#">Tambah Baris</a>
                                    &nbsp;|&nbsp;
                                    <a id="btn-dlt-table-row" class="text-red-600" v-on:click.prevent="removeTable" href="#">Kurangi Baris</a>
                                </div>
                            </div>
                            <div class="series-content">
                                <div class="table-rows mb-2 flex" v-for="d in row">
                                    <div class="pr-2" v-for="x in column">
                                        <input placeholder="Data/Angka" maxlength="25" class="table-rows-input border-2 border-gray-400 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" value="0" v-on:keyup.prevent="onChange">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-6">
                        <div class="w-full">
                            <h4 class="text-2xl mb-3">Label/Legenda</h4>
                            <div class="flex">
                                <div class="w-10/12">
                                    <label class="text-base mb-1 block">Nama Label (Sesuai dengan baris data)</label>
                                </div>
                                <div class="w-2/12">
                                    <label class="text-base mb-1 block pl-8">Warna</label>
                                </div>
                            </div>
                            <div class="legend-content flex mb-6" v-for="d in row">
                                <div class="w-10/12">
                                    <input type="text" placeholder="Label Data" maxlength="25" class="legend-name border-2 border-gray-400 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 legend-name" v-on:keyup.prevent="onChange">
                                </div>
                                <div class="w-2/12 pl-4">
                                    <input class="jscolor h-full w-full px-2 py-1" placeholder="Warna" type="color" value="#7cb5ec" v-on:change.prevent="onChange">
                                </div>
                            </div>
                            <div class="mb-6">
                                <h4 class="text-2xl mb-3">Posisi Legenda</h4>
                                <div class="flex">
                                    <div v-for="data in datalabels" class="pr-2">
                                        <label class="flex items-center">
                                            <input type="radio" name="posisilegend" v-bind:value="data.dta" checked v-on:change.prevent="onChange" class="form-check-input">{{data.txt}}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-12">
                        <div class="w-full text-right">
                            <button id="btn-submit" type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded inline-flex items-center">Generate Shortcode</button>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="w-full">
                            <h4 class="text-2xl mb-3">Salin kode berikut:</h4>
                        </div>
                        <div class="w-full">
                            <textarea id="chart-code" class="inputText form-textarea appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 text-base" rows="10"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="w-6/12">
                <div id="result" class="sticky top-0 pt-2"></div>
            </div>
        </div>
    </div>
  </div>
</div>
