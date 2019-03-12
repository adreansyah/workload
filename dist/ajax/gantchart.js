DataWorkload();
function DataWorkload(){
  $.ajax({
     url: `${Uris}/Api/Restworkload/DataWorkload`,
     type: "GET",
     dataType:'json',
     success: (data) => {
      DataWorkloadGantt(data)
     },
     error:(err)=>{
       alert(err);
     }
  });
}

function DataWorkloadGantt(data){
  Highcharts.ganttChart('gant', {
      title: {
        text: 'Dashboard Workload'
      },
      subtitle: {
            text: 'Source: TELKOMSEL'
      },
      yAxis: {
          uniqueNames: true,
      },
      xAxis:[
  		 {
  		    tickInterval: 1000 * 60 * 60 * 24, // 1 month
  				type: 'datetime',
  				// labels: {
  				// 	format: '{value:%Y-%m-%e}',
  				// },
  		},{
      	tickInterval: 30 * 24 * 3600 * 1000// 1 day
  		},{
  		    visible: false,
  		    opposite: false,
  				lineWidth: 0,
  				minorGridLineWidth: 0,
  				lineColor: 'transparent'
  		}],
      tooltip: {
        xDateFormat: '%e %b %Y, %H:%M'
      },
  		credits: {
          enabled: false
      },
      navigator: {
          enabled: true,
          liveRedraw: true,
          series: {
              type: 'gantt',
              pointPlacement: 0.5,
              pointPadding: 0.25
          },
          yAxis: {
              min: 0,
              max: 3,
              reversed: true,
              categories: []
          }
      },
      scrollbar: {
          enabled: true
      },
      rangeSelector: {
          enabled: true,
          selected: 0
      },
      series: [{
          name: 'Workload Dashboard',
          data:data
      }]
  });
  console.log(data);
}
