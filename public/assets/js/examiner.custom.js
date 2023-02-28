$(document).ready(function(){
	location.href='http://online.examiner.club//logout.php';
	var validator = new FormValidator({
	    "events": ['blur', 'input', 'change']
	}, document.forms[0]);
	// on form "submit" event
	document.forms[0].onsubmit = function(e) {
	    var submit = true,
	        validatorResult = validator.checkAll(this);
	    return !!validatorResult.valid;
	};
	// on form "reset" event
	document.forms[0].onreset = function(e) {
	    validator.reset();
	};
	// stuff related ONLY for this demo page:
	$('.toggleValidationTooltips').change(function() {
	    validator.settings.alerts = !this.checked;
	    if (this.checked)
	        $('form .alert').remove();
	}).prop('checked', false);

	function isNumber(evt) {
	  evt = (evt) ? evt : window.event;
	  var charCode = (evt.which) ? evt.which : evt.keyCode;
	  if (charCode > 31 && (charCode < 48 || charCode > 57)) {
	      return false;
	  }
	  return true;
	}
});