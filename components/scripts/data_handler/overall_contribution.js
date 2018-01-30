function line_chart(data,id){
	  var lineChartCanvas = $("#"+id).get(0).getContext("2d");
	  var lineChart = new Chart(lineChartCanvas);
	  
	  var lineChartOptions = {
		 //Boolean - If we should show the scale at all
		showScale: true,
		//Boolean - Whether grid lines are shown across the chart
		scaleShowGridLines: false,
		//String - Colour of the grid lines
		scaleGridLineColor: "rgba(0,0,0,.05)",
		//Number - Width of the grid lines
		scaleGridLineWidth: 1,
		//Boolean - Whether to show horizontal lines (except X axis)
		scaleShowHorizontalLines: true,
		//Boolean - Whether to show vertical lines (except Y axis)
		scaleShowVerticalLines: true,
		//Boolean - Whether the line is curved between points
		bezierCurve: true,
		//Number - Tension of the bezier curve between points
		bezierCurveTension: 0.3,
		//Boolean - Whether to show a dot for each point
		pointDot: false,
		//Number - Radius of each point dot in pixels
		pointDotRadius: 4,
		//Number - Pixel width of point dot stroke
		pointDotStrokeWidth: 1,
		//Number - amount extra to add to the radius to cater for hit detection outside the drawn point
		pointHitDetectionRadius: 20,
		//Boolean - Whether to show a stroke for datasets
		datasetStroke: true,
		//Number - Pixel width of dataset stroke
		datasetStrokeWidth: 2,
		//Boolean - Whether to fill the dataset with a color
		datasetFill: true,
		//String - A legend template
		legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
		//Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
		maintainAspectRatio: true,
		//Boolean - whether to make the chart responsive to window resizing
		responsive: true
		//tooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= addCommas(value) %>"
  };
  lineChartOptions.datasetFill = false;
  lineChart.Line(data, lineChartOptions);
  
   //then you just need to generate the legend
  //var legend = lineChart.generateLegend();

  //and append it to your page somewhere
  //$('#lineChart').append(legend);
}

function bar_chart(data,id){
	  var barChartCanvas = $("#"+id).get(0).getContext("2d");
	  var barChart = new Chart(barChartCanvas);
	  
	  var barChartOptions = {
		showScale: true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines: true,
		showDatasetLabels : true,
		scaleShowLabels:true,
		scaleFontSize: 10,
		scaleLineColor: 'transparent',
      //barPercentage : 10,
		barValueSpacing: 15,
      //Number - Width of the grid lines
      scaleGridLineWidth: 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines: true,
      //Boolean - Whether the line is curved between points
      bezierCurve: false,
      //Number - Tension of the bezier curve between points
      bezierCurveTension: 0.3,
      //Boolean - Whether to show a dot for each point
      pointDot: false,
      //Number - Radius of each point dot in pixels
      pointDotRadius: 4,
      //Number - Pixel width of point dot stroke
      pointDotStrokeWidth: 5,
      //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
      pointHitDetectionRadius: 20,
      //Boolean - Whether to show a stroke for datasets
      datasetStroke: true,
      //Number - Pixel width of dataset stroke
      datasetStrokeWidth: 2,
      //Boolean - Whether to fill the dataset with a color
      datasetFill: true,
      //String - A legend template
		legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>",
      //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio: true,
      //Boolean - whether to make the chart responsive to window resizing
		responsive: true
		//tooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= addCommas(value) %>"
  };
  barChartOptions.datasetFill = false;
  barChart.Bar(data, barChartOptions);
  
   //then you just need to generate the legend
  //var legend = lineChart.generateLegend();

  //and append it to your page somewhere
  //$('#lineChart').append(legend);
}



