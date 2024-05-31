(function($) {
    /* "use strict" */
	let newData = [];
	$.ajax({
		type: "GET",
		url: "action/revenue_fetch.php",
		dataType: "json",
		// data: {appointment_id:appointment_id},
		success : function(data){
			if (data){
				
				for(i = 1; i <= 12; i++)
				{
					let obj = data.find(o => o.month == i);
					if(obj != undefined)
					{
						newData[i-1] = obj.total_revenue;
					}
					else{
						newData[i-1] = 0;
					}
				}
				console.log(newData);
			} else {
				swal("Bad Luck!", "Something went wrong, Please try again later.", "error");
			}
		}
	});

 var dzChartlist = function(){
	
	var screenWidth = $(window).width();
		
	var chartBar = function(){
		
		var options = {
			  series: [
				{
					name: 'Net Profit',
					data: newData,
					radius: 12,	
				}, 
				
			],
				chart: {
				type: 'bar',
				height: 350,
				
				toolbar: {
					show: false,
				},
				
			},
			plotOptions: {
			  bar: {
				horizontal: false,
				columnWidth: '55%',
				endingShape: 'rounded'
			  },
			},
			colors:['#450b5a', '#ff2c53'],
			dataLabels: {
			  enabled: false,
			},
			markers: {
			shape: "circle",
		},
			legend: {
				show: true,
				fontSize: '12px',
				labels: {
					colors: '#000000',
					
					},
				markers: {
				width: 18,
				height: 18,
				strokeWidth: 0,
				strokeColor: '#fff',
				fillColors: undefined,
				radius: 12,	
				}
			},
			stroke: {
			  show: true,
			  width: 1,
			  colors: ['transparent']
			},
			grid: {
				borderColor: '#eee',
			},
			xaxis: {
				
			  categories: ['01', '02', '03', '04', '05', '06', '07', '08', '09','10','11','12'],
			  labels: {
			   style: {
				  colors: '#787878',
				  fontSize: '13px',
				  fontFamily: 'poppins',
				  fontWeight: 100,
				  cssClass: 'apexcharts-xaxis-label',
				},
			  },
			  crosshairs: {
			  show: false,
			  }
			},
			yaxis: {
				labels: {
			   style: {
				  colors: '#787878',
				  fontSize: '13px',
				   fontFamily: 'poppins',
				  fontWeight: 100,
				  cssClass: 'apexcharts-xaxis-label',
			  },
			  },
			},
			fill: {
			  opacity: 1
			},
			tooltip: {
			  y: {
				formatter: function (val) {
				  return "Rs. " + val 
				}
			  }
			}
			};

			var chartBar1 = new ApexCharts(document.querySelector("#chartBar"), options);
			chartBar1.render();
	}
	
	/* Function ============ */
		return {
			init:function(){
				console.log("init");
			},
			
			
			load:function(){
				console.log("loadt");
				chartBar();	
			},
			
			resize:function(){
			}
		}
	
	}();

	jQuery(document).ready(function(){
	});
		
	jQuery(window).on('load',function(){
		setTimeout(function(){
			dzChartlist.load();
		}, 1000); 
		
	});

	jQuery(window).on('resize',function(){
		
		
	});     

})(jQuery);