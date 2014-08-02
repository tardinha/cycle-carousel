<?php
/**
 * Created by PhpStorm.
 * User: Davis Dimalen
 * Date: 14/03/14
 * Time: 04:19
 */

class CycleCarouselItem extends DataObject {

  private static $db = array(
    "Title"           => 'Varchar(255)',
    "TextDescription" => 'Varchar(255)'
  );

  private static $has_one = array(
    'CycleCarouselLink'   => 'Link',
    'CycleCarouselVideo'  => 'VideoPage',
    "CycleCarouselImage"  => 'Image',
    "CycleCarouselFile"   => 'File'
  );

  private static $belongs_many_many = array(
    "Pages" => 'Page'
  );

  private static $summary_fields = array(
    "Title"           => "Title",
    "TextDescription" => 'TextDescription',
    "Thumbnail"       => 'Thumbnail'
  );

  public function getThumbnail() {
    if ($this->CycleCarouselVideo()->ID && $this->CycleCarouselImage()->ID) {
      return $this->CycleCarouselImage()->CMSThumbnail();
    } else if ($this->CycleCarouselVideo()->ID) {
      return $this->CycleCarouselVideo()->getMediaThumb()->CMSThumbnail();
    } else {
      return $this->CycleCarouselImage()->CMSThumbnail();
    }
  }

  public function getSlideImage() {
    if ($this->CycleCarouselVideo()->ID) {
      return $this->CycleCarouselVideo()->getMediaThumb();
    } else {
      return $this->CycleCarouselImage();
    } 
  }

  public function getCMSFields() {
    $fields = parent::getCMSFields();

    $fields->removeByName('Pages');

    $fields->addFieldsToTab("Root.Main", array(
        TextField::create('Title', _t("CycleCarousel.Title", "Title")),
        TextareaField::create('TextDescription', _t("CyclceCarousel.TextDescription", "Description")),
        LinkField::create('CycleCarouselLinkID', _t("CycleCarousel.CycleCarouselLink", "Link")),
        DropdownField::create(
          'CycleCarouselVideoID',
          _t("CycleCarousel.CycleCarouselVideo", "Related Video"),
          VideoPage::get()->map('ID', 'Title'))
        ->setEmptyString('Please choose...'
        ),
        UploadField::create('CycleCarouselImage', _t("CycleCarousel.CycleCarouselImage", "Image"))->setFolderName('slides/images')->useMultisitesFolder(),
        UploadField::create('CycleCarouselFile', _t("CycleCarousel.CycleCarouselFile", "File"))->setFolderName('slides/files')->useMultisitesFolder()
      ));

    return $fields;
  }


}