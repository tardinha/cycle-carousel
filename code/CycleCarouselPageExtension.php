<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 14/03/14
 * Time: 04:40
 */

class CycleCarouselPageExtension extends DataExtension{

  private static $db = array(
  );

  private static $many_many = array(
    "CycleCarouselItems" => "CycleCarouselItem"
  );

  private static $many_many_extraFields = array(
    "CycleCarouselItems" => array(
      "SortOrder" => 'Int'
    )
  );

  public function updateCMSFields(FieldList $fields) {

    $config = GridFieldConfig_RelationEditor::create(5);
    $config->addComponent(GridFieldOrderableRows::create('SortOrder'));

    $fields->addFieldToTab('Root.CycleCarouselItems',
      GridField::create('CycleCarouselItems',
        _t("CycleCarousel.CarouselItems", "Carousel items"),
        $this->owner->CycleCarouselItems(),
        $config
      )
    );
  }


  public function sortedCycleCarouselItems() {
    return $this->owner->getManyManyComponents("CycleCarouselItems")->sort("SortOrder");
  }


}


class CycleCarouselPage_ControllerExtension extends Extension {

  public function onAfterInit() {
    Requirements::css(CYCLCE_CAROUSEL_DIR.'/css/cycle-carousel.css');
    Requirements::javascript(CYCLCE_CAROUSEL_DIR.'/javascript/jquery.cycle2.min.js');
    Requirements::javascript(CYCLCE_CAROUSEL_DIR.'/javascript/jquery.cycle2.carousel.min.js');
  }


  public function CycleCarouselObject() {

    $slides = $this->owner->sortedCycleCarouselItems();

    if ($slides->exists()) {
      $data = new ArrayData(
        array(
          "CarouselSlides" => $slides
        )
      );

      return $data->renderWith('CarouselTemplate');
    } else {
      return false;
    }
  }


}