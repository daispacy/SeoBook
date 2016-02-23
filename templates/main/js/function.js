function DD_jumpMenu(targ,selObj,restore){ 
	var s = selObj.options[selObj.selectedIndex].value; 
	window.open(s); 
	if (restore) selObj.selectedIndex=0; 
}
// validate form login
function validateFormLogin(t){
	var f = document.getElementById(t);
	//var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	//alert(f.email.value);
	if(f.username.value==''){
		jQuery('#username').addClass("error");
		//jQuery('<span class="error-message">Tên đăng nhập không đúng</span>').appendTo("p #username");
		//$("input[name=username]").after('<span class="error-message">Tên đăng nhập không đúng</span>');
		//f.username.placeholder='Nhập tên đăng nhập';
		f.username.focus();
		return false;
	}
	if(f.password.value==''){
		jQuery('#password').addClass("error");
		//f.password.placeholder='Nhập mật khẩu';
		//f.password.focus();
		return false;
	}
} 
// function login
function formLogin(){
	validateFormLogin('form-signin');
	jQuery('form-signin').onsubmit(true);
	//jQuery('form-signin').submit();
}