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


<script type="text/javascript">

	$(".show_warning").click(function(){
		var $warning_message 	= "Are you sure?";
		$button				 	= '<form method="post" target="_self" action="products.php?mode=delete">';
		$button					+= '<button class="btn btn-warning" type="submit" name="clear_cart">Clear</button></form>';
		show_warning($warning_message,$button,"50px");
	});

</script>