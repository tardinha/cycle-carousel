<div class="cycle-slideshow"
	 data-cycle-fx=carousel
	 data-cycle-timeout=1000
	 data-cycle-carousel-visible=5
	 data-cycle-carousel-fluid=true
	>
	<% loop $CarouselSlides %>
		<% if CycleCarouselImage %>
			$CycleCarouselImage.CroppedImage(400,100)
		<% end_if %>
	<% end_loop %>
</div>