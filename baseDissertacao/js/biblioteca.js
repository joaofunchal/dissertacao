objPrecision = null;
objRecall = null;
function processar(e){
	if(e.keyCode == 13 ){
		if($("#pesquisa").val().length < 2)
			return;		
		$.ajax({
			type: "POST",
			data: { campo_pesquisa: $('#pesquisa').val()}, 
			url: "gerenciador.php",
			success: function(ranking){
				reposta = ranking.split('***');
				$("#resposta").html(reposta[0]);
				$("#tabela").html(reposta[1]);
			},
			async:true 
		});
	}
}

$( document ).ajaxStart(function() {
	$('#loadingDiv').show();
});

$( document ).ajaxStop(function() {
	 setTimeout(function () {
		 $('#loadingDiv').hide();
     }, 2000);
});

function obterDados(){
	var favoritos = [];
	$("[name='docFavorito']:checked").each(function(){
		favoritos.push(this.value);
	});
	
	$.ajax({
		type: "POST",
		data: {
			campo_pesquisa: $('#pesquisa').val(),
			docFavoritos: favoritos.toString()
		}, 
		url: "gerenciador.php",
		success: function(ranking){
			reposta = ranking.split('***');
			//console.table(reposta);
			$("#resposta").html(reposta[0]);
			$("#tabela").html(reposta[1]);
			$("#precision").val(reposta[2]+' %');
			$("#recall").val(reposta[3]+' %');
			$("#medidaF").val(reposta[4]+' %');
			$("#avgp").val(reposta[5]+' %');
			objPrecision = jQuery.parseJSON(reposta[6]);
     		objRecall = jQuery.parseJSON(reposta[7]);
     		google.charts.setOnLoadCallback(drawChart);
     		objPrecision = jQuery.parseJSON(reposta[6]);
     		objRecall = jQuery.parseJSON(reposta[7]);
     		google.charts.setOnLoadCallback(drawChartTodosPontos);
		},
		async:true 
	});
};

function drawChart(){
	var data = new google.visualization.DataTable();
	data.addColumn('number', 'X');
	data.addColumn('number', 'Normal');
	data.addColumn('number', 'Interpolada');
	obj = {};
	var cont = 0;
	var cont2 = 0;
	objMax = [];
	objPrecision2 = [];
	objRecall2 = [];
	for(var i in objPrecision){
		objMax[cont2] = objPrecision[i];
		objPrecision2[cont2] = objPrecision[i];
		objRecall2[cont2] = objRecall[i]
		cont2++;
	}
	var area = [];
	for(var i = 0; i <= 10; i++){
		//console.log(objRecall2[i],objPrecision2[i],i);
		
		if(typeof objRecall2[i] != "undefined"){
			//console.log(i <= Math.max.apply(Math,objRecall2),i,objRecall2,Math.max.apply(Math,objRecall2));
			if(i*10 <= Math.max.apply(Math,objRecall2))
				obj[i] = [Math.ceil(i*10),objPrecision2[i],Math.max.apply(Math,objMax)];
			else
				obj[i] = [Math.ceil(i*10),0,0];
			area[i] = ((objPrecision2[i]+objPrecision2[i+1])/2)*(objRecall2[i+1]-objRecall2[i]);
		}else{
			obj[i] = [i*10,0,0];
		}
		objMax.shift();
		

	}
	area.pop();
	var vArea = area.reduce((a, b) => a + b, 0);
	$('#Area11Pt').val(vArea.toFixed(2));
	var obj = $.map(obj, function(value, index) {
	    return [value];
	});
    data.addRows(obj);
    var options = {
       	title: 'Gráfico 11 pontos',
		hAxis: {
			title: 'Recall'
		},
		pointSize: 10,
		vAxis: {
			title: 'Precision'
		},
		series: {
			1: {curveType: 'none'}
		},
//		trendlines: {
//	       0: {
//	    	   type: 'exponential',
//	    	   pointSize: 10,
//	    	   pointsVisible: false
//	       },
//	       1: {
//	    	   type: 'exponential',
//	    	   pointSize: 10,
//	    	   pointsVisible: false
//	       }
//	    }
     };
     var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
     chart.draw(data, options);
     
	 obj = {};
     objPrecision = [];
	 objRecall = [];
}


function drawChartTodosPontos(){
	var data = new google.visualization.DataTable();
	data.addColumn('number', 'X');
	data.addColumn('number', 'Normal');
	data.addColumn('number', 'Interpolada');
	obj = {};
	var cont = 0;
	var cont2 = 0;
	objMax = [];
	objPrecision2 = [];
	objRecall2 = [];
	for(var i in objPrecision){
		objMax[cont2] = objPrecision[i];
		objPrecision2[cont2] = objPrecision[i];
		objRecall2[cont2] = objRecall[i]
		cont2++;
	}

	var area = [];
	for(var i = 0; i < objRecall2.length; i++){
		//console.log(objRecall2[i],objPrecision2[i],i);
		
		if(typeof objRecall2[i] != "undefined")
			obj[i] = [Math.ceil(objRecall2[i]),objPrecision2[i],Math.max.apply(Math,objMax)];
		else{
			obj[i] = [i*10,0,0];
		}
		objMax.shift();
		area[i] = ((objPrecision2[i]+objPrecision2[i+1])/2)*(objRecall2[i+1]-objRecall2[i]);
		
	}
	area.pop();
	var precTodosPontos = (objPrecision2.reduce((a, b) => a + b, 0))/objPrecision2.length;
	//console.log('precisao',precTodosPontos,objPrecision2);
	$('#preciTodosPontos').val(precTodosPontos.toFixed(2)+' %');
	var vArea = area.reduce((a, b) => a + b, 0);
	$('#AreaPts').val(vArea.toFixed(2));
	var obj = $.map(obj, function(value, index) {
	    return [value];
	});
	
	//console.table(obj);
    data.addRows(obj);
    var options = {
    	title: 'Gráfico todos pontos',
		hAxis: {
			title: 'Recall'
		},
		pointSize: 10,
		vAxis: {
			title: 'Precision'
		},
		series: {
			1: {curveType: 'none'}
		},
     };
     var chartTodosPontos = new google.visualization.LineChart(document.getElementById('curve_chart2'));
     chartTodosPontos.draw(data, options);
     
	 obj = {};
     objPrecision = [];
	 objRecall = [];
}



function habilitarBotao(){
	if($("[name='docFavorito']").is(':checked')){
		$('#buscarDados').css('visibility','visible');
		$('.dados').css('visibility','visible');
	}else{
		$('#buscarDados').css('visibility','hidden');
		$('.dados').css('visibility','visible');
	}	
}

