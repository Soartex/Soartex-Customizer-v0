// Main Google Analitics
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-39887626-8']);
_gaq.push(['_trackPageview']);
(function() {
	var ga = document.createElement('script');
	ga.type = 'text/javascript';
	ga.async = true;
	ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	var s = document.getElementsByTagName('script')[0];
	s.parentNode.insertBefore(ga, s);
})();
    
// Google Analitics Link Code
function trackOutboundLink(link, category, action) {
try {
	_gaq.push(['_trackEvent', category, action]);
} catch(err) {
}
}