<?php
/*
+--------------------------------------------------------------------+
| CiviCRM version 4.7                                                |
+--------------------------------------------------------------------+
| Copyright CiviCRM LLC (c) 2004-2017                                |
+--------------------------------------------------------------------+
| This file is a part of CiviCRM.                                    |
|                                                                    |
| CiviCRM is free software; you can copy, modify, and distribute it  |
| under the terms of the GNU Affero General Public License           |
| Version 3, 19 November 2007 and the CiviCRM Licensing Exception.   |
|                                                                    |
| CiviCRM is distributed in the hope that it will be useful, but     |
| WITHOUT ANY WARRANTY; without even the implied warranty of         |
| MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.               |
| See the GNU Affero General Public License for more details.        |
|                                                                    |
| You should have received a copy of the GNU Affero General Public   |
| License and the CiviCRM Licensing Exception along                  |
| with this program; if not, contact CiviCRM LLC                     |
| at info[AT]civicrm[DOT]org. If you have questions about the        |
| GNU Affero General Public License or the licensing of CiviCRM,     |
| see the CiviCRM license FAQ at http://civicrm.org/licensing        |
+--------------------------------------------------------------------+
*/
/**
 * @package CRM
 * @copyright CiviCRM LLC (c) 2004-2017
 *
 * Generated from xml/schema/CRM/Mappins/MappinsRuleProfile.xml
 * DO NOT EDIT.  Generated by CRM_Core_CodeGen
 * (GenCodeChecksum:df1da2abe9bedf2186f43ca8f86bcb7d)
 */
require_once 'CRM/Core/DAO.php';
require_once 'CRM/Utils/Type.php';
/**
 * CRM_Mappins_DAO_MappinsRuleProfile constructor.
 */
