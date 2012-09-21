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
 * Create an overThruster template
 * 
 * @package overthruster
 * @subpackage processors
 */

class otTemplateCreateProcessor extends modObjectCreateProcessor {
    public $classKey = 'otTemplate';
    public $languageTopics = array('overthruster:default');
    public $objectType = 'overthruster.ottemplate';

    public function beforeSave() {
        $chunk = $this->getProperty('chunk');

        if (empty($chunk)) {
            $this->addFieldError('name',$this->modx->lexicon('overthruster.otTemplate_err_ns_name'));
        } else if ($this->doesAlreadyExist(array('chunk' => $chunk))) {
            $this->addFieldError('name',$this->modx->lexicon('overthruster.otTemplate_err_ae'));
        }
        $chunk = $this->modx->getObject('modChunk', $this->getProperty('chunk'));
        $this->setProperty('original', $chunk->snippet);
        return parent::beforeSave();
    }

    public function afterSave() {
        $this->object->initialize(array(), TRUE);
        return parent::afterSave();
    }
}
return 'otTemplateCreateProcessor';