<div class="units view content">
    <div class="page-header">
        <h3>
            <?= h($unit->block . ' ' . $unit->unit_number) ?>
            <?php if ($unit->status == 0): ?>
                    <!-- record deleted -->
                    (Record deleted)
                <?php endif; ?>
        </h3>
        <div class="actionbar">
            <?= $this->Html->link(__(''), ['action' => 'index'], ['class' => 'action index fas fa-angle-double-left']) ?>
            <?php if ($unit->status != 0): ?>
                    <!-- record active, actions allowed -->
                    &nbsp;&nbsp;
                    <?= $this->Html->link(__(''), ['action' => 'edit', $unit->id], ['class' => 'action edit fas fa-edit']) ?>
                    &nbsp;&nbsp;
                    <?= $this->Form->postLink(__(''), ['action' => 'delete', $unit->id], ['class' => 'action edit far fa-trash-alt', 'confirm' => __('Are you sure you want to delete # {0}?', $unit->id)]) ?>
                <?php endif; ?>
        </div>
    </div>
    <table>
        <tr>
            <th><?= __('Block') ?></th>
            <td><?= h($unit->block) ?></td>
        </tr>
        <tr>
            <th><?= __('Unit Number') ?></th>
            <td><?= h($unit->unit_number) ?></td>
        </tr>
        <tr>
            <th><?= __('Occupant') ?></th>
            <td><?= h($unit->occupant) ?></td>
        </tr>
        <tr>
            <th><?= __('Contact') ?></th>
            <td><?= h($unit->contact) ?></td>
        </tr>
        <tr>
            <th><?= __('Unit Type') ?></th>
            <td><?= $unit->unit_type->title ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Visitor Logs (30 days)') ?></h4>
        <?php if (!empty($unit->visitor_logs)) : ?>

                <table class="listing">
                    <thead>
                        <tr>
                            <th><?= __('Full Name') ?></th>
                            <th><?= __('Contact') ?></th>
                            <th><?= __('Id Code') ?></th>
                            <th><?= __('Time Enter') ?></th>
                            <th><?= __('Time Exit') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($unit->visitor_logs as $visitorLogs) : ?>
                            <tr>
                                <td><?= h($visitorLogs->full_name) ?></td>
                                <td><?= h($visitorLogs->contact) ?></td>
                                <td><?= h($visitorLogs->id_code) ?></td>
                                <td><span class="hidden"><?php echo date('Y-m-d H:i', strtotime($visitorLogs->time_enter)); ?></span><?= h($visitorLogs->time_enter->format('d/m/Y H:i')) ?></td>
                                <td><span class="hidden"><?php echo date('Y-m-d H:i', strtotime($visitorLogs->time_exit)); ?></span><?= h($visitorLogs->time_exit ? $visitorLogs->time_exit->format('d/m/Y H:i') : '') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            <?php endif; ?>
    </div>
</div>
<script>
        jQuery(document).ready(function ()
        {
            /* initiate datatable: visitor log for the unit */
            jQuery(".listing").DataTable({
                "order": [[3, "desc"]]
            });
        });
</script>