class CRM_Mappins_DAO_MappinsRuleProfile extends CRM_Core_DAO {
  /**
   * Static instance to hold the table name.
   *
   * @var string
   */
  static $_tableName = 'civicrm_mappins_rule_profile';
  /**
   * Should CiviCRM log any modifications to this table in the civicrm_log table.
   *
   * @var boolean
   */
  static $_log = true;
  /**
   * Unique MappinsRuleProfile ID
   *
   * @var int unsigned
   */
  public $id;
  /**
   * FK to civicrm_mappins_rule.id
   *
   * @var int unsigned
   */
  public $rule_id;
  /**
   * Rule applies only to these profiles. Implicit FK to civicrm_uf_group.id
   *
   * @var int unsigned
   */
  public $uf_group_id;
  /**
   * Relative order of this mappins_rule; lowest weights sort first.
   *
   * @var int
   */
  public $weight;
  /**
   * Class constructor.
   */
  function __construct() {
    $this->__table = 'civicrm_mappins_rule_profile';
    parent::__construct();
  }
  /**
   * Returns foreign keys and entity references.
   *
   * @return array
   *   [CRM_Core_Reference_Interface]
   */
  static function getReferenceColumns() {
    if (!isset(Civi::$statics[__CLASS__]['links'])) {
      Civi::$statics[__CLASS__]['links'] = static ::createReferenceColumns(__CLASS__);
      Civi::$statics[__CLASS__]['links'][] = new CRM_Core_Reference_Basic(self::getTableName() , 'rule_id', 'civicrm_mappins_rule', 'id');
      Civi::$statics[__CLASS__]['links'][] = new CRM_Core_Reference_Basic(self::getTableName() , 'uf_group_id', 'civicrm_uf_group', 'id');
      CRM_Core_DAO_AllCoreTables::invoke(__CLASS__, 'links_callback', Civi::$statics[__CLASS__]['links']);
    }
    return Civi::$statics[__CLASS__]['links'];
  }
  /**
   * Returns all the column names of this table
   *
   * @return array
   */
  static function &fields() {
    if (!isset(Civi::$statics[__CLASS__]['fields'])) {
      Civi::$statics[__CLASS__]['fields'] = array(
        'id' => array(
          'name' => 'id',
          'type' => CRM_Utils_Type::T_INT,
          'description' => 'Unique MappinsRuleProfile ID',
          'required' => true,
          'table_name' => 'civicrm_mappins_rule_profile',
          'entity' => 'MappinsRuleProfile',
          'bao' => 'CRM_Mappins_DAO_MappinsRuleProfile',
          'localizable' => 0,
        ) ,
        'rule_id' => array(
          'name' => 'rule_id',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Rule') ,
          'description' => 'FK to civicrm_mappins_rule.id',
          'required' => true,
          'table_name' => 'civicrm_mappins_rule_profile',
          'entity' => 'MappinsRuleProfile',
          'bao' => 'CRM_Mappins_DAO_MappinsRuleProfile',
          'localizable' => 0,
          'FKClassName' => 'CRM_Mappins_DAO_MappinsRule',
          'html' => array(
            'type' => 'Select',
          ) ,
        ) ,
        'uf_group_id' => array(
          'name' => 'uf_group_id',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Profile') ,
          'description' => 'Rule applies only to these profiles. Implicit FK to civicrm_uf_group.id',
          'required' => true,
          'table_name' => 'civicrm_mappins_rule_profile',
          'entity' => 'MappinsRuleProfile',
          'bao' => 'CRM_Mappins_DAO_MappinsRuleProfile',
          'localizable' => 0,
          'FKClassName' => 'CRM_Core_DAO_UFGroup',
          'html' => array(
            'type' => 'Select',
          ) ,
          'pseudoconstant' => array(
            'callback' => 'CRM_Mappins_BAO_MappinsRule::getUFGroupOptions',
          )
        ) ,
        'weight' => array(
          'name' => 'weight',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Order') ,
          'description' => 'Relative order of this mappins_rule; lowest weights sort first.',
          'default' => '1',
          'table_name' => 'civicrm_mappins_rule_profile',
          'entity' => 'MappinsRuleProfile',
          'bao' => 'CRM_Mappins_DAO_MappinsRuleProfile',
          'localizable' => 0,
        ) ,
      );
      CRM_Core_DAO_AllCoreTables::invoke(__CLASS__, 'fields_callback', Civi::$statics[__CLASS__]['fields']);
    }
    return Civi::$statics[__CLASS__]['fields'];
  }
  /**
   * Return a mapping from field-name to the corresponding key (as used in fields()).
   *
   * @return array
   *   Array(string $name => string $uniqueName).
   */
  static function &fieldKeys() {
    if (!isset(Civi::$statics[__CLASS__]['fieldKeys'])) {
      Civi::$statics[__CLASS__]['fieldKeys'] = array_flip(CRM_Utils_Array::collect('name', self::fields()));
    }
    return Civi::$statics[__CLASS__]['fieldKeys'];
  }
  /**
   * Returns the names of this table
   *
   * @return string
   */
  static function getTableName() {
    return self::$_tableName;
  }
  /**
   * Returns if this table needs to be logged
   *
   * @return boolean
   */
  function getLog() {
    return self::$_log;
  }
  /**
   * Returns the list of fields that can be imported
   *
   * @param bool $prefix
   *
   * @return array
   */
  static function &import($prefix = false) {
    $r = CRM_Core_DAO_AllCoreTables::getImports(__CLASS__, 'mappins_rule_profile', $prefix, array());
    return $r;
  }
  /**
   * Returns the list of fields that can be exported
   *
   * @param bool $prefix
   *
   * @return array
   */
  static function &export($prefix = false) {
    $r = CRM_Core_DAO_AllCoreTables::getExports(__CLASS__, 'mappins_rule_profile', $prefix, array());
    return $r;
  }
  /**
   * Returns the list of indices
   */
  public static function indices($localize = TRUE) {
    $indices = array(
      'index_rule_id' => array(
        'name' => 'index_rule_id',
        'field' => array(
          0 => 'rule_id',
        ) ,
        'localizable' => false,
        'sig' => 'civicrm_mappins_rule_profile::0::rule_id',
      ) ,
      'index_uf_group_id' => array(
        'name' => 'index_uf_group_id',
        'field' => array(
          0 => 'uf_group_id',
        ) ,
        'localizable' => false,
        'sig' => 'civicrm_mappins_rule_profile::0::uf_group_id',
      ) ,
    );
    return ($localize && !empty($indices)) ? CRM_Core_DAO_AllCoreTables::multilingualize(__CLASS__, $indices) : $indices;
  }
}
