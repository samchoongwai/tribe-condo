<div class="units view content">
    <div class="page-header">
        <h3>
            <?= h($unitType->title . ' ' . $unitType->code) ?>
        </h3>
        <div class="actionbar">
            <?= $this->Html->link(__(''), ['action' => 'index'], ['class' => 'action index fas fa-angle-double-left']) ?>
            <?= $this->Html->link(__(''), ['action' => 'edit', $unitType->id], ['class' => 'action edit fas fa-edit']) ?>
        </div>
    </div>
    <table>
        <tr>
            <th><?= __('Code') ?></th>
            <td><?= h($unitType->code) ?></td>
        </tr>
        <tr>
            <th><?= __('Title') ?></th>
            <td><?= h($unitType->title) ?></td>
        </tr>
        <tr>
            <th><?= __('Capacity') ?></th>
            <td><?= h($unitType->capacity) ?></td>
        </tr>
    </table>
    <div class="related">
        <?php if (!empty($unitType->units)) : ?>
                <h4><?= __('Units') ?></h4>
                <table class="listing">
                    <thead>
                        <tr>
                            <th><?= __('Block') ?></th>
                            <th><?= __('Unit Number') ?></th>
                            <th><?= __('Occupant') ?></th>
                            <th><?= __('Contact') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($unitType->units as $unit) : ?>
                            <tr>
                                <td><?= h($unit->block) ?></td>
                                <td><?= h($unit->unit_number) ?></td>
                                <td><?= h($unit->occupant) ?></td>
                                <td><?= h($unit->contact) ?></td>
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

            });
        });
</script>
