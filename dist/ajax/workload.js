// 'use strict';
var clicked = false;
const ProjectsList = async() => {
			const Api = {
	        URL: `${Uris}/Api/Restlistprojects`
	    }
	    const rawResponse = await fetch(Api.URL);
	    const content = await rawResponse.json();
	    return content;
}

const ShowProject = (status,arr) => {
	if(status == 0){
		ProjectsList().then(function(res){
			$('#tables-workload tbody').empty();
			let n = 1, start = $('#datepicker-start').val(), end = $('#datepicker-end').val();
			res.map((item,index)=> {
				$('#tables-workload tbody').append(
					'<tr id="'+item.project_id+'">'+
						'<td>'+n+'</td>'+
						'<td>'+item.project_name+'</td>'+
						'<td>'+
							'<input id="request'+index+'" required class="form-control" placeholder="Request" />'+
							'<input id="p_id'+index+'" value="'+item.project_id+'" type="hidden"/>'+
						'</td>'+
						'<td><input id="time'+index+'" class="form-control" placeholder="Time" /></td>'+
						'<td><input autocomplete="off" id="start'+index+'" class="form-control start-control'+index+'" value="'+start+'"/></td>'+
						'<td><input autocomplete="off" id="finish'+index+'" class="form-control end-control'+index+'" value="'+end+'"/></td>'+
						'<td class="text-center"><button type="button" onclick="Submit('+index+',1)" class="btn btn-danger btn-block btn-flat">Submit</button></td>'+
					'</tr>'
				);
				setInputFilter(document.getElementById("request"+index+""), function(value) {
				  return /^-?\d*$/.test(value);
				});
				setInputFilter(document.getElementById("time"+index+""), function(value) {
				  return /^-?\d*$/.test(value);
				});
				$('.start-control'+index+'').datepicker({
					format: 'yyyy-mm-dd',
					todayHighlight: true,
					disabledDates: [new Date()],
					autoclose: true,
				});
				$('.end-control'+index+'').datepicker({
					format: 'yyyy-mm-dd',
					todayHighlight: true,
					disabledDates: [new Date()],
					autoclose: true,
				});
				++n;
			});
		});
	}
	else{
		ProjectsList().then(function(res){
			let n = 1, start = $('#datepicker-start').val(), end = $('#datepicker-end').val();
			var t = [];
			res.forEach(function(item,index){
				t.push(item);
			});
			var data   = arr.concat(t);
			var dt_fix = getUnique(data, 'project_id');
			var result = dt_fix.sort((a, b) => a.project_id - b.project_id);
			result.map((types,index)=> {
				console.log(types);
				var arr_spread = [types.project_id, n, types.project_name, started,ended];
				if(types.request == undefined || types.time == undefined){
					var btn = '<button type="button" onclick="Submit('+index+',0)" class="btn btn-danger btn-flat">Submit</button>';
					var btn_add = '';
					var btn_detail = '';
					var txt_req = '';
					var txt_tim = '';
				}
				else{
					var btn = '<button type="button" onclick="" class="btn btn-success btn-flat">Update</button>';
					var btn_add = '<button type="button" class="btn btn-danger btn-flat"  onclick="ClickAddTemp('+types.project_id+','+index+',\''+types.project_name+'\',\''+start+'\',\''+end+'\')" >AddNew</button>';
					var btn_detail = '<button type="button" class="btn btn-info btn-flat" onclick="ClickViewTemp('+types.project_id+',\''+start+'\',\''+end+'\',\''+types.project_name+'\')">Detail</button>';
					var txt_req = types.request;
					var txt_tim = types.time;
				}
				if(types.date_start == undefined && types.date_end == undefined){
					var started = start;
					var ended   = end;
					var read    ='readonly';
				}
				else{
					var started = types.date_start;
					var ended   = types.date_end;
					var read    ='';
				}
				// console.log(types.date);
				$('#tables-workload tbody').append(
					'<tr class="'+types.project_id+'">'+
						'<td>'+n+'</td>'+
						'<td>'+types.project_name+'</td>'+
						'<td>'+
							'<input autocomplete="off" id="update-request'+index+'" required class="form-control" placeholder="Request" value="'+txt_req+'" />'+
							'<input id="update-p_id'+index+'" value="'+types.project_id+'" type="hidden"/>'+
						'</td>'+
						'<td><input autocomplete="off" id="update-time'+index+'" class="form-control" placeholder="Time" value="'+txt_tim+'"/></td>'+
						'<td><input autocomplete="off" id="update-start'+index+'" class="form-control start-control'+index+'" value="'+started+'"/></td>'+
						'<td><input autocomplete="off" id="update-finish'+index+'" class="form-control end-control'+index+'" value="'+ended+'"/></td>'+
						'<td class="text-center">'+
						''+btn+' '+btn_add+' '+btn_detail+''+
						'</td>'+
					'</tr>'
				);
				setInputFilter(document.getElementById("update-request"+index+""), function(value) {
				  return /^-?\d*$/.test(value);
				});
				setInputFilter(document.getElementById("update-time"+index+""), function(value) {
				  return /^-?\d*$/.test(value);
				});
				if(types.date_start != undefined && types.date_end != undefined){
					$('#update-start'+index+'').css("border","1px solid #52a75b");
					$('#update-finish'+index+'').css("border","1px solid #52a75b");
				}
				else{
					$('#update-start'+index+'').css("border","1px solid #dd4b39");
					$('#update-finish'+index+'').css("border","1px solid #dd4b39");
				}
				$('.start-control'+index+'').datepicker({
					format: 'yyyy-mm-dd',
					todayHighlight: true,
					disabledDates: [new Date()],
					autoclose: true,
				});
				$('.end-control'+index+'').datepicker({
					format: 'yyyy-mm-dd',
					todayHighlight: true,
					disabledDates: [new Date()],
					autoclose: true,
				});
				++n;
			});
		});
	}
};

