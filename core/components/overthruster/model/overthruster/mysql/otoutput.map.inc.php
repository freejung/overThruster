<?php
/**
 * @package overthruster
 */
$xpdo_meta_map['otOutput']= array (
  'package' => 'overthruster',
  'version' => '1.1',
  'table' => 'ot_outputs',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'ottemplate' => 0,
    'resource' => 0,
    'output' => NULL,
  ),
  'fieldMeta' => 
  array (
    'ottemplate' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
    'resource' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
    'output' => 
    array (
      'dbtype' => 'mediumtext',
      'phptype' => 'string',
    ),
  ),
  'indexes' => 
  array (
    'resource' => 
    array (
      'alias' => 'Resource',
      'primary' => false,
      'unique' => false,
      'type' => 'BTREE',
      'columns' => 
      array (
        'resource' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
    'ottemplate' => 
    array (
      'alias' => 'otTemplate',
      'primary' => false,
      'unique' => false,
      'type' => 'BTREE',
      'columns' => 
      array (
        'ottemplate' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
  ),
  'aggregates' => 
  array (
    'Resource' => 
    array (
      'class' => 'modResource',
      'local' => 'resource',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
    'otTemplate' => 
    array (
      'class' => 'otTemplate',
      'local' => 'ottemplate',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
);
