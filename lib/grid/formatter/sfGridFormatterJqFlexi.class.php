<?php

/*
 * This file is part of the symfony package.
 * Leon van der Ree <leon@fun4me.demon.nl> 
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class sfGridFormatterJqFlexi extends sfGridFormatterDynamic
{
  /**
   * 
   * @param sfGridJqFlexi $grid
   */
  public function __construct(sfGridJqFlexi $grid)
  {
    // grid setup
    $this->grid = $grid;
    $this->row = new sfGridFormatterJqFlexiRow($grid, 0);
  }
  
  /**
   * Returns an array of columns, containing Json-arrays with parameters
   *
   * @return array
   */
  public function getColumnModelConfig()
  {
    $columnModelConfig = array();
    
    foreach ($this->grid->getWidgets() as $column => $widget)
    {
      $columnConfig = $widget->getColumnConfig($column);
      $columnConfig['display'] = $this->grid->getTitleForColumn($column);
      
      $columnModelConfig[] = $columnConfig;
    }
    
    return $columnModelConfig;
  }  
  
  
  /**
   * currently does it all... needs to be refactored obviously
   * @return string
   */
  public function render()
  {
    $controller = sfContext::getInstance()->getController();

    $p = json_encode(array(
      'url' => $controller->genUrl($this->grid->getUri()."?sf_format=json"),
      'dataType' => 'json',
      'method'   => 'GET',
      'colModel' => $this->getColumnModelConfig(),
//      buttons : [
//        {name: 'Add', bclass: 'add', onpress : test},
//        {name: 'Delete', bclass: 'delete', onpress : test},
//        {separator: true}
//      ],
//      searchitems : [
//        {display: 'Id', name : 'id'},
//        {display: 'Country', name : 'name', isdefault: true}
//      ],
      'sortname' => 'Id', // TODO
      'sortorder' => 'desc',
      'usepager' => true,
      'singleSelect' => true,
      'title' => $this->grid->getTitle(),
      'useRp' => false,
      'rp' => 2,
      'showTableToggleBtn' => true,
      'width' => 700,
      'height' => 200
    ));
    
    
    return "
      (function($){
        $.fn.".$this->grid->getName()."JqFlexiGrid = function() {
          return this.flexigrid(".$p.");
        };
        
      })(jQuery);
    ";    
  }

}
