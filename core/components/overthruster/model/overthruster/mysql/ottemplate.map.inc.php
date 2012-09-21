<?php
/**
 * @package overthruster
 */
$xpdo_meta_map['otTemplate']= array (
  'package' => 'overthruster',
  'version' => '1.1',
  'table' => 'ot_templates',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'chunk' => 0,
    'original' => NULL,
  ),
  'fieldMeta' => 
  array (
    'chunk' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
    'original' => 
    array (
      'dbtype' => 'mediumtext',
      'phptype' => 'string',
    ),
  ),
  'indexes' => 
  array (
    'chunk' => 
    array (
      'alias' => 'chunk',
      'primary' => false,
      'unique' => false,
      'type' => 'BTREE',
      'columns' => 
      array (
        'chunk' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
  ),
  'composites' => 
  array (
    'otOutput' => 
    array (
      'class' => 'otOutput',
      'local' => 'id',
      'foreign' => 'ottemplate',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
  ),
  'aggregates' => 
  array (
    'Chunk' => 
    array (
      'class' => 'modChunk',
      'local' => 'chunk',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
);
