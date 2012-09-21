<?php
/**
 * overThruster
 *
 * Copyright 2012 by Eli Snyder <freejung@gmail.com>
 *
 * overThruster is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * overThruster is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * overThruster; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package overthruster
 */
/**
 * Deactivate overThruster by restoring all chunks to their original form
 * and removing all overThruster templates
 * 
 * @package overthruster
 * @subpackage processors
 */
 
$overThruster = $modx->getService('overthruster','overThruster',$modx->getOption('overthruster.core_path',null,$modx->getOption('core_path').'components/overthruster/').'model/overthruster/');
if (!($overThruster instanceof overThruster)){
	$modx->log(modX::LOG_LEVEL_ERROR,'ERROR: cannot initialize overThruster class, aborting.');
	$modx->log(modX::LOG_LEVEL_INFO,'COMPLETED');
}else{
    $modx->log(modX::LOG_LEVEL_INFO,'Deactivating overThruster...');

    $otTemplates = $modx->getCollection('otTemplate');

    foreach ($otTemplates as $otTemplate){
        $temp = $modx->getObject('modChunk', $otTemplate->chunk);
        $modx->log(modX::LOG_LEVEL_INFO,'restoring template '.$temp->name);
    	$temp->set('snippet',$otTemplate->original);
    	$temp->save();
    	$otTemplate->remove();
    }
    $modx->log(modX::LOG_LEVEL_INFO,'Overthruster Deactivated');
    $modx->log(modX::LOG_LEVEL_INFO,'COMPLETED');
}


 
