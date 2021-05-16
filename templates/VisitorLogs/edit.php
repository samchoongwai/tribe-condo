<?php
    /**
     * @var \App\View\AppView $this
     * @var \App\Model\Entity\VisitorLog $visitorLog
     */
?>
<div class="visitorLogs edit content">
    <div class="page-header">
        <h3>Edit Visitor Log: <?= $visitorLog->has('unit') ? $visitorLog->unit->block . '-' . $visitorLog->unit->unit_number : '' ?> @ <?= h($visitorLog->time_enter) ?></h3>
        <div class="actionbar">
            <?= $this->Html->link(__(''), ['action' => 'index', $visitorLog->id], ['class' => 'action index fas fa-angle-double-left']) ?>
            &nbsp;&nbsp;
            <?= $this->Form->postLink(__(''), ['action' => 'delete', $visitorLog->id], ['class' => 'action edit far fa-trash-alt', 'confirm' => __('Are you sure you want to delete # {0}?', $visitorLog->id)]) ?>
        </div>
    </div>
    <div class="visitorLogs form content">
        <?= $this->Form->create($visitorLog) ?>
        <fieldset>
            <div class="row">
                <?php echo $this->Form->control('unit_title', ['value' => $visitorLog->has('unit') ? $visitorLog->unit->block . '-' . $visitorLog->unit->unit_number : '', 'readonly']); ?>
                <?php echo $this->Form->control('full_name', ['readonly']); ?>
                <?php echo $this->Form->control('contact', ['readonly']); ?>
                <?php echo $this->Form->control('id_code', ['readonly']); ?>
            </div>
            <div class="row">
                <?php echo $this->Form->control('time_enter', ['readonly']); ?>
                <?php echo $this->Form->control('time_exit', ['readonly']); ?>
                <?php echo $this->Form->control('new_date', ['required']); ?>
                <?php echo $this->Form->control('new_time', ['required', 'placeholder' => 'In hh:mm format, eg: 18:45 = 6:45pm']); ?>
            </div>
        </fieldset>
        <?= $this->Form->button(__('Update'), ['class' => 'float-right']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
<script>
        jQuery(document).ready(function ()
        {
            /* initiate date picker for new time exit */
            jQuery("input#new-date").datepicker({
                minDate: <?php echo isset($minDateAllowed) ? $minDateAllowed : 0; ?>,
                maxDate: 0
            });
        });
</script>