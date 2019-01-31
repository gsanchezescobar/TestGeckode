var app = angular.module('test', ['ngMaterial']);
          
    app.controller('task', function($scope, $http,$mdToast) {

        $scope.ntask = false;
        $scope.id = 0;
        $scope.task_id = 0;
        $scope.data = { name: '', description: '' };
        $scope.task = [];

        getTasks();

        function getTasks(){
            $http.get(window.location.protocol+'//'+window.location.host+"/Task").then(function (response) { 
                console.log(response);
                $scope.task = response.data;
            });
        }

        //Task

        $scope.saveTask = function() {
            if($scope.data.name === ''){
                $mdToast.show(
                    $mdToast.simple()
                      .textContent('El Campo Name Es Obligatorio')
                      .position('top')
                      .hideDelay(3000)
                );
            }else{  
                $http.post(window.location.protocol+'//'+window.location.host+"/Task",{name: $scope.data.name, description: $scope.data.description,done: 0}).then(function (response) { 
                console.log(response);
                if(response.data == 'ok'){
                    getTasks();
                    $scope.ntask = false;
                }else{
                    $mdToast.show(
                        $mdToast.simple()
                          .textContent('Hubo Un Error En La Creacion')
                          .position('top')
                          .hideDelay(3000)
                      );
                }
                
                });
            }
            
        };

        $scope.updateTask = function() {
            if($scope.data.name === ''){
                $mdToast.show(
                    $mdToast.simple()
                      .textContent('El Campo Name Es Obligatorio')
                      .position('top')
                      .hideDelay(3000)
                );
            }else{  
            
                $http.put(window.location.protocol+'//'+window.location.host+"/Task/"+$scope.id,{name: $scope.data.name, description: $scope.data.description,done: 0}).then(function (response) { 
                    if(response.data == 'ok'){
                        getTasks();
                        $scope.ntask = false;
                    }else{
                        $mdToast.show(
                            $mdToast.simple()
                              .textContent('Hubo Un Error En La Actualizacion')
                              .position('top')
                              .hideDelay(3000)
                          );
                    }
                });
            }

        };

        $scope.updateCheckTask = function($id) {
            
            $http.put(window.location.protocol+'//'+window.location.host+"/Task/"+$id,{done: 1}).then(function (response) { 
                getTasks();
            });

        };

        $scope.deleteTask = function($id) {
            
            $http.delete(window.location.protocol+'//'+window.location.host+"/Task/"+$id).then(function (response) { 
                $mdToast.show(
                    $mdToast.simple()
                      .textContent('Se Elimino La Tarea')
                      .position('top')
                      .hideDelay(3000)
                );
                getTasks();
            });

        };

        //Subtask

        $scope.saveSubtask = function() {
            if($scope.data.name === ''){
                $mdToast.show(
                    $mdToast.simple()
                      .textContent('El Campo Name Es Obligatorio')
                      .position('top')
                      .hideDelay(3000)
                );
            }else{ 
                $http.post(window.location.protocol+'//'+window.location.host+"/SubTask",{task: $scope.task_id ,name: $scope.data.name, description: $scope.data.description,done: 0}).then(function (response) { 
                    if(response.data == 'ok'){
                        getTasks();
                        $scope.ntask = false;
                    }else{
                        $mdToast.show(
                            $mdToast.simple()
                              .textContent('Hubo Un Error En La Creacion')
                              .position('top')
                              .hideDelay(3000)
                          );
                    }
                });
            }
        };

        $scope.updateSubtask = function() {
            if($scope.data.name === ''){
                $mdToast.show(
                    $mdToast.simple()
                      .textContent('El Campo Name Es Obligatorio')
                      .position('top')
                      .hideDelay(3000)
                );
            }else{
                $http.put(window.location.protocol+'//'+window.location.host+"/SubTask/"+$scope.id,{name: $scope.data.name, description: $scope.data.description,done: 0}).then(function (response) { 
                    if(response.data == 'ok'){
                        getTasks();
                        $scope.ntask = false;
                    }else{
                        $mdToast.show(
                            $mdToast.simple()
                              .textContent('Hubo Un Error En La Creacion')
                              .position('top')
                              .hideDelay(3000)
                          );
                    }
                });
            }
        };

        $scope.updateCheckSubtask = function($id) {
            $http.put(window.location.protocol+'//'+window.location.host+"/SubTask/"+$id).then(function (response) { 
                getTasks();
            });

        };

        $scope.deleteSubtask = function($id) {
            
            $http.delete(window.location.protocol+'//'+window.location.host+"/SubTask/"+$id).then(function (response) { 
                $mdToast.show(
                    $mdToast.simple()
                      .textContent('Se Elimino La Subtarea')
                      .position('top')
                      .hideDelay(3000)
                );
                getTasks();
            });

        };

        $scope.showform = function($t,$op) {

            if($t == 0){
                if($op == 0){
                    $scope.title = "Nueva Tarea";
                    $scope.task_id = 0;
                    $scope.id = 0;
                    $scope.data.name = '', 
                    $scope.data.description = '';
                }else{
                    $scope.title = "Actualizar Tarea";
                    $scope.task_id = 0;
                    $scope.id = $op.id;
                    $scope.data.name = $op.name, 
                    $scope.data.description = $op.description;
                }
            }else{
                if($op == 0){
                    $scope.title = "Nueva Subtarea";
                    $scope.task_id = $t;
                    $scope.id = 0;
                    $scope.data.name = '', 
                    $scope.data.description = '';
                }else{
                    $scope.title = "Actualizar SubTarea";
                    $scope.task_id = $op.task;
                    $scope.id = $op.id;
                    $scope.data.name = $op.name, 
                    $scope.data.description = $op.description;
                }
            }
            

            $scope.ntask = !$scope.ntask;

        };
        
    
});       