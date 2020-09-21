//---------------------------
function doSaveDarkOrLight(myDarkOrLight) {
//---------------------------
	$('#inputThemeDarkOrLight').val(myDarkOrLight);
	var myinput=$('#myForm').serialize();
	$.ajax('update-ajax.php?'+myinput, {
		dataType: 'text',
		data : myinput,
		success: function(data){
			$('#myForm').submit();
		}
	});
}

//---------------------------
function doSaveTheme(myTheme,myLevel) {
//---------------------------
	$('#inputThemeBG').val(myTheme);
	$('#inputThemeLevel').val(myLevel);
	var myinput=$('#myForm').serialize();
	$.ajax('update-ajax.php?'+myinput, {
		dataType: 'text',
		data : myinput,
		success: function(data){
			$('#myForm').submit();
		}
	});
}

//---------------------------
function doChangeTheme(myTheme,myLevel) {
//---------------------------
	var myClass='';
	if(myLevel=='') { myClass+=myTheme; } else { myClass+=myTheme+'-'+myLevel; }
	$('#idNavBar').removeClass('theme-bgcolor-'+currentClass);
	$('#idNavBar').addClass('theme-bgcolor-'+myClass);
	currentClass=myClass;
}
