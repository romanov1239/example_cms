<?php

use admin\modules\rbac\models\RolePermission;

?>

<div class="role-permission-index">

    <?php foreach($roles as $role):?>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 data-toggle="collapse" href="#collapse<?= $role->id?>">
                    <?=$role->name;?>
                </h4>
                <div class="glyphicon glyphicon-remove role-remove" onclick="removeRole('controller',<?= $role->id ?>)"></div>
            </div>

            <div id="collapse<?= $role->id?>" class="panel-collapse collapse">
                <?php foreach ($controllers as $controller):?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#car_accordion" href="#collapse_controller_<?=$role->id . "_" . $controller->id?>">
                                    <?=$controller->name?>
                                </a>
                            </h4>
                        </div>

                        <div id="collapse_controller_<?=$role->id . "_" . $controller->id?>" class="panel-collapse collapse">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <td>
                                        id
                                    </td>
                                    <td>
                                        Имя экшена
                                    </td>
                                    <td>
                                        Разрешён
                                    </td>
                                </tr>
                                </thead>
                                <tbody>

                                <?php foreach ($actions as $action):?>
                                    <?php if($action->controller_id != $controller->id) continue; ?>
                                    <tr>
                                        <td>
                                            <?= $action->id?>
                                        </td>
                                        <td>
                                            <?= $action->name?>
                                        </td>
                                        <td>
                                            <?php
                                            if (RolePermission::find()->where(['role_id' => $role->id, 'action_id' => $action->id])->one()){
                                                $checked = 'checked';
                                            } else $checked = '';
                                            ?>
                                            <div class="checkbox">
                                                <label><input id="checkbox_<?=$role->id . "_" . $action->id?>" type="checkbox" onclick="refreshPermission(<?=$role->id?>,<?=$action->id?>)" value="" <?= $checked?>></label>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>


    <?php endforeach; ?>
</div>