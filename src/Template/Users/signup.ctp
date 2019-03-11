<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <!--<?= $this->Form->create($user) ?>-->
    <!--<fieldset>
        <legend><?= __('Add User') ?></legend>
        <?php
            echo $this->Form->control('email');
            echo $this->Form->control('password');
            echo $this->Form->control('phone');
        ?>
    </fieldset>-->

    <?= $this->Form->create($user,['type'=>'post']) ?>
    <fieldset>
        <legend>Registro</legend>

        <div class="form-group">
            <label for="phone">Teléfono</label>
            <input type="text" name="phone" class="form-control" id="phone"
                   placeholder="Introduce tu teléfono">
        </div>
        <div class="form-group">
            <label for="email">Correo</label>
            <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp"
                   placeholder="Introduce tu correo">
        </div>
        <label for="email">Contraseña</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <input type="checkbox" aria-label="Ver contraseña" id="PasswordView">
                </div>
            </div>
            <input type="password" name="password" id="password" style="font-size: 25px;" class="form-control"
                   aria-label="Text input with radio button">
        </div>
        <small id="passwordHelp" class="form-text text-muted">Nunca compartas tu contraseña.
        </small>
    </fieldset>
    <hr>
    <!--<button type="submit" class="btn btn-primary btn-lg btn-block">Submit</button>-->
    <?= $this->Form->button(__('Registrate'),['class'=>'btn btn-primary ']) ?>

    </fieldset>

    <?= $this->Form->end() ?>
</div>
<script>

    $("#PasswordView").on("change", function () {
        if ($("#PasswordView").is(':checked')) {
            $("#password").attr("type", 'text')
        } else {
            $("#password").attr("type", 'password')
        }
    })

</script>
