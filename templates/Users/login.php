<div class="users form">
    <?= $this->Flash->render() ?>
    <div class="logo"></div>
    <?= $this->Form->create() ?>
    <fieldset>
        <?= $this->Form->control('username', ['required' => true]) ?>
        <?= $this->Form->control('password', ['required' => true]) ?>
    </fieldset>
    <?= $this->Form->submit(__('Login')); ?>
    <?= $this->Form->end() ?>
</div>