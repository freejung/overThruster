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
 * Remove an overThruster template, restoring the associated chunk to the original code.
 * 
 * @package overthruster
 * @subpackage processors
 */

class otTemplateRemoveProcessor extends modObjectRemoveProcessor {
    public $classKey = 'otTemplate';
    public $languageTopics = array('overthruster:default');
    public $objectType = 'overthruster.ottemplate';

    public function beforeRemove() {
        $chunk = $this->modx->getObject('modChunk', $this->chunk);
        $chunk->set('snippet', $this->original);
        return $chunk->save();
    }
}
return 'otTemplateRemoveProcessor';