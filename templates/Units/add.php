<div class="users edit content">
    <div class="page-header">
        <h3>Add Unit</h3>
        <div class="actionbar">
            <?= $this->Html->link(__(''), ['action' => 'index'], ['class' => 'action index fas fa-angle-double-left']) ?>
        </div>
    </div>
    <div class="users form content">
        <?= $this->Form->create($unit) ?>
        <fieldset>
            <div class="row">
                <?php echo $this->Form->control('block'); ?>
                <?php echo $this->Form->control('unit_number'); ?>
                <?php echo $this->Form->control('unit_type_id', ['options' => $unitTypes]); ?>
            </div>
            <div class="row">
                <?php echo $this->Form->control('occupant'); ?>
                <?php echo $this->Form->control('contact'); ?>
            </div>
        </fieldset>
        <?= $this->Form->button(__('Add Unit'), ['class' => 'float-right']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>