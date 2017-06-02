<?php

namespace Civi\API\Mappins;

/**
 * Description of Api3SelectQuery
 *
 * @author as
 */
class Api3SelectQuery extends \Civi\API\Api3SelectQuery {
  
  public $extraSelectFields;
  
  function __construct($entity, $checkPermissions) {
    parent::__construct($entity, $checkPermissions);
    $this->buildExtraSelectFields();
  }
  
  function buildWhereClause() {
    parent::buildWhereClause();
    
    $filters = array();
    foreach($this->where as $key => $value) {
      $table_name = $column_name = NULL;
      
      $key = str_replace('civicrm_mappins_rule.', '', $key);
      if (array_key_exists('r.' . $key, $this->extraSelectFields)) {
        $table_name = 'r';
        $column_name = $key;
      }
      if ((!$table_name) || empty($key) || is_null($value)) {
        // No valid filter field. This might be a chained call or something.
        // Just ignore this for the $where_clause.
        continue;
      }
      $operator = is_array($value) ? \CRM_Utils_Array::first(array_keys($value)) : NULL;
      if (!in_array($operator, \CRM_Core_DAO::acceptedSQLOperators(), TRUE)) {
        $value = array('=' => $value);
      }
      $filters[$key] = \CRM_Core_DAO::createSQLFilter("{$table_name}.{$column_name}", $value);
      
    }
    // Add the remaining params using AND
    foreach ($filters as $filter) {
      $this->query->where($filter);
    }
  }
  
  function buildSelectFields() {
    parent::buildSelectFields();
    $this->selectFields = array_merge($this->selectFields, $this->extraSelectFields);
  }
  
  private function buildExtraSelectFields() {
    $rule_field_names = array();
    $ruleprofile_dao_name = \CRM_Core_DAO_AllCoreTables::getClassForTable('civicrm_mappins_rule_profile');
    $ruleprofile_dao = new $ruleprofile_dao_name;
    $ruleprofile_field_names = array_keys($ruleprofile_dao->fields());

    $rule_dao_name = \CRM_Core_DAO_AllCoreTables::getClassForTable('civicrm_mappins_rule');
    $rule_dao = new $rule_dao_name;

    foreach (array_keys($rule_dao->fields()) as $rule_field_name) {
      if (!in_array($rule_field_name, $ruleprofile_field_names)) {
        $rule_field_names['r.'.$rule_field_name] = $rule_field_name;
      }
    }
    
    $this->extraSelectFields = $rule_field_names;
    
  }
}