$(function() {
	var hash = window.location.hash;
	hash && $('ul.nav a[href="' + hash + '"]').tab('show');
});
function disableButtons() {
	$('.btn').each(function() {
		$(this).attr('disabled', 'disabled');
		$(this).attr('value', 'Please Wait....');
		$(this).parents('form').submit();
	});
}
function trackTab(someurl){
    _gaq.push(['_trackPageview', location.pathname + location.search + '#' + someurl]);
}