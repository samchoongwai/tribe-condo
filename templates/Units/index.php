<div class="units index content">
    <div class="page-header">
        <h3><?= __('Units List') ?></h3>
        <div class="actionbar">
            <?= $this->Html->link(__(''), ['action' => 'add'], ['class' => 'action fas fa-plus-circle']) ?>
        </div>
    </div>
    <div class="table">
        <table class="listing">
            <thead>
                <tr>
                    <th>Block</th>
                    <th>Unit</th>
                    <th>Occupant</th>
                    <th>Contact</th>
                    <th>Unit Type</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($units as $unit): ?>
                        <tr>
                            <td><?= $this->Html->link(__($unit->block), ['action' => 'view', $unit->id]) ?></td>
                            <td><?= $this->Html->link(__($unit->unit_number), ['action' => 'view', $unit->id]) ?></td>
                            <td><?= h($unit->occupant) ?></td>
                            <td><?= h($unit->contact) ?></td>
                            <td><?= $unit->unit_type->title ?></td>
                            <td class="actions">
                                <?php if ($unit->status != 0): ?>
                                    <?= $this->Html->link(__(''), ['action' => 'edit', $unit->id], ['class' => 'action edit fas fa-edit']) ?>
                                    <?= $this->Form->postLink(__(''), ['action' => 'delete', $unit->id], ['class' => 'action edit far fa-trash-alt', 'confirm' => __('Are you sure you want to delete # {0}?', $unit->id)]) ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
        jQuery(document).ready(function ()
        {
            /* initiate datatable */
            jQuery(".listing").DataTable({
                "order": [[0, "asc"]],
                "pageLength": 100,
                columnDefs: [{
                        targets: [0],
                        orderData: [0, 1]
                    }, {
                        targets: [1],
                        orderData: [1, 0]
                    }]
            });
        });
</script>
