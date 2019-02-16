// Placeholder for inputs
// Last modified: 15.12.12
// By: Igor K

/* Create placeholders - text box watermarks for browsers that do not support them */
function makePlaceholders() {
	$inputs = $("input, textarea");
	$inputs.each(
		function(){
		var $this = jQuery(this);
		this.placeholderVal = $this.attr("placeholder");
		$this.val(this.placeholderVal);
	})
	
	.bind("focus", function() {
		var $this = jQuery(this);
		var val = $.trim($this.val());
		if (val == this.placeholderVal || val == "") {
			$this.val("");
		}
	})
	
	.bind("blur", function() {
		var $this = jQuery(this);
		var val = $.trim($this.val());
		if (val == this.placeholderVal || val == "") {
			$this.val(this.placeholderVal);
		}
	})

}