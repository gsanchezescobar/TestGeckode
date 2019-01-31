<!DOCTYPE html>
<html ng-app="test">
<head>
    <title>TestGeckode</title>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/angular_material/1.1.12/angular-material.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.6/angular.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angular_material/1.1.12/angular-material.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.6/angular-animate.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.6/angular-aria.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.6/angular-messages.min.js"></script>
    <script src="../js/test.js"></script>
</head>
<body ng-controller="task">

    <div ng-if="ntask == false" style="color:white;">
        <md-list ng-cloak layout="row" layout-align="center center" layout-xs="column" >
            <div flex-xs flex-gt-xs="50" layout="column">
                <div  style="background: DarkSlateGray;">
                    <h1 layout="row" layout-align="center center">Listado Tareas</h1>
                </div>
                <md-subheader class="md-no-sticky" style="background: grey">Tareas <md-button class="md-fab md-mini md-primary" ng-click="showform(0,0)">+</md-button></md-subheader>
                <div ng-repeat="task in task">
                <md-list-item style="background: grey">
                    <md-checkbox class="md-primary" ng-if="task.done==1" ng-checked="true" ng-click="updateCheckTask(task.id)"></md-checkbox>
                    <md-checkbox class="md-primary" ng-if="task.done==0" ng-click="updateCheckTask(task.id)"></md-checkbox>
                    <P>@{{ task.name}} / @{{ task.description}}</P>
                    <em>( @{{ task.created_at }})</em>
                    <md-button class="md-raised md-primary" ng-click="showform(0,task)">Editar</md-button>
                    <md-button class="md-raised md-warn" ng-click="deleteTask(task.id)">Eliminar</md-button>
                </md-list-item>
                <md-divider ></md-divider>
                <md-list ng-cloak layout="row" layout-align="center center" layout-xs="column" style="background: grey">
                        <div flex-xs flex-gt-xs="80" layout="column">
                            <md-subheader class="md-no-sticky" style="background: DimGray">Subtareas <md-button class="md-fab md-mini md-primary" ng-click="showform(task.id,0)">+</md-button> </md-subheader>
                            <div ng-repeat="(key,sub) in task.subtask">
                                <md-list-item style="background: DimGray">
                                    <md-checkbox class="md-primary" ng-if="sub.done==1" ng-checked="true" ng-click="updateCheckSubtask(sub.id)"></md-checkbox>
                                    <md-checkbox class="md-primary" ng-if="sub.done==0" ng-click="updateCheckSubtask(sub.id)"></md-checkbox>
                                    <P>@{{ sub.name}} / @{{ sub.description}}</P>
                                    <em>( @{{ sub.created_at }})</em>
                                    <md-button class="md-raised md-primary" ng-click="showform(task,sub)">Editar</md-button>
                                    <md-button class="md-raised md-warn" ng-click="deleteSubtask(sub.id)">Eliminar</md-button>
                                </md-list-item>
                                <md-divider ></md-divider>
                            </div>
                        </div>
                </md-list>
                </div>
            </div>
        </md-list>
    </div>
    <br><br><br><br><br><br><br><br>
    <div ng-if="ntask == true">
        <div ng-cloak layout="row" layout-align="center center" layout-xs="column" layout-padding>
        
            <md-content class="md-no-momentum">
                <h1>@{{title}}</h1>

                <md-input-container class="md-float md-block">
                    <label>Name</label>
                    <input type="text" ng-model="data.name" name="name" >
                </md-input-container>
                        
                <md-input-container class="md-float md-block">
                    <label>Description</label>
                    <input type="text" ng-model="data.description" name="description" >
                </md-input-container>

                <md-input-container class="md-float md-block">
                    <md-button class="md-raised md-warn" ng-click="showform(0,0)">Regresar</md-button>

                    <md-button class="md-raised md-primary" ng-if="id == 0 && task_id == 0" ng-click="saveTask()">Guardar</md-button>
                    <md-button class="md-raised md-primary" ng-if="id != 0 && task_id == 0" ng-click="updateTask()">Actualizar</md-button>

                    <md-button class="md-raised md-primary" ng-if="id == 0 && task_id != 0" ng-click="saveSubtask()">Guardar</md-button>
                    <md-button class="md-raised md-primary" ng-if="id != 0 && task_id != 0" ng-click="updateSubtask()">Actualizar</md-button>
                </md-input-container>
        
            </md-content>
        </div>
    </div>
            
              
</body>
</html>