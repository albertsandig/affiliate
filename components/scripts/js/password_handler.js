function equal_password(){
	var pass = document.getElementById('password');
	var re_pass = document.getElementById('retype_pass');
	
	
	re_pass.style.border = '1px solid green';
	re_pass.style.backgroundColor = '#a8f1bb';
	
	if(pass.value != re_pass.value){
		re_pass.style.border = '1px solid red';
		re_pass.style.backgroundColor = '#f1cdcd';
	}
	
	if(pass.value.length < 8 ) {
		re_pass.style.border = '1px solid red';
		re_pass.style.backgroundColor = '#f1cdcd';
	} 
}