angular.module('iskliteApp', ["ngSanitize","ui.select"])

	.service('GeneralService' ,function(){
	    this.getTimeDifference = function(firstDateString,secondDateString){
				var secondDate; 
				var firstDate;
				var timeDifference;
				var returnString;
				if(!firstDateString){
					firstDate = new Date();
				}else{
					firstDate = new Date(firstDateString);
				}

				if(!secondDateString){
					secondDate = new Date();
				}else{
					secondDate = new Date(secondDateString);
				}

				timeDifference = secondDate.getTime() - firstDate.getTime();
				if(timeDifference<3600000){
					returnString = Math.floor(timeDifference/60000) + " dakika";
				}else if(timeDifference<86400000){
					returnString = Math.floor(timeDifference/3600000) + " saat";
				}else if(timeDifference>86400000){
					returnString = Math.floor(timeDifference/86400000) + " gün";
				}

				return returnString; 
			};
		
    })

	.controller('joblistingController', function($scope, $http, $location) {
		$scope.jobs = [];

		
		

		$scope.getJobs = function(){

			var params = {
				action: "inv_isklite_jobs",
				search_categories: $scope.search_categories,
				search_keywords: $scope.search_keywords
			};



			$http({
			  method: 'POST',
			  url: myAjax.ajaxurl,
			  params: params
			}).then(function successCallback(response) {
			    $scope.jobs = response.data;
			  }, function errorCallback(response) {
			    console.log(response);
			});
		}

		
 	})

 	.controller('basicSearchController', function($scope, $http) {
		$scope.generalFields = [];
		$scope.search = {
			category:'',
			keyword:''
		};



		$http({
		  method: 'POST',
		  url: myAjax.ajaxurl,
		  params: {action: "inv_isklite_general_params"}
		}).then(function successCallback(response) {
		    $scope.generalFields = response.data;
		    console.log($scope.generalFields);
		  }, function errorCallback(response) {
		    console.log(response);
		});


 	})

 	.controller('singleJoblistingController', function($scope, $http, GeneralService) {
		$scope.$watch('jobId',function(newValue,oldValue) {
		  if(newValue) {
		    $http({
			  method: 'POST',
			  url: myAjax.ajaxurl,
			  params: {action: "inv_isklite_singlejobs",id:$scope.jobId}
			}).then(function successCallback(response) {
				console.log(response.data);
			    $scope.job = response.data;
			  }, function errorCallback(response) {
			    console.log(response);
			});
		  }
		});

		$scope.makeSearch = function(){
			
		}		

		$scope.getTimeDifference = function(startDate){
			if(startDate){
				return GeneralService.getTimeDifference(startDate,null);
			}else{
				return '';
			}
		}
		
 	});