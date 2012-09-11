(function($) {
	$.entwine('ss', function($) {
		$('.ss-gridfield .gridfield-pagination-showall input').entwine({
			onchange: function(e) {
				var gridField = this.getGridField();
				gridField.setState('GridFieldShowAll', {showAllMode: $(this).is(':checked')});
				gridField.reload();
			},
			_updateGlobalMode: function(ajaxOpts, callback) {

			}
		});
	});
})(jQuery);