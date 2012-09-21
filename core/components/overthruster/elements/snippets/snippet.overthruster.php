<?php
/**

 * The base overThruster snippet.

 *

 * @package overthruster

 */

$overThruster = $modx->getService('overthruster','overThruster',$modx->getOption('overthruster.core_path',null,$modx->getOption('core_path').'components/overthruster/').'model/overthruster/',$scriptProperties);

if (!($overThruster instanceof overThruster)) return 'cannot initialize overthruster';



//$m = $modx->getManager();
//$created = $m->createObjectContainer('otTemplate');
//$created = $m->createObjectContainer('otOutput');

//$output = $created;

$otTemplate = $modx->getOption('otTemplate',$scriptProperties,0);
$resource = $modx->getOption('resource',$scriptProperties,0);

if($otTemplate && $resource && $otOutput = $modx->getObject('otOutput', array('resource' => $resource, 'ottemplate' => $otTemplate))) {
	$output = $otOutput->output;
}


return $output;