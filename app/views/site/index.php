<div class="container" ng-app="app" ng-controller="htodoCtrl">
    <div class="row">
        <div class="col-md-2">
            <h1 class="text-muted">Tasks</h1>
        </div>
        <div class="col-md-10">
            <h4 class="pull-right">
                <span class="label label-danger">Log count: {{orderLog.length}}</span>
                <span class="label label-danger">Log index: {{logIndex+1}}</span>
                <span class="label label-danger">Log date: {{orderLog[logIndex].created_at}}</span>
                <span class="label label-default">Total: {{list.length}}</span>
            </h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-10">
            <form name="form">
                <div class="input-group">
                    <input type="text" class="form-control" name="title" ng-model="title">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit" ng-click="addTask(title)" ng-disabled="logIndex || !title"><i class="glyphicon glyphicon-plus"></i></button>
                    </span>
                </div>
            </form>
        </div>
        <div class="col-md-2">
            <div class="btn-group pull-right">
                <button class="btn btn-default" type="button" ng-click="logPrev()" ng-disabled="(logIndex+1) == orderLog.length"><i class="glyphicon glyphicon-chevron-left"></i></button>
                <button class="btn btn-default" type="button" ng-click="logNext()" ng-disabled="!logIndex"><i class="glyphicon glyphicon-chevron-right"></i></button>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <ul class="list-unstyled" ui-sortable="sortableOptions" ng-model="list">
                <li class="well" ng-repeat="item in list">
                    <span class="label label-default" title="index">{{$index+1}}</span>
                    <span class="label label-info" title="primaryKey">{{item.id}}</span>
                    <strong class="text-warning">{{item.title}}</strong>
                </li>
            </ul>
        </div>
    </div>
</div>


<?php
$script = <<<'SCRIPT'
angular.module('app', ['ui.sortable']);

angular.module('app').controller('htodoCtrl', function($scope, $http, $log, $timeout) {
    $scope.list = [];
    $scope.orderLog = [];
    $scope.logIndex = 0;


    $scope.loadOrderLog = function() {
        $http.get('app.php?r=task/orderLog').success(function(data) {
            $scope.orderLog = data;
        });
    };

    $scope.loadTasks = function() {
        $scope.loadOrderLog();
        $http.get('app.php?r=task/all').success(function(data) {
            $scope.list = data;
        });
    };

    $scope.loadTasks();

    $scope.loadLogTasks = function() {
        var logId = $scope.orderLog[$scope.logIndex].id;
        $http.get('app.php?r=task/allLog&logId='+logId).success(function(data) {
            $scope.list = data;
        });
    };

    

    $scope.sortableOptions = {
        update: function(e, ui) {
            if ($scope.logIndex) {
                ui.item.parent().sortable('cancel');
            }
        },
        disabled: false,
        stop: function(e, ui) {
            if ($scope.logIndex) {
                return;
            }
            var order = [];
            $scope.list.forEach(function(i) {
                order.push(i.id);
            });
            $http.post('app.php?r=task/saveOrder', {order:order}).success(function(data) {
                $scope.loadTasks();
            });
        }
    };

    $scope.addTask = function(title) {
        if ($scope.logIndex || !title) {
            return false;
        }
        $http.post('app.php?r=task/create', {title:title}).success(function(data) {
            $scope.loadTasks();
            $scope.title = '';
            $timeout(function() {
                angular.element('input[name="title"]').focus();
            });
        }).error(function(err) {
            alert(err)
        });
    };

    $scope.logPrev = function() {
        if ($scope.logIndex+1 < $scope.orderLog.length) {
            $scope.logIndex = $scope.logIndex+1;
            $scope.loadLogTasks();
            $scope.sortableOptions.disabled = true;
        }
    };

    $scope.logNext = function() {
        if ($scope.logIndex>0) {
            $scope.logIndex = $scope.logIndex-1;
            $scope.loadLogTasks();
            if (!$scope.logIndex) {
                $scope.sortableOptions.disabled = false;
            }
        }
    };
});
SCRIPT;

Yii::app()->clientScript->registerScript('app', $script, CClientScript::POS_END);
?>