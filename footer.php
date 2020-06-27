<div class="text-right footer">
	<p class="footerp">HealthCare Clinic|| Harsh Mendapara</p>
</div>

<script>
	$("a[href^='#']").click(function(e) {
		e.preventDefault();
		
		var position = $($(this).attr("href")).offset().top;

		$("body, html").animate({
			scrollTop: position
		},1000);
	});

	var url = window.location.pathname;
	var filename = url.substring(url.lastIndexOf('/')+1);
	$('li a[href^="' + filename + '"]').addClass('active1');
</script>