const ClickAddTemp = (pid,index,proname,start,finish) => {
		$('#tables-workload tbody tr[class="tr'+pid+'"]').remove();
		$('#tables-workload tbody tr[class="'+pid+'"]').after(`
			 <tr class="tr`+pid+`">
				 <td class="bg-gray" colspan="7">
				 			<h4><i class="fa fa-plus text-aqua"></i> Add `+proname+`</h4>
				 			<div style="position:absolute;right:0;margin: -15px 10px;">
								<button onclick="rmv(`+pid+`)" class="btn btn-sm btn-danger btn-flat"><i class="fa fa-times"></i></button>
							</div>
						 <table class="table table-bordered table-responsive" style="background: #cae9f3;">
							 <thead>
								 <tr>
									 <th width="20%">Projects</th>
									 <th width="20%">Request</th>
									 <th>Time</th>
									 <th>Start</th>
									 <th>Finish</th>
									 <th class="text-center" width="20%">Execute</th>
								 </tr>
							 </thead>
							 <tbody>
							 	<tr>
									<td>`+proname+`</td>
									<td>
										<input id="request`+index+`" required class="form-control" placeholder="Request"/>
										<input id="p_id`+index+`" value="`+pid+`" type="hidden"/>
									</td>
									<td><input id="time`+index+`" class="form-control" placeholder="Time" /></td>
									<td><input autocomplete="off" id="start`+index+`" class="form-control start-control`+index+`" value="`+start+`"/></td>
									<td><input autocomplete="off" id="finish`+index+`" class="form-control end-control`+index+`" value="`+finish+`"/></td>
									<td><button type="button" onclick="Submit(`+index+`)" class="btn btn-danger btn-block btn-flat">Submit</button></td>
								</tr>
							 </tbody>
						 </table>
				 </td>
			 </tr>
		`);
		$('.start-control'+index+'').datepicker({
			format: 'yyyy-mm-dd',
			todayHighlight: true,
			disabledDates: [new Date()],
			autoclose: true,
		});
		$('.end-control'+index+'').datepicker({
			format: 'yyyy-mm-dd',
			todayHighlight: true,
			disabledDates: [new Date()],
			autoclose: true,
		});
}

