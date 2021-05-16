<div class="users index content">
    <div class="page-header">
        <h3><?= __('Users List') ?></h3>
        <div class="actionbar">
            <?= $this->Html->link(__(''), ['action' => 'add'], ['class' => 'action fas fa-plus-circle']) ?>
        </div>
    </div>
    <div class="table">
        <table class="listing">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('full_name') ?></th>
                    <th><?= $this->Paginator->sort('contact') ?></th>
                    <th><?= $this->Paginator->sort('email') ?></th>
                    <th><?= $this->Paginator->sort('role_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= $this->Html->link(__($user->full_name), ['action' => 'view', $user->id]) ?></td>
                            <td><?= h($user->contact) ?></td>
                            <td><?= h($user->email) ?></td>
                            <td><?= $user->role->title ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__(''), ['action' => 'edit', $user->id], ['class' => 'action edit fas fa-edit']) ?>
                                &nbsp;&nbsp;
                                <?= $this->Form->postLink(__(''), ['action' => 'delete', $user->id], ['class' => 'action edit far fa-trash-alt', 'confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
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
