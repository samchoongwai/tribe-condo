<?php
    /**
     * @var \App\View\AppView $this
     * @var \App\Model\Entity\VisitorLog[]|\Cake\Collection\CollectionInterface $visitorLogs
     */
?>
<div class="visitorlogs index content">
    <div class="page-header">
        <h3><?= __('Visitor Logs') ?></h3>
        <div class="actionbar">
            <button class="filter" data-filter="30">30 Days</button>
            <button class="filter" data-filter="60">60 Days</button>
            <button class="filter" data-filter="90">90 Days</button>
            <button class="filter" data-filter="120">120 Days</button>
            <button class="filter" data-filter="3650">All</button>
        </div>
    </div>


    <div class="table">
        <table class="listing">
            <thead>
                <tr>
                    <th>Unit</th>
                    <th>Visitor Name</th>
                    <th>Contact</th>
                    <th>ID</th>
                    <th>Time Enter</th>
                    <th>Time Exit</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($visitorLogs as $visitorLog): ?>
                        <tr>
                            <td>
                                <a href="units/view/<?php echo $visitorLog->unit->id ?>">
                                    <?= $visitorLog->has('unit') ? $visitorLog->unit->block . '-' . $visitorLog->unit->unit_number : '' ?>
                                </a></td>
                            <td><?= h($visitorLog->full_name) ?></td>
                            <td>
                                <a href="visitor-logs/visitor/<?php echo $visitorLog->contact ?>/<?php echo $visitorLog->id_code ?>">
                                    <?= h($visitorLog->contact) ?>
                                </a></td>
                            <td><?= h($visitorLog->id_code) ?></td>
                            <td><span class="hidden"><?php echo date('Y-m-d H:i', strtotime($visitorLog->time_enter)); ?></span><?= h($visitorLog->time_enter->format('d/m/Y H:i')) ?></td>
                            <td><span class="hidden"><?php echo date('Y-m-d H:i', strtotime($visitorLog->time_exit)); ?></span><?= h($visitorLog->time_exit ? $visitorLog->time_exit->format('d/m/Y H:i') : '') ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__(''), ['action' => 'edit', $visitorLog->id], ['class' => 'action edit fas fa-edit']) ?>
                                &nbsp;&nbsp;
                                <?= $this->Form->postLink(__(''), ['action' => 'delete', $visitorLog->id], ['class' => 'action edit far fa-trash-alt', 'confirm' => __('Are you sure you want to delete # {0}?', $visitorLog->id)]) ?>
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
            /* handle data filter: x days or record */
            jQuery("button.filter").on("click", function ()
            {
                var filter = jQuery(this).attr("data-filter");
                window.location = "?d=" + filter;
            });

            /* initiate datatable */
            jQuery(".listing").DataTable({
                "order": [[4, "desc"]],
                "pageLength": 100
            });
        });
</script>