const rmv = (id)=>{
	$('#tables-workload tbody tr[class="tr'+id+'"]').remove();
}

const ClickViewTemp = (pid,start,finish,proname) => {
	$('#tables-workload tbody tr[class="tr'+pid+'"]').remove();
	$('#tables-workload tbody tr[class="'+pid+'"]').after(`
		 <tr class="tr`+pid+`">
			 <td class="bg-gray" colspan="7">
						<h4><i class="fa fa-edit text-green"></i> Update `+proname+`</h4>
						<div style="position:absolute;right:0;margin: -15px 10px;">
							<button onclick="rmv(`+pid+`)" class="btn btn-sm btn-danger btn-flat"><i class="fa fa-times"></i></button>
						</div>
					 <table id="table-update-`+pid+`" class="table table-bordered table-responsive" style="background:#cbf3ca;">
						 <thead>
							 <tr>
								 <th width="20%">Projects</th>
								 <th width="20%">Request</th>
								 <th>Time</th>
								 <th>Bobot</th>
								 <th>Start</th>
								 <th>Finish</th>
								 <th class="text-center" width="20%">Execute</th>
							 </tr>
						 </thead>
						 <tbody></tbody>
					 </table>
			 </td>
		 </tr>
	`);
	$.ajax({
		 url: `${Uris}/Api/Restworkload/UpdateDetailWorkload`,
		 type: "POST",
		 data: {
			 project_id:pid,
			 start: start,
			 finish:finish
		 },
		 dataType:'json',
		 success: (data) => {
			console.log(data);
			let {
				req
			} = data;
			req.map((item,index) => {
				$('#table-update-'+pid+' tbody').append(`
					<tr>
						<td>`+item.project_name+`</td>
						<td>
							<input id="on-request`+index+`" required class="form-control" placeholder="Request" value="`+item.request+`"/>
						</td>
						<td><input id="on-time`+index+`" class="form-control" placeholder="Time" value="`+item.time+`"/></td>
						<td>`+item.time * item.request+`</td>
						<td><input autocomplete="off" id="on-start`+index+`" class="form-control start-control`+index+`" value="`+item.date_start+`"/></td>
						<td><input autocomplete="off" id="on-finish`+index+`" class="form-control end-control`+index+`" value="`+item.date_end+`"/></td>
						<td><button type="button" onclick="UpdateDetail(`+index+`,`+item.workload_id+`,`+item.project_id+`,\'`+item.project_name+`\')" class="btn btn-success btn-block btn-flat">Update</button></td>
					</tr>
				`)
					setInputFilter(document.getElementById("on-request"+index+""), function(value) {
						return /^-?\d*$/.test(value);
					});
					setInputFilter(document.getElementById("on-time"+index+""), function(value) {
						return /^-?\d*$/.test(value);
					});
					if(item.date_start != undefined && item.date_end != undefined){
						$('#on-start'+index+'').css("border","1px solid #52a75b");
						$('#on-finish'+index+'').css("border","1px solid #52a75b");
					}
					else{
						$('#on-start'+index+'').css("border","1px solid #dd4b39");
						$('#on-finish'+index+'').css("border","1px solid #dd4b39");
					}
					$('.start-control'+index+'').datepicker({
						format: 'yyyy-mm-dd',
						todayHighlight: true,
						disabledDates: [new Date()],
						autoclose: true,
					});
					$('.end-control'+index+'').datepicker({
						format: 'yyyy-mm-dd',
						todayHighlight: true,
						disabledDates: [new Date()],
						autoclose: true,
					});
			});
		 },
		 error:(err)=>{
			console.log(err);
		 }
	});
}

