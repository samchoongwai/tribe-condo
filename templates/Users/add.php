<div class="users add content">
    <div class="page-header">
        <h3>Add User</h3>
        <div class="actionbar">
            <?= $this->Html->link(__(''), ['action' => 'index'], ['class' => 'action index fas fa-angle-double-left']) ?>
        </div>
    </div>
    <div class="users form content">
        <?= $this->Form->create($user) ?>
        <fieldset>
            <div class="row">
                <?php echo $this->Form->control('full_name'); ?>
                <?php echo $this->Form->control('contact'); ?>
                <?php echo $this->Form->control('email'); ?>
                <?php echo $this->Form->control('role_id', ['options' => $roles]); ?>
            </div>
            <div class="row">
                <?php echo $this->Form->control('username'); ?>
                <?php echo $this->Form->control('password'); ?>
            </div>
        </fieldset>
        <?= $this->Form->button(__('Add User'), ['class' => 'float-right']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
