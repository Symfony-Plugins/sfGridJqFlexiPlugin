<?php

/*
 * This file is part of the symfony package.
 * Leon van der Ree <leon@fun4me.demon.nl> 
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class sfGridFormatterJsonJqFlexi extends sfGridFormatterDynamic

{
  /**
   * constructor of a Grid Formatter
   * 
   * @param sfGrid $grid
   */
  public function __construct(sfGrid $grid)
  {
    parent::__construct($grid, new sfGridFormatterJsonJqFlexiRow($grid, 0));
  }
  
  /**
   * Renders the row in HTML
   *
   * @return string
   */
  public function render()
  {
    $arrJson = array();

    $arrJson['total'] = $this->grid->getPager()->getRecordCount();
    $arrJson['page']  = $this->grid->getPager()->getPage();
    $arrJson['rows']  = $this->getData();

    return json_encode($arrJson);
  }


  public function getData()
  {
    $arrJson = array();
    foreach ($this as $row)
    {
      $arrJson[] = $row->render();
    }

    return $arrJson;
  }

}

