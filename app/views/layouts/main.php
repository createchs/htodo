<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>htodo project</title>
</head>
<body>

<?php echo $content; ?>

</body>
</html>

<?php
Yii::app()->clientScript->scriptMap['jquery.js'] = '/vendor/jquery/jquery.js';

Yii::app()->clientScript
    ->registerCssFile('/vendor/bootstrap/dist/css/bootstrap.css')
    ->registerScriptFile('jquery.js')
    ->registerScriptFile('/vendor/jquery-ui/ui/jquery-ui.js')
    ->registerScriptFile('/vendor/bootstrap/dist/js/bootstrap.js')
    ->registerScriptFile('/vendor/angular/angular.js')
    ->registerScriptFile('/vendor/angular-ui-sortable/src/sortable.js');
?>