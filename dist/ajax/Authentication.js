"use strict"

let Base_Url = window.location.href,
		arr = Base_Url.split("/"),
		Url_Result = arr[0] + "//" + arr[2],
 		ApiLink = 'vasdashboard';

const Authentication = (token)  => {
	$('#myform').submit( async(e) => {
		e.preventDefault();
		let siteurl = ""+Url_Result+"/"+ApiLink+"/index.php/statlogin";
		const rawResponse = await fetch(`${siteurl}`, {
        method: 'POST',
        body: Qs.stringify(
				{
					username:$('#name').val(),
					password:$('#pass').val(),
					token:token
				}),
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded'
				}
    });
    const content = await rawResponse.json();
		let data      = content;
		
		$('button#login_load').text('Sign In');
		$('#notif').html(data['no_name']);
		if(data['load-page']!==undefined)
		{
			window.location.replace(data['load-page']);
		}
		$("#message").delay(2000).fadeOut("slow");
		$('button#login_load').html("<img width='auto' height='18px' src="+Url_Result+"/"+ApiLink+"/dist/img/loading.gif>")
	});
}
