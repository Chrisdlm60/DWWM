
<script type="text/javascript">
    	$(function() {
				var $mySlides = $("#slides");
				$mySlides.sortable({
					opacity: 0.6,
					cursor: "move",
					update: function() {
						var order = $(this).sortable("serialize") + "&action=updateSlidesPosition";
						$.post("{$base_uri|escape:'quotes':'UTF-8'}modules/{$name_module|escape:'quotes':'UTF-8'}/ajax_{$name_module|escape:'quotes':'UTF-8'}.php?secure_key={$secure_key|escape:'quotes':'UTF-8'}", order);
						}
					});
				$mySlides.hover(function() {
					$(this).css("cursor","move");
					},
					function() {
					$(this).css("cursor","auto");
				});
			});
</script>
