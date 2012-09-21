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
 * Create overThruster templates as needed from chunks in categories
 * defined in the system settings:
 * overthruster.getResources_templates_category
 * overthruster.wayfinder_calls_category
 *
 * Initialize these templates for resources defined by the where conditions
 * either in the overThruster template otwhere field (for existing templates)
 * or in the system setting overthruster.resource_conditions
 * 
 * @package overthruster
 * @subpackage processors
 */
 
$overThruster = $modx->getService('overthruster','overThruster',$modx->getOption('overthruster.core_path',null,$modx->getOption('core_path').'components/overthruster/').'model/overthruster/');
if (!($overThruster instanceof overThruster)){
	$modx->log(modX::LOG_LEVEL_ERROR,'ERROR: cannot initialize overThruster class, aborting.');
	$modx->log(modX::LOG_LEVEL_INFO,'COMPLETED');
}else{
	set_time_limit(0);
    $modx->log(modX::LOG_LEVEL_INFO,'Refreshing overThruster...');

    $otTemplates = $modx->getCollection('otTemplate');

	/*Restore original template chunks for all overThruster templates*/
    foreach ($otTemplates as $otTemplate){
    	$chunk = $modx->getObject('modChunk', $otTemplate->chunk);
        $chunk->set('snippet',$otTemplate->original);
    	$chunk->save();
    }
    
    /*exit out of console, since initialization will be performed in front-end context anyway*/
	$modx->log(modX::LOG_LEVEL_INFO,'COMPLETED');

    /*initialize all overThruster templates*/
    foreach ($otTemplates as $otTemplate){
        $otTemplate->initialize(array(), TRUE);
    }

    $modx->log(modX::LOG_LEVEL_ERROR,'overThruster refreshed');
    return NULL;
}


 
