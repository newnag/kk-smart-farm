//##################################################################################
var NotyJgrowl = function() {
    var _componentNoty = function() {
        if (typeof Noty == 'undefined') {
            console.warn('Warning - noty.min.js is not loaded.');
            return;
        }
        Noty.overrideDefaults({
            theme: 'limitless',
            layout: 'topRight',
            type: 'alert',
            timeout: 2500
        });
    };
    return {
        init: function() {
            _componentNoty();
        }
    }
}();
document.addEventListener('DOMContentLoaded', function() { NotyJgrowl.init(); });
//##################################################################################
var Popups = function () {
    var _componentTooltipCustomColor = function() {
		$('[data-popup=tooltip-custom]').tooltip({
			template: '<div class="tooltip"><div class="arrow border-slate-800"></div><div class="tooltip-inner bg-slate-800"></div></div>'
		});
    };
    return {
        init: function() {
            _componentTooltipCustomColor();
        }
    }
}();
document.addEventListener('DOMContentLoaded', function() { Popups.init(); });
//##################################################################################
var Select2Selects = function() {
    var _componentSelect2 = function() {
        if (!$().select2) {
            console.warn('Warning - select2.min.js is not loaded.');
            return;
        }
        $('.select').select2({
            minimumResultsForSearch: Infinity
        });
    };
    return {
        init: function() {
            _componentSelect2();
        }
    }
}();
document.addEventListener('DOMContentLoaded', function() { Select2Selects.init(); });
//##################################################################################

//--------------------------------------
function System_doSideBarHideOrShow() {
//--------------------------------------
    var inputText='';
    if(System_SideBarHideOrShow) { System_SideBarHideOrShow=false; inputText='show'; } else { System_SideBarHideOrShow=true; inputText='hide'; }
	$.ajax('../home/update-sidebar-hideorshow-ajax.php?inputSideBarHideOrShow='+inputText, {
		dataType: 'text',
		success: function(data) {
		}
	});
}
//----------------------------------------
function System_ToggleBox(myi) {
//----------------------------------------
    if($("#idBoxBody"+myi).is(':hidden')) { // show then hide
        $("#idBoxBody"+myi).slideDown();
        $("#idBoxIcon"+myi).removeClass('rotate-180');
    } else { // hide then show
        $("#idBoxBody"+myi).slideUp();
        $("#idBoxIcon"+myi).addClass('rotate-180');
    }
}
//---------------------------------------------------
function doAlert(myText,myType) {
//---------------------------------------------------
    new Noty({
        text: myText,
        type: myType
    }).show();    
}
//--------------------------------
function doToggleFilter() {
//--------------------------------
	var isShowFilter=$('#inputShowFilter').val();
	if(isShowFilter==1) { $('#inputShowFilter').val(0); $('#mySearchFilter').fadeOut(); }
	if(isShowFilter==0) { $('#inputShowFilter').val(1); $('#mySearchFilter').fadeIn(); }
}
//--------------------------------
function doShowFilter() {
//--------------------------------
	var isShowFilter=$('#inputShowFilter').val();
	if(isShowFilter==1) { $('#mySearchFilter').show(); }
	if(isShowFilter==0) { $('#mySearchFilter').hide(); }
}
//--------------------------------
function doAdd() {
//--------------------------------
	$('#doaction').val('add');
	$('#mySearchForm').submit();
}
//---------------------------------------------------
function System_PageRefreshTimer(sec) { System_AutoSubmitTimer = setTimeout('System_PageRefresh()', sec*1000); }
function System_PageRefresh() { $('#idSystemRefreshForm').submit(); }
//---------------------------------------------------

//---------------------------------------------------
$(document).ready(function() {
//---------------------------------------------------
    $('#idLogoutLink').click(function() {
        doAlert('ออกจากระบบสำเร็จ','success');
        $('#myLogoutForm').submit();
    });
    $('#idLogoutLink2').click(function() {
        doAlert('ออกจากระบบสำเร็จ','success');
        $('#myLogoutForm').submit();
    });
});
//---------------------------------------------------