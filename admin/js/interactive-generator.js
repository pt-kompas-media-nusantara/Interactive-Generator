( function ($) {
'use strict';

/**
 * All of the code for your admin-facing JavaScript source
 * should reside in this file.
*/

// intinya cuma looping input dengan class yg sama terus push ke array dan di jabarkan jadi text biasa
// pakai jQuery soalnya udah pernah bikin chart generator sebelum mengenal vue, jadi malas ubah2 lagi karena deadline sangat dekat

new Vue({
	el: '#app',
	data(){
    return {
			formCount: 1,
			showResult: false,
			timelineDate: [],
			timelineText: [],
			timelineUrl: [],
			datalabels: [
				{dta: 'ataskiri', txt: 'Atas Kiri'},
				{dta: 'atastengah', txt: 'Atas Tengah'},
				{dta: 'ataskanan', txt: 'Atas Kanan'},
				{dta: 'bawahkiri', txt: 'Bawah Kiri'},
				{dta: 'bawahkanan', txt: 'Bawah Kanan'},
				{dta: 'bawahtengah', txt: 'Bawah Tengah'}
			],
			jenisHighcharts: [
				{val: 'line', txt: 'Line'},
				{val: 'bar', txt: 'Balok'},
				{val: 'column', txt: 'Kolom'}
			],
			pilihJenis: '',
			chartsnames: '',
			charttitle: '',
			column: 2,
			judulkolom: '',
			judulbaris: '',
			row: 1,
			pierow: 2,
			chartstatus: true,
			piechartstatus: false,
		}
	},
	methods: {
		getInputTimeline(){
			this.timelineDate = [];
			this.timelineText = [];
			this.timelineUrl = [];
			for(var i=0;i<document.getElementsByClassName('inputDate').length;i++){
				this.timelineDate.push(document.getElementsByClassName('inputDate')[i].value);
			}
			for(var i=0;i<document.getElementsByClassName('inputText').length;i++){
				this.timelineText.push(document.getElementsByClassName('inputText')[i].value);
			}
			for(var i=0;i<document.getElementsByClassName('inputUrl').length;i++){
				this.timelineUrl.push(document.getElementsByClassName('inputUrl')[i].value);
			}
		},
		createShortCodeTimeline(){
			this.showResult = true;
			this.getInputTimeline();
			var data = '',
					idTimeline = this.$refs.inputId.value.split(' ').join('-'),
					titleTimeline = this.$refs.inputId.value;
			for(var i=0;i<document.getElementsByClassName('inputDate').length;i++){
				if(i == document.getElementsByClassName('inputDate').length-1){
					data += "{'date': '"+ this.timelineDate[i] +"', 'text': '"+ this.timelineText[i] +"','url': '"+ this.timelineUrl[i] +"'}"
				}else{
					data += "{'date': '"+ this.timelineDate[i] +"', 'text': '"+ this.timelineText[i] +"','url': '"+ this.timelineUrl[i] +"'},"
				}
			}
			var shortcode = "[Timeline name=\""+ idTimeline.toLowerCase() +"\" data=\""+ data +"\" title=\""+ titleTimeline +"\"/]";
			this.$refs.inputResult.value = shortcode;
		},
		createShortCodePannellum(){
			this.showResult = true;
			var idGallery = this.$refs.inputId.value.split(' ').join('-');
			var shortcode = "[Pannellum name=\""+ idGallery.toLowerCase() +"\" srcfile=\""+ document.getElementsByClassName('inputUrl')[0].value +"\" credit=\""+ document.getElementsByClassName('inputCredit')[0].value +"\" caption=\""+ document.getElementsByClassName('inputText')[0].value +"\"/]";
			this.$refs.inputResult.value = shortcode;
		},
		createShortCodeTwenty(){
			this.showResult = true;
			var shortcode = "[TwentyTwenty before=\""+ document.getElementsByClassName('inputUrla')[0].value +"\" beforeLabel=\""+ document.getElementsByClassName('inputLabela')[0].value +"\" after=\""+ document.getElementsByClassName('inputUrlb')[0].value +"\" afterLabel=\""+ document.getElementsByClassName('inputLabelb')[0].value +"\" credit=\""+ document.getElementsByClassName('inputCredit')[0].value +"\" caption=\""+ document.getElementsByClassName('inputText')[0].value +"\"/]";
			this.$refs.inputResult.value = shortcode;
		},
		charts(){
			this.chartstatus = true;
			this.piechartstatus = false;
			this.chartsnames = 'Bar dan Line Chart';
		},
		checkLgdAlign(lgd){
			var alg;
			switch(lgd){
				case 'atastengah':
					alg = 'center';
					break;
				case 'ataskiri':
					alg = 'left';
					break;
				case 'ataskanan':
					alg = 'right';
					break;
				case 'bawahtengah':
					alg = 'center';
					break;
				case 'bawahkiri':
					alg = 'left';
					break;
				case 'bawahkanan':
					alg = 'right';
					break;
			}
			return alg;
		},
		checkLgdValign(lgd){
			var vralg;
			switch(lgd){
				case 'atastengah':
					vralg = 'top';
					break;
				case 'ataskiri':
					vralg = 'top';
					break;
				case 'ataskanan':
					vralg = 'top';
					break;
				case 'bawahtengah':
					vralg = 'bottom';
					break;
				case 'bawahkiri':
					vralg = 'bottom';
					break;
				case 'bawahkanan':
					vralg = 'bottom';
					break;
			}
			return vralg;
		},
		addTable(){
			this.row+=1;
		},
		removeTable(){
			if(this.row>1){
				this.row-=1;
			}
		},
		addColumn(){
			this.column+=1;
		},
		removeColumn(){
			if(this.column>2){
				this.column-=1;
			}
		},
		createChart(a, b, c, d, e, f){
			Highcharts.chart('result', {
				colors: b,
				chart: {
					type: this.pilihJenis,
					backgroundColor: null
				},
				title: {
					text: this.charttitle
				},
				subtitle: {
					text: a,
					align: 'right',
					verticalAlign: 'bottom',
					floating: false,
				},
				xAxis: {
					categories: c,
					title: {
						text: this.judulkolom
					}
				},
				yAxis: {
					min: 0,
					title: {
						text: this.judulbaris
					},
					labels: {
						overflow: 'justify'
					}
				},
				tooltip: {
					shared: true
				},
				plotOptions: {
					bar: {
						dataLabels: {
							enabled: true
						}
					}
				},
				legend: {
					align: d,
					verticalAlign: e,
					floating: false,
					backgroundColor: null
				},
				credits: {
					enabled: false
				},
				series: f
			});
		},
		createBody(g, h, i, j, k, l, m, n){

			g = "[Highcharts id=\""+ h +"\" title=\""+ this.charttitle +"\" colors=\""+ i +"\" chartType=\""+ this.pilihJenis +"\" subtitleText=\""+ j +"\" xAxixCategories=\""+ k +"\" xAxisTitle=\""+ this.judulkolom +"\" yAxixTitle=\""+ this.judulbaris +"\" legendAlign=\""+ l +"\" legendVerAlign=\""+ m +"\" series=\""+ n +"\"/]"
				
			// return $('#chart-code').text(g);  
			return document.getElementById('chart-code').innerHTML = g;
		},
		onChange(){
			var nama_kolom = [];
			var all_warna = [];
			var all_warnaa = [];
			var nama_kolomm = [];
			var baris_data = [];
			var nama_legend = [];
			var alg;
			var vralg;
			var txt_sumber;
			
			var lgd = $('input[name=posisilegend]:checked').val();
				alg = this.checkLgdAlign(lgd);
				vralg = this.checkLgdValign(lgd);
			
			if($("#chart-data-source").val() != ''){
				txt_sumber = 'sumber: '+$("#chart-data-source").val().trim();
			}
			
			$('.table-column-names').each(function() {
				nama_kolom.push(this.value);
				nama_kolomm.push('\''+this.value+'\'');
			});
			$('.table-rows-input').each(function() {
				baris_data.push(this.value);
			});
			$('.jscolor').each(function() {
				all_warna.push(this.value);
				all_warnaa.push('\''+this.value+'\'');
			});
			baris_data.map(function (x) { 
				return parseInt(x, 10); 
			});
			$("input.legend-name").each(function() {
				nama_legend.push(this.value);
			});
			
				
			var i,j,k=0, a=0, b=[], d=[[],[],[],[],[],[],[],[],[],[],[],[],[],[],[],[],[],[],[],[],[],[],[],[],[],[],[],[],[],[]];//max 30 baris data
			for(i=0;i<$('.series-content .table-rows').length;i++){
				b[i] = nama_legend[i];
			}
			
			var jml = $('.table-column-names').length;
			for(j=0;j<baris_data.length;j++){
				if(j==jml){
						k=k+1;
						jml=jml+$('.table-column-names').length;
						a=0;
				}
				d[k][a] = baris_data[j];
				a=a+1;
			}
			
			var jk, all_data=[], data_oke=[];
			for(jk=0;jk<$('.legend-name').length;jk++){
				b[jk];
				parseInt(d[jk], 10);
				all_data.push('{name: \''+b[jk]+'\', data: ['+d[jk]+']}\n');
				data_oke.push(JSON.parse('{"name": "'+b[jk]+'", "data": ['+d[jk]+']}'));
			}
			
			$('#chart-code').text('').css({'height': 'auto'});
			this.createChart(txt_sumber, all_warna, nama_kolom, alg, vralg, data_oke);
					
		},
		submitForm(){
			var theId = this.charttitle.replace(/ /g,'').toLowerCase();
			var nama_kolom = [];
			var all_warna = [];
			var all_warnaa = [];
			var nama_kolomm = [];
			var baris_data = [];
			var nama_legend = [];
			var code;
			var alg;
			var vralg;
			var txt_sumber;
			var sumber_tx;
			
			var lgd = $('input[name=posisilegend]:checked').val();
			alg = this.checkLgdAlign(lgd);
			vralg =  this.checkLgdValign(lgd);
			
			if($("#chart-data-source").val() != ''){
				txt_sumber = 'sumber: '+$("#chart-data-source").val().trim();
				sumber_tx = $("#chart-data-source").val().trim();
			}
			
			$('.table-column-names').each(function() {
				nama_kolom.push(this.value);
				nama_kolomm.push('\''+this.value+'\'');
			});
			$('.table-rows-input').each(function() {
				baris_data.push(this.value);
			});
			$('.jscolor').each(function() {
				all_warna.push(this.value);
				all_warnaa.push('\''+this.value+'\'');
			});
			baris_data.map(function (x) { 
				return parseInt(x, 10); 
			});
			$("input.legend-name").each(function() {
				nama_legend.push(this.value);
			});
			
				
			var i,j,k=0, a=0, b=[], d=[[],[],[],[],[],[],[],[],[],[],[],[],[],[],[],[],[],[],[],[],[],[],[],[],[],[],[],[],[],[]];//max 30 baris data
			for(i=0;i<$('.series-content .table-rows').length;i++){
				b[i] = nama_legend[i];
			}
			
			var jml = $('.table-column-names').length;
			for(j=0;j<baris_data.length;j++){
				if(j==jml){
					k=k+1;
					jml=jml+$('.table-column-names').length;
					a=0;
				}
				d[k][a] = baris_data[j];
				a=a+1;
			}
			
			var jk, all_data=[], data_oke=[];
			for(jk=0;jk<$('.legend-name').length;jk++){
				b[jk];
				parseInt(d[jk], 10);
				all_data.push('{\'name\': \''+b[jk]+'\', \'data\': ('+d[jk]+')}');
				data_oke.push(JSON.parse('{"name": "'+b[jk]+'", "data": ['+d[jk]+']}'));
			}
			
			var createBody = this.createBody(code, theId, all_warna, txt_sumber, nama_kolom, alg, vralg, all_data);
			var createChrt = this.createChart(txt_sumber, all_warna, nama_kolom, alg, vralg, data_oke);
			
			$('#proses-form input').each(function() {
				if($(this).val()==''){
					$(this).css('background','#ffe9e9');
					$('#chart-code').text('Semua Kolom Harus Diisi').css({'height': 'auto', 'font-size': '16px'});
				}
				else{
					createBody;
					createChrt;
				}
			});	
		},
		pieChart(){
			this.chartstatus = false;
			this.piechartstatus = true;
			this.chartsnames = 'Pie Chart';
		},
		addTablePie(){
			this.pierow+=1;
		},
		removeTablePie(){
			if(this.pierow>2){
				this.pierow-=1;
			}
		},
		createPieChart(a, f){
			Highcharts.chart('pieresult', {
				chart: {
					backgroundColor: 'transparent',
					plotBackgroundColor: null,
					plotBorderWidth: null,
					plotShadow: false,
					type: 'pie'
				},
				title: {
					text: $('#pie-chart-title').val().trim()
				},
				subtitle: {
					text: a,
					align: 'right',
					verticalAlign: 'bottom',
					floating: false,
				},
				tooltip: {
					valuePrefix: $("#value-prefix").val()+' ',
					valueSuffix: ' '+$("#value-suffix").val()
				},
				plotOptions: {
					pie: {
						allowPointSelect: true,
						cursor: 'pointer',
						dataLabels: {
								enabled: true,
						}
					}
				},
				credits: {
					enabled: false
				},
				series: [{
					name: $('#data-value-name').val(),
					colorByPoint: true,
					sliced: true,
					selected: true,
					data: f
				}],
			});
		},
		createPieBody(g, h, i, j, n){

			g = "[Piecharts id=\""+h+"\" title=\""+$('#pie-chart-title').val().trim()+"\" subtitle=\""+j+"\" prefix=\""+$('#value-prefix').val()+"\" suffix =\""+$('#value-suffix').val()+"\" seriesname=\""+$('#data-value-name').val()+"\" data=\""+n+"\" /]"

			return $('#chart-code-pie').text(g);  
		},
		onChangePie(){
			var nama_kolom = [];
			var all_warna = [];
			var all_warnaa = [];
			var nama_kolomm = [];
			var baris_data = [];
			var txt_sumber;
			
			
			if($("#pie-chart-data-source").val() != ''){
				txt_sumber = 'sumber: '+$("#pie-chart-data-source").val().trim();
			}
			
			$('.pie-data-title').each(function() {
				nama_kolom.push(this.value);
				nama_kolomm.push('\''+this.value+'\'');
			});
			
			$('.pie-data').each(function() {
				baris_data.push(this.value);
			});
			$('.jscolorpie').each(function() {
				all_warna.push(this.value);
				all_warnaa.push('\''+this.value+'\'');
			});
			baris_data.map(function (x) { 
				return parseInt(x, 10); 
			});
			
			var jk, all_data=[], data_oke=[];
			for(jk=0;jk<$('.pie-data-content').length;jk++){
				all_data.push('{name: \''+nama_kolom[jk]+'\', y: '+baris_data[jk]+', color: \''+all_warna[jk]+'\'}\n');
				data_oke.push(JSON.parse('{"name": "'+nama_kolom[jk]+'", "y": '+parseInt(baris_data[jk],10)+', "color": "'+ all_warna[jk] +'"}'));
			}
			
			$('#chart-code-pie').text('').css({'height': 'auto'});
			this.createPieChart(txt_sumber, data_oke);
		},
		submitPieForm(){
			var theId = $('#pie-chart-title').val().replace(/ /g,'').toLowerCase();
			var nama_kolom = [];
			var all_warna = [];
			var all_warnaa = [];
			var nama_kolomm = [];
			var baris_data = [];
			var txt_sumber;
			var code;

			if($("#pie-chart-data-source").val() != ''){
				txt_sumber = 'sumber: '+$("#pie-chart-data-source").val().trim();
			}
			
			$('.pie-data-title').each(function() {
				nama_kolom.push(this.value);
				nama_kolomm.push('\''+this.value+'\'');
			});
			
			$('.pie-data').each(function() {
				baris_data.push(this.value);
			});
			$('.jscolorpie').each(function() {
				all_warna.push(this.value);
				all_warnaa.push('\''+this.value+'\'');
			});
			baris_data.map(function (x) { 
				return parseInt(x, 10); 
			});
			
			var jk, all_data=[], data_oke=[];
			for(jk=0;jk<$('.pie-data-content').length;jk++){
				all_data.push('{\'name\': \''+nama_kolom[jk]+'\', \'y\': '+baris_data[jk]+', \'color\': \''+all_warna[jk]+'\'}');
				data_oke.push(JSON.parse('{"name": "'+nama_kolom[jk]+'", "y": '+parseInt(baris_data[jk],10)+', "color": "'+ all_warna[jk] +'"}'));
			}
			
			this.createPieChart(txt_sumber, data_oke);
			this.createPieBody(code, theId, all_warnaa, txt_sumber, all_data);
		},
		galleryOpenMedia(idx) {
			var file_frame;
			file_frame = wp.media.frames.file_frame = wp.media({
				title: 'Pilih gambar untuk di upload',
				button: {
					text: 'Gunakan gambar ini',
				},
				multiple: false // Set to true to allow multiple files to be selected
			});
			file_frame.on( 'select', function() {
				var attachment = file_frame.state().get('selection').first().toJSON();
				document.getElementsByClassName('gallery-img-picked')[idx-1].style.display = 'block'
				document.getElementsByClassName('gallery-img-picked')[idx-1].src = attachment.url
				document.getElementsByClassName('inputUrl')[idx-1].value = attachment.url
			});
			file_frame.open();
		}
	},
	mounted() {
		this.chartstatus = true;
    	this.$nextTick( () => {
			
		});
	},
});
}(jQuery));
