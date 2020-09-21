<form name="myRedirectForm" id="myRedirectForm" target="_top" method="get" action="../home/"></form>
<script language="JavaScript" type="text/JavaScript">
autoSubmitTimer = setTimeout('submitMe()', 0);
function submitMe() { document.myRedirectForm.submit(); }
</script>