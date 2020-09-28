//----------------------------------------
var isListMode=true;
var isLoading=false;
var isFirstLoad=true;
//----------------------------------------
$(document).ready(function() {
//----------------------------------------
	$('.FilterSearch').bind('change', function() {
		$('#idListData').fadeOut();
		$('#idListNotFound').fadeOut();
		$('#mySearchForm').submit();
    });
	doShowFilter();
});
//----------------------------
$(window).scroll(function() {
//----------------------------
	var reactFromBottom = 50;
	var pageno=$("#inputShowPage").val()*1;
	var pagemax=$("#inputShowMaxPage").val()*1;
	if(isListMode && !isLoading && pageno<pagemax && $(window).scrollTop()+$(window).height()>$(document).height()-reactFromBottom) {
		doLoadList();
	}
});
//----------------------------
function doLoadList() {
//----------------------------
	var pagemax=$("#inputShowMaxPage").val()*1;
	if(pagemax==0) {
		$("#idListData").hide();
		$("#idListNotFound").show();
		isLoading=false;
		return false;
	} else {
		var pageno=$("#inputShowPage").val()*1;
		pageno=pageno+1;
		$("#inputShowPage").val(pageno);
		$("#idListData").show();
		$("#idListNotFound").hide();
		isLoading=true;
		doAlert('กำลังโหลด หน้า '+pageno,'info');
	}
	var datalist=$("#mySearchForm").serialize();
	var myaction='list-ajax.php';
	$.ajax({
		url : myaction,
		contentType: "text/html",
		data: datalist,
		success : function(returndata) {
			$("#idListBody").append(returndata);
			isLoading=false;
			doAlert('แสดงหน้า '+pageno+'/'+pagemax,'success');
		},
		error : function(xhr, statusText, error) {
			doAlert('Failed!<br>Can not load data','danger');
		}
	});
}
//----------------------------------------
function doEdit(myid,subject) {
//----------------------------------------
	$('#inputID').val(myid);
	$('#myID').val(subject);
	$('#doaction').val('edit');
	$('#mySearchForm').submit();
}
//----------------------------------------
function doDelete(myid) {
//----------------------------------------
	$('#inputID').val(myid);
	$('#doaction').val('confirm');
	$('#mySearchForm').submit();
}
//----------------------------------------