var AccountListController = angular.module('AccountListController', []);

AccountListController.controller('AccountListCtrl', function ($scope, $http) {
	
  //   $http({ method: 'GET', url: '/student-portal/administrator/accountlist', cache: true }).
		// success(function(data, status) {
 	// 		$scope.users = data;
		// });

    $http.get('/student-portal/administrator/accountlist').success(function(data, status){
        $scope.users = data;
    });
});