function load_overall_contribution_chart(base_url){
	var csrf_test_name = $("input[name=csrf_test_name]").val();
	var _labels = [];
	
	window.dataSet2 = {
		LAZADA: [],
		PROPELLER: []
	};
	
	window.chartColors = {
		red: 'rgb(255, 99, 132)',
		orange: 'rgb(255, 159, 64)',
		yellow: 'rgb(255, 205, 86)',
		green: 'rgb(75, 192, 192)',
		blue: 'rgb(54, 162, 235)',
		purple: 'rgb(153, 102, 255)',
		grey: 'rgb(201, 203, 207)',
		black: '#000000'
		
	};
	
	$.ajax({
		url: base_url + "admin/data_occ",
		method: "POST",
		data:  { 'csrf_test_name' : csrf_test_name },
		success: function(data) {
			var response = JSON.parse(data);
				
			for(var i in response) {
				_labels.push(response[i].deposit_date);
				
				window.dataSet2.LAZADA.push(response[i].LAZADA);
				window.dataSet2.PROPELLER.push(response[i].PROPELLER);
			}
			
			var testing_data = {
				labels: _labels,
				datasets: [
					{
						label: "LAZADA",
						fillColor: window.chartColors.blue,
						strokeColor: window.chartColors.blue,
						pointColor: window.chartColors.blue,
						pointStrokeColor: window.chartColors.blue,
						pointHighlightFill: "#fff",
						pointHighlightStroke: "rgba(220,220,220,1)",
						data: window.dataSet2.LAZADA
					},{
						label: "PROPELLER",
						fillColor: window.chartColors.red,
						strokeColor: window.chartColors.red,
						pointColor: window.chartColors.red,
						pointStrokeColor: window.chartColors.red,
						pointHighlightFill: "#fff",
						pointHighlightStroke: "black",
						data: window.dataSet2.PROPELLER
					}
				]
			};
			

			line_chart(testing_data,"lineChart");
			console.log(testing_data);
		},	error: function(data) {
			console.log(data);
		}
	});
}



function load_user_contribution_chart(base_url){
	var csrf_test_name = $("input[name=csrf_test_name]").val();
	var _labels = [];
	
	window.dataSet = {
		LAZADA: [],
		PROPELLER: []
	};
	
	window.chartColors = {
		red: 'rgb(255, 99, 132)',
		orange: 'rgb(255, 159, 64)',
		yellow: 'rgb(255, 205, 86)',
		green: 'rgb(75, 192, 192)',
		blue: 'rgb(54, 162, 235)',
		purple: 'rgb(153, 102, 255)',
		grey: 'rgb(201, 203, 207)',
		black: '#000000'
		
	};
	
	$.ajax({
		url: base_url + "admin/data_dcc",
		method: "POST",
		data:  { 'csrf_test_name' : csrf_test_name },
		success: function(data) {
			var response = JSON.parse(data);
				
			for(var i in response) {
				_labels.push(response[i].deposit_date);
				
				window.dataSet.LAZADA.push(response[i].LAZADA);
				window.dataSet.PROPELLER.push(response[i].PROPELLER);
			}
			
			var testing_data = {
				labels: _labels,
				datasets: [
					{
						label: "LAZADA",
						fillColor: window.chartColors.blue,
						strokeColor: window.chartColors.blue,
						pointColor: window.chartColors.blue,
						pointStrokeColor: window.chartColors.blue,
						pointHighlightFill: "#fff",
						pointHighlightStroke: "rgba(220,220,220,1)",
						data: window.dataSet.LAZADA
					},{
						label: "PROPELLER",
						fillColor: window.chartColors.red,
						strokeColor: window.chartColors.red,
						pointColor: window.chartColors.red,
						pointStrokeColor: window.chartColors.red,
						pointHighlightFill: "#fff",
						pointHighlightStroke: "black",
						data: window.dataSet.PROPELLER
					}
				]
			};
			

			bar_chart(testing_data,"user_lineChart");
			console.log(testing_data);
		},	error: function(data) {
			console.log(data);
		}
	});
}