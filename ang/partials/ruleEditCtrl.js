(function(angular, $, _) {

  angular.module('mappins').config(function($routeProvider) {
      $routeProvider.when('/mappins/rule/:id?', {
        controller: 'MappinsruleEditCtrl',
        templateUrl: '~/mappins/ruleEditCtrl.html',

        // If you need to look up data when opening the page, list it out
        // under "resolve".
        resolve: {
          mappinsRuleProfiles: function(crmApi, $route) {
            var rule_id = $route.current.params.id;
            if (
              !isNaN(rule_id) && 
              parseInt(Number(rule_id)) == rule_id && 
              !isNaN(parseInt(rule_id, 10))
            ){
              return crmApi('mappinsRuleProfile', 'get', {
                rule_id: rule_id,
                sequential: 1
              });              
            }
            else {
              return false;
            }
          },
          profiles: function(crmApi) {
            return crmApi('uf_group', 'get', {
              return: ['id', 'title'],
              sequential: 1
            });
          }
        }
      });
    }
  );

  // The controller uses *injection*. This default injects a few things:
  //   $scope -- This is the set of variables shared between JS and HTML.
  //   crmApi, crmStatus, crmUiHelp -- These are services provided by civicrm-core.
  //   myContact -- The current contact, defined above in config().
  angular.module('mappins').controller('MappinsruleEditCtrl', function($scope, crmApi, crmStatus, crmUiHelp, mappinsRuleProfiles, profiles, $routeParams, $location, $window) {
    // The ts() and hs() functions help load strings for this module.
    var ts = $scope.ts = CRM.ts('mappins');
    var hs = $scope.hs = crmUiHelp({file: 'CRM/mappins/ruleEditCtrl'}); // See: templates/CRM/mappins/ruleEditCtrl.hlp

    // We have myContact available in JS. We also want to reference it in HTML.
//    $scope.myContact = myContact;
    
    profiles.values.push({
      'id': 0,
      'title': '(All profiles / fallback)'
    });    
    $scope.profiles = profiles.values;
    
    if (_.isObject(mappinsRuleProfiles)) {
      $scope.rule = mappinsRuleProfiles.values[0];
      $scope.rule.id = $scope.rule.rule_id;
      var uf_group_ids = [];
      for (i in mappinsRuleProfiles.values) {
        uf_group_ids.push(mappinsRuleProfiles.values[i].uf_group_id);
      }
      $scope.rule.uf_group_id = uf_group_ids;
    }
    else {
      $scope.rule = {};
    }
    
    $scope.criteriaOptions = {
      'contact_sub_type': ts('Contact Sub Type'),
      'group': ts('Group ID'),
      'tag': ts('Tag ID'),
    };    
    
    // Pass $window service so we can use it in Cancel button ng-click.
    $scope.cancel = function cancel() {
      $window.history.back();
    };

    $scope.save = function save() {
      return crmStatus(
        // Status messages. For defaults, just use "{}"
        {start: ts('Saving...'), success: ts('Saved')},
        // The save action. Note that crmApi() returns a promise.
        crmApi('MappinsRule', 'create', $scope.rule)
        .then(function(values) {
          console.log('values', values)
          $window.history.back();                  
        })
      );
    };

    $scope.openKCFinder = function openKCFinder(index, viewName) {
      window.KCFinder = {
        callBack: function (url) {
          window.KCFinder = null;
          $scope.rule.image_url = url;
          $scope.$apply();
        }
      };

      window.open(
        '/sites/all/modules/civicrm/packages/kcfinder/browse.php?cms=civicrm&type=images',
        'kcfinder_textbox_image_url',
        'status=0, toolbar=0, location=0, menubar=0, directories=0, resizable=1, scrollbars=0, width=800, height=600'
      );
    }
    
  });

})(angular, CRM.$, CRM._);
