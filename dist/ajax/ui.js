$(function() {
	$(document).ready(function(){
		$('.panel').lobiPanel({
			sortable: true,
			editTitle : false,
			reload : false,
			close : false
		});
		$('.panel').on('dragged.lobiPanel', function(ev, lobiPanel){
			$('.dahsboard-column').matchHeight();
		});
	});
});

function truncateDate(date) {
   return new Date(date.getFullYear(), date.getMonth(), date.getDate()+1);
}

$(function() {
	$(document).ready(function(){
		let $select  = jQuery("#timer1");
		let $select2 = jQuery("#timer2");
		for (let hr = 0; hr < 24; hr++) {
			let hrStr = hr.toString().padStart(2, "0") + ":";
			let val   = hrStr + "00:00";
			$select.append('<option val="' + val + '">' + val + '</option>');
			$select2.append('<option val="' + val + '">' + val + '</option>');
			val       = hrStr + "30:00";
			$select.append('<option val="' + val + '">' + val + '</option>');
			$select2.append('<option val="' + val + '">' + val + '</option>');
		}

		$('#dateapn').datepicker({
			format: 'yyyy-mm-dd',
			todayHighlight: true,
			autoclose: true,
		});
		// $('#datepicker-start,#datepicker-end').datepicker({
		// 	format: 'yyyy-mm-dd',
    //      todayHighlight: true,
    //      // startDate: truncateDate(new Date()),
    //      disabledDates: [new Date()],
    //      autoclose: true,
		// });

		var dates = new Date();
		dates.setDate(dates.getDate());
		$('#date-pick-leave,#datepicker-end-leave').datepicker({
			format: 'yyyy-mm-dd',
			startDate: dates
		});


		$('#datepicker6').datepicker({
			format: 'yyyy-mm-dd',
			todayHighlight: true,
			autoclose: true,
		});
		$('#date-acc').datepicker({
			format: 'yyyy-mm-dd',
			todayHighlight: true,
			autoclose: true,
		});
		$('#date-acc').datepicker({
			format: 'yyyy-mm-dd',
			todayHighlight: true,
			autoclose: true,
		});
		$('#datepicker-end-leave').datepicker({
			format: 'yyyy-mm-dd',
			todayHighlight: true,
			autoclose: true,
		});
	});
});

$(function(){
	$('#timepicker2').timepicker({
		defaultTime:new Date(),
		snapToStep:true,
		showMeridian: false,
		showSeconds:true,
		minuteStep:1,
		template:false,
	});
	$('#timepicker3').timepicker({
		snapToStep:true,
		showMeridian: false,
		showSeconds:true,
		minuteStep:1,
		template:false
	});
})

$(function() {
	$('#msisdn').DataTable({
		responsive: true
	});
});

$(function() {
	$('#trace').DataTable({
		responsive: true
	});
	$('#tbl1').DataTable({
		"responsive": true,
		"dom": "rtp",
		"buttons": [
				'copy', 'csv', 'excel'
			],
	});
	$('#tbl2').DataTable({
		responsive: true,
		"dom": "rtp",
		"buttons": [
				'copy', 'csv', 'excel'
			],
	});
});

$.fn.extend({
    treed: function (o) {

      var openedClass = 'glyphicon-minus-sign';
      var closedClass = 'glyphicon-plus-sign';

      if (typeof o != 'undefined'){
        if (typeof o.openedClass != 'undefined'){
        openedClass = o.openedClass;
        }
        if (typeof o.closedClass != 'undefined'){
        closedClass = o.closedClass;
        }
      };

        //initialize each of the top levels
        var tree = $(this);
        tree.addClass("tree");
        tree.find('li').has("ul").each(function () {
            var branch = $(this); //li with children ul
            branch.prepend("<i class='indicator glyphicon " + openedClass + "'></i>");
            branch.addClass('branch');
            branch.on('click', function (e) {
                if (this != e.target) {
                    var icon = $(this).children('i:first');
                    icon.toggleClass(closedClass + " " + openedClass);
                    $(this).children().children().toggle();
                }
            })
            branch.children()
        });
		//fire event to open branch if the li contains an anchor instead of text
		tree.find('.branch>a').each(function () {
			$(this).on('click', function (e) {
				$(this).closest('li').click();
				//e.preventDefault();
			});
		});
    }
});

//Initialization of treeviews

$('#tree1').treed();

$('#tree2').treed({openedClass:'fa fa-database', closedClass:'fa fa-database'});
$('#treel').treed({openedClass:'fa fa-flag', closedClass:'fa fa-flag'});

$('#tree3').treed({openedClass:'glyphicon-chevron-right', closedClass:'glyphicon-chevron-down'});

$(function() {
     $(document).ready(function() {
		var orderCount = 0;
		$('#example38,#example39').multiselect({
		  includeSelectAllOption: true,
		  buttonText: function(options) {
			if (options.length == 0) {
			  return 'None selected ';
			}
			else if (options.length > 1) {
			  return options.length + ' selected  ';
			}
			else {
			  var selected = [];
			  options.each(function() {
				selected.push([$(this).text(), $(this).data('order')]);
			  });

			  selected.sort(function(a, b) {
				return a[1] - b[1];
			  })

			  var text = '';
			  for (var i = 0; i < selected.length; i++) {
				text += selected[i][0] + ', ';
			  }

			  return text.substr(0, text.length -2) + ' ';
			}
		  },
		  onChange: function(option, checked) {
			if (checked) {
			  orderCount++;
			  $(option).data('order', orderCount);
			}
			else {
			  $(option).data('order', '');
			}
		  }
		});

		$('#example38-order').on('click', function() {
		  var selected = [];
		  $('#example38 option:selected').each(function() {
			selected.push([$(this).val(), $(this).data('order')]);
		  });

		  selected.sort(function(a, b) {
			return a[1] - b[1];
		  });

		  var text = '';
		  for (var i = 0; i < selected.length; i++) {
			text += selected[i][0] + ', ';
		  }
		  text = text.substring(0, text.length - 2);

		  alert(text);
		});

		$('#example39-order').on('click', function() {
		  var selected = [];
		  $('#example39 option:selected').each(function() {
			selected.push([$(this).val(), $(this).data('order')]);
		  });

		  selected.sort(function(a, b) {
			return a[1] - b[1];
		  });

		  var text = '';
		  for (var i = 0; i < selected.length; i++) {
			text += selected[i][0] + ', ';
		  }
		  text = text.substring(0, text.length - 2);

		  alert(text);
		});
		});

	$('.select2').multiselect({
        includeSelectAllOption: true,
    });
});
$(function(){
	$("#checkAll").click(function () {
			if($(this).is(":checked")){
					$('table tr td#checks').html("<i class='fa fa-check text-green'></i>");
					$("#show_remove").html('<button class="btn btn-danger">Remove All Check</button>').fadeIn('slow');
			}else{
				$('table tr td#checks').html("");
				$("#show_remove").html('');
			}
	});
});

// $(function(){
// 	$('.selectapn').multiselect({
// 		includeSelectAllOption: false,
// 		enableCaseInsensitiveFiltering: false,
// 	});
// })

var interval = setInterval(function() {
var momentNow = moment();
	$('#timer-interval').html('<small>'+momentNow.format('DD \ MMMM YYYY') + ' '.substring(0,3).toUpperCase()+'</b> '+momentNow.format('hh:mm:ss A')+'</small>');
}, 100);
