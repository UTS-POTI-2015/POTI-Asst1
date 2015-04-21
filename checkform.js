function areAllCompleted(){
	var name = document.delivery_form.name.value;
	var address = document.delivery_form.address.value;
	var suburb = document.delivery_form.suburb.value;
	var state = document.delivery_form.state.value;
	var country = document.delivery_form.country.value;
	var email = document.delivery_form.email.value;
	var errorMsg = "";

	if (name.length === 0) 
		errorMsg += "NAME FIELD IS REQUIRED!\n";
	if (address.length === 0)
		errorMsg += "ADDRESS FIELD IS REQUIRED!\n";
	if (suburb.length === 0) 
		errorMsg += "SUBURB FIELD IS REQUIRED!\n";
	if (state.length === 0) 
		errorMsg += "STATE FIELD IS REQUIRED!\n";
	if (country.length === 0) 
		errorMsg += "COUNTRY FIELD IS REQUIRED!\n";
	if (email.length === 0) 
		errorMsg += "EMAIL FIELD IS REQUIRED!";
	
	if (errorMsg.length > 0) {
		alert(errorMsg);
		return false;
	};

	return true;
}

 function isEmailValid(){
 	var email = document.delivery_form.email.value;
 	var patt = /^[a-zA-Z0-9\._-]+@[a-zA-Z-\.]+\.(com|net|org|gov|edu)(\.(au|us|hk\cn))?$/;
	if (!patt.test(email)) {
		alert("Email address is not Valid!");
		return false;
	}
    return true;


 }