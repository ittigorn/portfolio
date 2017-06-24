<!--
THIS MODULE ENABLES THE PAGE TO HAVE A POPUP LANGUAGE CHOOSER

This module supports 2 languages:
- Thai
- English

When a language is chosen:
- If English then it will disappear because that's the default
- If Thai then it will link to a url where cookie will be set

REQUIREMENTS:
- jQuery
- Pictures for the Thai and US flags
- Check the link that's on Thai flag, make sure it's correct with GET variables
- Also add a link to choose_language.scss
- Make sure .fader is already hidden in global.scss

-->
<?php 
// This will only run if there's no cookie for language preference
if (!isset($_COOKIE["language"])) { ?>

	<!-- FADER FOR LANGUAGE CHOOSER -->
	<div class="fader choose_language_fader" style="background-color: #000000;"></div>

	<!-- LANGUAGE BOX -->
	<div class="language_box">
		<div class="centered">
			<a href="language.php?page=index&amp;switch=true"><img src="_images/_choose_language/th.jpg" title="ภาษาไทย"></a>
			<p><a href="language.php?page=index&amp;switch=true">ภาษาไทย</a></p>
			
			<a class="hide_language_box"><img src="_images/_choose_language/en.jpg" title="U.S. English"></a>
			<p><a class="hide_language_box">U.S. English</a></p>
			
		</div>
	</div>

	<script type="text/javascript">
		
		$(document).ready(function(){

			// DECLARING ADJUSTABLE VARIABLES
			var $effect_duration = 100;

			var $win = {
					"height" : $(window).height(), 
			        "width" : $(window).width(), 
					"outerHeight" : $(window).outerHeight(), 
					"outerWidth" : $(window).outerWidth() 
				};

			// DECLARING FUNCTIONS
			function fade_in_fader(){

				$(".choose_language_fader").css({
					"width" : "100%", 
					"height" : "100%", 
					"position" : "fixed", 
					"top" : "0" , 
					"left" : "0", 
					"opacity" : ".65", 
					"z-index" : "200"
				});

				$(".choose_language_fader").fadeIn($effect_duration);

			} // end function

			function fade_in_language_box(){

				$top = (($win.height / 2) - 120) + "px";

				$(".language_box").css({
					"width" : "100%", 
					"position" : "fixed", 
					"top" : $top, 
					"left" : "0", 
					"z-index" : "300"
				});

				$(".language_box").fadeIn($effect_duration);

			} // end function


			// WORKING CODES FROM NOW ON
			fade_in_fader();
			fade_in_language_box();

			// if .hide is clicked
			$("a.hide_language_box").click(function(){
				$(".language_box").fadeOut($effect_duration);
				$(".choose_language_fader").fadeOut($effect_duration);
			});

		});

	</script>

<?php } // end if language cookie is not set ?>