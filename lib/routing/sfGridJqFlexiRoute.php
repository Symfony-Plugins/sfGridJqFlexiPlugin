<?php
/**
 * sfGridJqFlexiRoute represents a route that is bound to an GridJqFlexi-class.
 *
 * A grid route can only represent a single Grid object.
 *
 * @package    symfony
 * @subpackage routing
 * @author     Leon van der Ree
 * @version    SVN: $Id:  $
 */
class sfGridJqFlexiRoute extends sfGridRoute
{
  public function __construct($pattern, array $defaults = array(), array $requirements = array(), array $options = array())
  {
    
    if (strpos($pattern,':sf_format') === false)
    {
      $pattern .= '.:sf_format';
    }
    
    $defaults = array_merge(
      array(
        'module' => 'jqFlexiGrid', 
        'action' => 'index', 
        'sf_format' => 'html',
      ),
      $defaults
    ); 
    
    if (!isset($requirements['sf_method']))
    {
      $requirements['sf_method'] = array('get', 'head', 'post');
    }
    else
    {
      $requirements['sf_method'] = array_map('strtolower', (array) $requirements['sf_method']);
    }
    
    parent::__construct($pattern, $defaults, $requirements, $options);
  }
  
  
  protected function getObjectForParameters($parameters)
  {
    $request = sfContext::getInstance()->getRequest();
    $getParameters = $request->getGetParameters();
    
    // translate params
    if (isset($getParameters['page']))      $parameters['page'] = $getParameters['page'];
    if (isset($getParameters['sortname']))  $parameters['sort'] = $getParameters['sortname'];
    if (isset($getParameters['sortorder'])) $parameters['type'] = $getParameters['sortorder'];
    
    return parent::getObjectForParameters($parameters); 
  }
  
}