const CheckData = (start,finish) => {
	$.ajax({
		 url: `${Uris}/Api/Restworkload/Filterload`,
		 type: "POST",
		 data: {
			 start: start,
			 finish:finish
		 },
		 dataType:'json',
		 success: (data) => {
			ShowProject(data.status,data.req);
		 },
		 error:(err)=>{
			console.log(err);
		 }
	});
}

const UpdateDetail = (id,wid,pid,proname)=>{
	$.ajax({
		 url: `${Uris}/Api/Restworkload/SetUpdateDetailWorkload`,
		 type: "POST",
		 data: {
			 workload_id: wid,
			 project_id:pid,
			 request:$('#on-request'+id+'').val(),
			 time:$('#on-time'+id+'').val(),
			 start:$('#on-start'+id+'').val(),
			 finish:$('#on-finish'+id+'').val()
		 },
		 success: (data) => {
				console.log(data);
				// ClickViewTemp(pid,\'``+start+``\',\'``+finish+``\',\'``+proname+``\');
// ,\''+$('#on-finish'+id+'').val()+'\',\''+proname+'\'
				console.log(id);
				ClickViewTemp(pid,$('#datepicker-start').val(),$('#datepicker-end').val(),proname);
		 },
		 error:(err)=>{
			console.log(err);
		 }
	});
}

const Actionsubmit = (id,act) =>{
	if(act == 0){
		let pid			= $('#update-p_id'+id+'').val()
				request = $('#update-request'+id+'').val(),
				time    = $('#update-time'+id+'').val(),
		 		start   = $('#update-start'+id+'').val(),
				end     = $('#update-finish'+id+'').val();
		$.ajax({
			 url: `${Uris}/Api/Restworkload`,
			 type: "POST",
			 data: {
				 project_id:pid,
				 request: request,
				 time: time,
				 start: start,
				 end:end
			 },
			 dataType:'json',
			 success: (data) => {
				 let {
					 msg
				 } = data;
				 $('#tables-workload tbody').empty();
				 if(data.err == true){
						error(msg,'#df6660');
						CheckData(start,end);
				 }else{
	  			  info(msg,'#008d4c');
						CheckData(start,end);
				 }
				 console.log(data);
			 },
			 error:(err)=>{
				 alert(err);
			 }
		});
	}
	else{
		let pid			= $('#p_id'+id+'').val()
				request = $('#request'+id+'').val(),
				time    = $('#time'+id+'').val(),
		 		start   = $('#start'+id+'').val(),
				end     = $('#finish'+id+'').val();
		$.ajax({
			 url: `${Uris}/Api/Restworkload`,
			 type: "POST",
			 data: {
				 project_id:pid,
				 request: request,
				 time: time,
				 start: start,
				 end:end
			 },
			 dataType:'json',
			 success: (data) => {
				 let {
					 msg
				 } = data;
				 $('#tables-workload tbody').empty();
				 if(data.err == true){
						error(msg,'#df6660');
						CheckData(start,end);
				 }else{
	  			  info(msg,'#008d4c');
						CheckData(start,end);
				 }
				 console.log(data);
			 },
			 error:(err)=>{
				 alert(err);
			 }
		});
	}
}

const Submit = (id,act) =>{
	Actionsubmit(id,act);
}

$(() => {
	// ShowProject();
	$('#datepicker-start').datepicker({
		format: 'yyyy-mm-dd',
		todayHighlight: true,
		disabledDates: [new Date()],
		autoclose: true,
	});
	$('#datepicker-end').datepicker({
		format: 'yyyy-mm-dd',
		todayHighlight: true,
		disabledDates: [new Date()],
		autoclose: true,
	}).on('changeDate', function() {
		let start   = $('#datepicker-start').val(),
				finish  = $(this).val();
		$('#tables-workload tbody').empty();
		CheckData(start,finish);
	});
})
