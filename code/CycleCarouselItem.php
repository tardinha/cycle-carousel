<?php
/**
 * Created by PhpStorm.
 * User: Davis Dimalen
 * Date: 14/03/14
 * Time: 04:19
 */

class CycleCarouselItem extends DataObject {

	private static $db = array(
		"Title" => 'Varchar(200)',
		"TextDescription" => 'Varchar(200)',
		"HTMLDescription" => 'HTMLText',
		"PageLink" => 'WTLink',
		"YouTubeID" => 'Varchar(200)'
	);

	private static $has_one = array(
		"CycleCarouselImage" => 'Image'
	);

	private static $belongs_many_many = array(
		"Pages" => 'Page'
	);

	private static $summary_fields = array(
		"Title" => "Title",
		"TextDescription" => 'TextDescription',
		"PageLink" => 'PageLink',
		"Thumbnail" => 'Thumbnail'
	);

	public function getThumbnail(){
		return $this->CycleCarouselImage()->CMSThumbnail();
	}

	public function getCMSFields(){
		$fields = parent::getCMSFields();

		$fields->addFieldsToTab("Root.Main", array(
			TextField::create('Title', _t("CycleCarousel.Title", "Title")),
			TextareaField::create('TextDescription', _t("CyclceCarousel.TextDescription", "Description")),
			HtmlEditorField::create('HTMLDescription', _t("CycleCarousel.HTMLDescription", "HTML Description")),
			UploadField::create('CycleCarouselImage', _t("CycleCarousel.CycleCarouselImage", "Image")),
			TextField::create('YouTubeID', _t("CycleCarousel.YouTubeID", "YouTube ID")),
			WTLinkField::create("PageLink", _t("CycleCarousel.PageLink", "Link"))
		));

		return $fields;
	}
}