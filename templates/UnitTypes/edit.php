<div class="units edit content">
    <div class="page-header">
        <h3>Edit Unit Type</h3>
        <div class="actionbar">
            <?= $this->Html->link(__(''), ['action' => 'index'], ['class' => 'action index fas fa-angle-double-left']) ?>
        </div>
    </div>
    <div class="users form content">
        <?= $this->Form->create($unitType) ?>
        <fieldset>
            <div class="row">
                <?php echo $this->Form->control('code'); ?>
                <?php echo $this->Form->control('title'); ?>
                <?php echo $this->Form->control('capacity'); ?>
            </div>
        </fieldset>
        <?= $this->Form->button(__('Update Unit Type'), ['class' => 'float-right']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>



