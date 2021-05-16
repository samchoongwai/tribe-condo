<div class="users index content">
    <div class="page-header">
        <h3><?= __('Unit Types List') ?></h3>
        <div class="actionbar">
            <?= $this->Html->link(__(''), ['action' => 'add'], ['class' => 'action fas fa-plus-circle']) ?>
        </div>
    </div>
    <div class="table">
        <table class="listing">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('code') ?></th>
                    <th><?= $this->Paginator->sort('title') ?></th>
                    <th><?= $this->Paginator->sort('capacity') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($unitTypes as $unitType): ?>
                        <tr>
                            <td><?= $this->Html->link(__($unitType->code), ['action' => 'view', $unitType->id]) ?></td>
                            <td><?= $this->Html->link(__($unitType->title), ['action' => 'view', $unitType->id]) ?></td>
                            <td><?= h($unitType->capacity) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__(''), ['action' => 'edit', $unitType->id], ['class' => 'action edit fas fa-edit']) ?>
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
            jQuery(".listing").DataTable();
        });
</script>
