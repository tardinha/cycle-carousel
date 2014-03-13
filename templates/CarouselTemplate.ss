<div class="cycle-slideshow"
	 data-cycle-fx=carousel
	 data-cycle-timeout=2000
	 data-cycle-carousel-visible=5
	 data-cycle-carousel-fluid=true
     data-cycle-prev="#prev"
     data-cycle-next="#next"
	>
    <div class="cycle-pager"></div>
	<% loop $CarouselSlides %>
		<% if CycleCarouselImage %>
			$CycleCarouselImage.CroppedImage(960, 600)
		<% end_if %>
	<% end_loop %>
</div>