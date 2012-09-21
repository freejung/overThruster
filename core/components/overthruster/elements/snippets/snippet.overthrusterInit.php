<?php
/**
 * overThruster initialization snippet.
 *
 * @package overthruster
 */

$overThruster = $modx->getService('overthruster','overThruster',$modx->getOption('overthruster.core_path',null,$modx->getOption('core_path').'components/overthruster/').'model/overthruster/',$scriptProperties);

if (!($overThruster instanceof overThruster)) return 'cannot initialize overthruster';

$m = $modx->getManager();
$created = $m->createObjectContainer('otTemplate');
$created = $m->createObjectContainer('otOutput');

$output = $created;

return $output;