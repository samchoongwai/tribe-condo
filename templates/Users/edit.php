<div class="users edit content">
    <div class="page-header">
        <h3>Edit User: <?= h($user->full_name) ?></h3>
        <div class="actionbar">
            <?= $this->Html->link(__(''), ['action' => 'index', $user->id], ['class' => 'action index fas fa-angle-double-left']) ?>
            &nbsp;&nbsp;
            <?= $this->Form->postLink(__(''), ['action' => 'delete', $user->id], ['class' => 'action edit far fa-trash-alt', 'confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
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
        </fieldset>
        <?= $this->Form->button(__('Update'), ['class' => 'float-right']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>

