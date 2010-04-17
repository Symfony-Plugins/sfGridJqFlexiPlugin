<?php
/*
 * This file is part of the symfony package.
 * Leon van der Ree <leon@fun4me.demon.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 *
 * @package    symfony
 * @subpackage grid-JqFlexi
 * @author     Leon van der Ree <leon@fun4me.demon.nl>
 * @version    SVN: $Id$
 */
class sfWidgetJqFlexi extends sfWidget
{
  protected $type = 'string';

  /**
   * renders value (you can extend this class and pre-process this value)
   *
   * @see sfWidget#render()
   */
  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    return $value;
  }

    
  /**
   * Returns the column-definition for ColumnModel
   * this is defined in the widget, to allow you to define the type
   *
   * @param string $name
   * @return array
   */
  public function getColumnConfig($name)
  {
    $arrJs = array(
      'name'      => $name,
      'width'     => 140,
      'sortable'  => true,
      'align'     => 'center',
    );
    
    return $arrJs;
  }
  
}