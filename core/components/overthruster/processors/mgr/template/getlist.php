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
 * Get a list of overThruster templates
 *
 * @package overthruster
 * @subpackage processors
 */
class otTemplateGetListProcessor extends modObjectGetListProcessor {
    public $classKey = 'otTemplate';
    public $languageTopics = array('overthruster:default');
    public $defaultSortField = 'chunk';
    public $defaultSortDirection = 'ASC';
    public $objectType = 'overthruster.ottemplate';

    public function prepareQueryBeforeCount(xPDOQuery $c) {
        $query = $this->getProperty('query');
        if (!empty($query)) {
            $c->where(array(
                'chunk:LIKE' => '%'.$query.'%',
                'OR:original:LIKE' => '%'.$query.'%',
            ));
        }
        return $c;
    }

    public function prepareRow(xPDOObject $object) {
        $output = $object->toArray();
        $chunk = $this->modx->getObject('modChunk', $object->chunk);
        $output['chunkname'] = $chunk->name;
        return $output;
    }
}
return 'otTemplateGetListProcessor';