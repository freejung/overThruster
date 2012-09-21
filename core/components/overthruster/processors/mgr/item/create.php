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
 * Create an Item
 * 
 * @package overthruster
 * @subpackage processors
 */
$alreadyExists = $modx->getObject('overThrusterItem',array(
    'name' => $_POST['name'],
));
if ($alreadyExists) {
    $modx->error->addField('name',$modx->lexicon('overthruster.item_err_ae'));
}

if ($modx->error->hasError()) {
    return $modx->error->failure();
}

$item = $modx->newObject('overThrusterItem');
$item->fromArray($_POST);

if ($item->save() == false) {
    return $modx->error->failure($modx->lexicon('overthruster.item_err_save'));
}

return $modx->error->success('',$item);