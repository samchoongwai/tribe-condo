<div class="users view content">
    <div class="page-header">
        <h3><?= h($user->full_name) ?></h3>
        <div class="actionbar">
            <?= $this->Html->link(__(''), ['action' => 'index', $user->id], ['class' => 'action index fas fa-angle-double-left']) ?>
            &nbsp;&nbsp;
            <?= $this->Html->link(__(''), ['action' => 'edit', $user->id], ['class' => 'action edit fas fa-edit']) ?>
            &nbsp;&nbsp;
            <?= $this->Form->postLink(__(''), ['action' => 'delete', $user->id], ['class' => 'action edit far fa-trash-alt', 'confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
        </div>
    </div>
    <table>
        <tr>
            <th><?= __('Full Name') ?></th>
            <td><?= h($user->full_name) ?></td>
        </tr>
        <tr>
            <th><?= __('Contact') ?></th>
            <td><?= h($user->contact) ?></td>
        </tr>
        <tr>
            <th><?= __('Email') ?></th>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <th><?= __('Role') ?></th>
            <td><?= $user->role->title ?></td>
        </tr>
    </table>
</div>
