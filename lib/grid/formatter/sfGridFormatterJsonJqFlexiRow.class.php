<?php

/*
 * This file is part of the symfony package.
 * Leon van der Ree <leon@fun4me.demon.nl> 
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * A formatter that renders a row as JSON
 *
 */
class sfGridFormatterJsonJqFlexiRow extends sfGridFormatterDynamicRow
{

  /**
   * Renders a row to an array
   *
   * @return string
   */
  public function render()
  {
    $source = $this->grid->getDataSource();
    $source->seek($this->index);

    $arrData = array();
    
     
    $arrData['cell']  = array();
    
    $widgets = $this->grid->getWidgets();
    foreach ($widgets as $column => $widget)
    {
      $arrData['cell'][] = $widget->render($column, $source[$column]);
    }
    $key = 'Id';
    $idWidget = $widgets[$key];
    $arrData['id']    = $idWidget->render($key, $source[$key]);

    return $arrData;
  }

}