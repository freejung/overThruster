<?php
/**
 * @package overthruster
 */
class otTemplate extends xPDOSimpleObject {
	
	public function initialize($where, $refresh) {
		$tvPrefix = $this->xpdo->getOption('overthruster.getResources_tv_prefix',null,'tv.');
		if(empty($where)) $where = $this->xpdo->fromJSON($this->otwhere);
		$resourceQuery = $this->xpdo->newQuery('modResource');
		if(!empty($where)) $resourceQuery->where($where);
		$resources = $this->xpdo->getCollection('modResource',$resourceQuery);
		$chunk = $this->chunk;
		switch($this->ottype) {
			case 'wayfinder':
				foreach ($resources as $resourceId => $resource) {
					$this->xpdo->switchContext($resource->get('context_key'));
					if(!$otOutput = $modx->getObject('otOutput',array('ottemplate' => $this->id, 'resource' => $resourceId))) {
		    			$otOutput = $modx->newObject('otOutput');
		    			$otOutput->addOne($this);
		    			$otOutput->set('resource',$resourceId);
	    			}else{
		    			if ($refresh) continue;
		    		}
		    		$this->xpdo->resource = $resource;
    				$this->xpdo->resourceIdentifier = $resourceId;
		    		$thisOutput = $this->xpdo->getChunk($chunk->name,array('thisid'=>$resourceId));
		    		$otOutput->set('output',$thisOutput);
		    		$otOutput->save();
				}
				break;
			case 'getResources':
			default:
				foreach ($resources as $resourceId => $resource) {
					$this->xpdo->switchContext($resource->get('context_key'));
					if(!$otOutput = $modx->getObject('otOutput',array('ottemplate' => $this->id, 'resource' => $resourceId))) {
		    			$otOutput = $modx->newObject('otOutput');
		    			$otOutput->addOne($this);
		    			$otOutput->set('resource',$resourceId);
	    			}else{
		    			if ($refresh) continue;
		    		}
		    		$templateVars = $resource->getMany('TemplateVars');
		    		$tvs = array();
		    		foreach ($templateVars as $tvId => $templateVar) {
		    			$tvs[$tvPrefix . $templateVar->get('name')] = $templateVar->renderOutput($resourceId);
		    		}
		    		$properties = array_merge($resource->toArray(),$tvs);
		    		$thisOutput = $modx2->getChunk($chunk->name,$properties);
		    		$otOutput->set('output',$thisOutput);
		    		$otOutput->save();
				}
				break;
		}
		$chunk->set('snippet','[[overThruster? &otTemplate=`'.$otTemplate->id.'` &resource=`[[+id]]`]]');
    	$chunk->save();
	}
}
?>