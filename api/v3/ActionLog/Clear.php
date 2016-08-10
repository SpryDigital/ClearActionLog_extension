<?php

require_once 'CRM/ClearActionLog/DAO/ClearActionLog.php';

/**
 * ActionLog.Clear API specification (optional)
 * This is used for documentation and validation.
 *
 * @param array $spec description of fields supported by this API call
 * @return void
 * @see http://wiki.civicrm.org/confluence/display/CRM/API+Architecture+Standards
 */
function _civicrm_api3_action_log_Clear_spec(&$spec) {
  $lock = Civi::lockManager()->acquire('worker.core.ActionLog');
  if (!$lock->isAcquired()) {
    return civicrm_api3_create_error('Could not acquire lock, another ActionLog process is running');
  }

  $result = CRM_DAO_ClearActionLog::clearTable();
  $lock->release();

  if ($result['is_error'] == 0) {
    return civicrm_api3_create_success();
  }
  else {
    return civicrm_api3_create_error($result['messages']);
  }
}

/**
 * ActionLog.Clear API
 *
 * @param array $params
 * @return array API result descriptor
 * @see civicrm_api3_create_success
 * @see civicrm_api3_create_error
 * @throws API_Exception
 */
function civicrm_api3_action_log_Clear($params) {
//  if (array_key_exists('magicword', $params) && $params['magicword'] == 'sesame') {
//    $returnValues = array( // OK, return several data rows
//      12 => array('id' => 12, 'name' => 'Twelve'),
//      34 => array('id' => 34, 'name' => 'Thirty four'),
//      56 => array('id' => 56, 'name' => 'Fifty six'),
//    );
    // ALTERNATIVE: $returnValues = array(); // OK, success
    // ALTERNATIVE: $returnValues = array("Some value"); // OK, return a single value

    // Spec: civicrm_api3_create_success($values = 1, $params = array(), $entity = NULL, $action = NULL)
//    return civicrm_api3_create_success($returnValues, $params, 'NewEntity', 'NewAction');
//  } else {
//    throw new API_Exception(/*errorMessage*/ 'Everyone knows that the magicword is "sesame"', /*errorCode*/ 1234);
//  }
}

