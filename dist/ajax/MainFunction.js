'use strict'
let Base_Url = window.location.href,
		arr = Base_Url.split("/"),
		Url_Result = arr[0] + "//" + arr[2],
 		ApiLink = 'vasdashboard/index.php',
		Uris = `${Url_Result}/${ApiLink}`,
		aktif;

function error(text,bgcolor){
    iziToast.show({
        titleColor: 'white',
        title: '<i class="fas fa-ban"></i> sorry!!!',
        message: ''+text+'',
        messageColor: 'white',
        position:'topRight',
        backgroundColor: ''+bgcolor+'',
    });
}

function info(text,bgcolor){
    iziToast.show({
        titleColor: 'white',
        title: '<i class="fas fa-ban"></i> Info!!!',
        message: ''+text+'',
        messageColor: 'white',
        position:'topRight',
        backgroundColor: ''+bgcolor+'',
    });
}

function setInputFilter(textbox, inputFilter) {
  ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
    textbox.addEventListener(event, function() {
      if (inputFilter(this.value)) {
        this.oldValue = this.value;
        this.oldSelectionStart = this.selectionStart;
        this.oldSelectionEnd = this.selectionEnd;
      } else if (this.hasOwnProperty("oldValue")) {
        this.value = this.oldValue;
        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
      }
    });
  });
}
// setInputFilter(document.getElementById("intTextBox"), function(value) {
//   return /^-?\d*$/.test(value);
// });
// setInputFilter(document.getElementById("uintTextBox"), function(value) {
//   return /^\d*$/.test(value); });
// setInputFilter(document.getElementById("intLimitTextBox"), function(value) {
//   return /^\d*$/.test(value) && (value === "" || parseInt(value) <= 500); });
// setInputFilter(document.getElementById("floatTextBox"), function(value) {
//   return /^-?\d*[.,]?\d*$/.test(value); });
// setInputFilter(document.getElementById("currencyTextBox"), function(value) {
//   return /^-?\d*[.,]?\d{0,2}$/.test(value); });
// setInputFilter(document.getElementById("hexTextBox"), function(value) {
//   return /^[0-9a-f]*$/i.test(value); });

function getUnique(arr, comp) {

  const unique = arr
       .map(e => e[comp])

     // store the keys of the unique objects
    .map((e, i, final) => final.indexOf(e) === i && i)

    // eliminate the dead keys & store unique objects
    .filter(e => arr[e]).map(e => arr[e]);

   return unique;
}

function addCommas(nStr) {
    nStr += '';
    var x = nStr.split('.');
    var x1 = x[0];
    var x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}

// function Startdateclick(id){
// 	aktif = id
// 	$('.start-control'+id+'').datepicker({
// 		format: 'yyyy-mm-dd',
// 		todayHighlight: true,
// 		disabledDates: [new Date()],
// 		autoclose: true,
// 	});
// }
//
// function Enddateclick(id){
// 	aktif = id
// 	alert(id);
// }
