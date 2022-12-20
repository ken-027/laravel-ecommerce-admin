<script>
	(function($) {

		$("#f_newsletter_email").on('blur keyup change paste', function(event) {
			var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
			var f_newsletter_email = document.getElementById("f_newsletter_email").value;
			if(f_newsletter_email == "") {
				$("#f_newsletter_email_error_msg").show().text('Please enter email address');
				return false;
			} else if(f_newsletter_email!='' && !f_newsletter_email.match(mailformat)) {
				$("#f_newsletter_email_error_msg").show().text('Please enter email address');
				return false;
			} else {
				$("#f_newsletter_email_error_msg").hide();
			}
		});

		$(".f_newsletter_btn").on("click", function() {
			var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
			var f_newsletter_email = document.getElementById("f_newsletter_email").value;
			if(f_newsletter_email == "") {
				$("#f_newsletter_email_error_msg").show().text('Please enter email address');
				return false;
			} else if(f_newsletter_email!='' && !f_newsletter_email.match(mailformat)) {
				$("#f_newsletter_email_error_msg").show().text('Please enter email address');
				return false;
			} else {
				$("#f_newsletter_email_error_msg").hide();
			}
			
			$("#f_newsletter_form").submit();
		});

		$('.srch_list_of_model').autocomplete({
			serviceUrl: '/ajax/get_autocomplete_data.php',
			onSelect: function(suggestion) {
				window.location.href = suggestion.url;
			},
			onHint: function (hint) {
				console.log("onHint");
			},
			onInvalidateSelection: function() {
				console.log("onInvalidateSelection");
			},
			onSearchStart: function(params) {
				console.log("onSearchStart");
			},
			onHide: function(container) {
				console.log("onHide");
			},
			onSearchComplete: function (query, suggestions) {
				console.log("onSearchComplete",suggestions);
			},
			showNoSuggestionNotice: true,
			noSuggestionNotice: "We didn't find any matching devices...",
		});

		$('.block.brands ul.box-styled li a').matchHeight();
	})(jQuery);
</script><div class="autocomplete-suggestions" style="position: absolute; display: none; width: 745.994px; top: 855.636px; left: 346.818px; max-height: 300px; z-index: 9999;"></div>

<iframe id="gistScript" style="position: absolute !important; width: 0; !important; height: 0; !important; top: 0 !important; left: 0 !important; border: none !important; display: block !important; z-index: -1 !important;"></iframe><div id="gist-app" style="transform: none;">
<div style="transform: none;"><div class="gist-messenger-iframe gist-frame-enter gist-frame-enter-active" style="display: block; visibility: hidden; opacity: 1; height: calc(100% - 130px); position: fixed; width: 380px; border: none; background: white; overflow: hidden; box-shadow: rgba(0, 0, 0, 0.16) 0px 5px 40px; z-index: 2147483002; transform: translateY(0px); max-height: 720px; border-radius: 8px; right: 20px; bottom: 110px; transition: opacity 150ms ease 0s, visibility 150ms ease 0s, transform 150ms ease 0s;">
<iframe allowfullscreen="" style="height: 100%; width: 100%; border: none;">
</iframe></div><div class="gist-messenger-bubble-iframe"><iframe style="display: block; z-index: 2147483001; height: 60px; width: 60px; min-height: 60px; min-width: 60px; position: fixed; border: none; top: unset; left: unset; right: 20px; bottom: 20px;"></iframe></div><div class="gist-notification-iframe" style="display: none;"><iframe></iframe></div><div class="gist-post-iframe" style="display: none;"><iframe></iframe></div><div class="gist-post-small-iframe" style="display: none;"><iframe></iframe></div><div class="gist-prompt-iframe" style="display: none;"><iframe></iframe></div><div class="gist-article-sidebar-iframe" style="height: 0px; width: 0px;"><iframe width="0" height="0" style="opacity: 0; border-width: 0px; transform: translate3d(100%, 0px, 0px);"></iframe></div><div class="gist-image-preview" style="width: 100%; height: 100%; position: fixed; top: 0px; display: none; z-index: 2147483647;"><iframe style="width: 100%; height: 100%; border: none;"></iframe></div></div></div>
