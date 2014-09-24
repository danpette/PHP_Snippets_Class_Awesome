#Virtual sort when using dragable interface.
#input e with fields: e.newIndex, e.fromIndex
#example using angular, can use for loop and another array of object
#Replace 99 with max int if needed

var i = 0;
angular.forEach($scope.filterModel, function (obj, ident) {
  if ($scope.filterModel[i].VirtualSort == e.oldIndex) {
    $scope.filterModel[i].VirtualSort = 99;
  }
  i++;
});

i = 0;
angular.forEach($scope.filterModel, function (obj, ident) {
  if (e.oldIndex > e.newIndex) {
    if ($scope.filterModel[i].VirtualSort >= e.newIndex && $scope.filterModel[i].VirtualSort < e.oldIndex) {
      $scope.filterModel[i].VirtualSort++;
    }
  } else {
    if ($scope.filterModel[i].VirtualSort <= e.newIndex && $scope.filterModel[i].VirtualSort > e.oldIndex) {
      $scope.filterModel[i].VirtualSort--;
    }
  }
  i++;
});
                    
i = 0;
angular.forEach($scope.filterModel, function (obj, ident) {
  if ($scope.filterModel[i].VirtualSort == 99) {
    $scope.filterModel[i].VirtualSort = e.newIndex;
  }
  i++;
});

#end
