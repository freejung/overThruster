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
    $modx->log(modX::LOG_LEVEL_INFO,'Initializing overThruster...');
    
    /*get configuration system settings*/
    $refresh = $modx->getOption('overthruster.refresh',null,1);
    $getResourcesTplCat = $modx->getOption('overthruster.getResources_templates_category',null,1);
    $wayfinderCallsCat = $modx->getOption('overthruster.wayfinder_calls_category',null,1);
    $resourceConditions = $modx->getOption('overthruster.resource_conditions',null,0);
	
	/*get the getResources and Wayfinder template categories and chunks, and confirm to user*/
	$getResourcesCat = $modx->getObject('modCategory',$getResourcesTplCat);
	$wayfinderCat = $modx->getObject('modCategory',$wayfinderCallsCat);    
	$getResourcesTemplates = $getResourcesCat->getMany('Chunks');
	$wayfinderCalls = $wayfinderCat->getMany('Chunks');
	$allTemplates = array_merge($getResourcesTemplates, $wayfinderCalls);
    $modx->log(modX::LOG_LEVEL_INFO,'Wayfinder Calls Category = '.$wayfinderCat->category);
    $modx->log(modX::LOG_LEVEL_INFO,'getResources Template Category = '.$getResourcesCat->category);

    $whereArray = array();
	if($resourceConditions) {	
		$whereArray = $modx->fromJSON($resourceConditions);
	}

	/*Restore original template chunks for existing overThruster templates, create new ones if needed*/
    foreach ($getResourcesTemplates as $temp){
    	if($otTemplate = $modx->getObject('otTemplate',array('chunk'=>$temp->id))){
    		$modx->log(modX::LOG_LEVEL_INFO,'using otTemplate '.$otTemplate->id);
    		$temp->set('snippet',$otTemplate->original);
    		$temp->save();
    	}else{
    		$otTemplate = $modx->newObject('otTemplate');
    		$otTemplate->set('chunk',$temp->id);
    		$otTemplate->set('original',$temp->snippet);
    		$otTemplate->set('ottype','getResources');
    		if($whereArray[$temp->name]) {
    			$otTemplate->set('otwhere', $modx->toJSON($whereArray[$temp->name]));
    		}
    	    $otTemplate->save();
    	    $modx->log(modX::LOG_LEVEL_INFO,'created new otTemplate '.$otTemplate->id);
    	} 
    }
    foreach ($wayfinderCalls as $temp){
    	if($otTemplate = $modx->getObject('otTemplate',array('chunk'=>$temp->id))){
    		$modx->log(modX::LOG_LEVEL_INFO,'using otTemplate '.$otTemplate->id);
    		$temp->set('snippet',$otTemplate->original);
    		$temp->save();
    	}else{
    		$otTemplate = $modx->newObject('otTemplate');
    		$otTemplate->set('chunk',$temp->id);
    		$otTemplate->set('original',$temp->snippet);
    		$otTemplate->set('ottype','wayfinder');
    		if($whereArray[$temp->name]) {
    			$otTemplate->set('otwhere', $modx->toJSON($whereArray[$temp->name]));
    		}
    	    $otTemplate->save();
    	    $modx->log(modX::LOG_LEVEL_INFO,'created new otTemplate '.$otTemplate->id);
    	} 
    }
    
    /*exit out of console, since initialization will be performed in front-end context anyway*/
	$modx->log(modX::LOG_LEVEL_INFO,'COMPLETED');

    /*initialize overThruster templates, skipping existing ones if the refresh system setting is false*/
    foreach ($allTemplates as $temp){
    	$otTemplate = $modx->getObject('otTemplate',array('chunk'=>$temp->id));
    	$otTemplate->initialize(array(), $refresh);
	}

	$modx->log(modX::LOG_LEVEL_ERROR,'overThruster active and updated');
    return NULL;
}


 
