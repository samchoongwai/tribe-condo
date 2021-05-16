<?php if ($visitorLogs->count() > 0): ?>
        <?php
        $firstRecord = $visitorLogs->first();
        $visitorTitle = $firstRecord->contact . ' (' . $firstRecord->id_code . ')';
        ?>
        <div class="visitorlogs visitor content">
            <div class="page-header">
                <h3><?= __('Visitor Logs') ?>: <?php echo $visitorTitle; ?></h3>
                <div class="actionbar">
                    <?= $this->Html->link(__(''), ['action' => 'index'], ['class' => 'action index fas fa-angle-double-left']) ?>
                </div>
            </div>
            <div class="table">
                <table class="listing">
                    <thead>
                        <tr>
                            <th>Unit</th>
                            <th>Time Enter</th>
                            <th>Time Exit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($visitorLogs as $visitorLog): ?>
                            <tr>
                                <td><?= $visitorLog->has('unit') ? $visitorLog->unit->block . '-' . $visitorLog->unit->unit_number : '' ?></td>
                                <td><span class="hidden"><?php echo date('Y-m-d H:i', strtotime($visitorLog->time_enter)); ?></span><?= h($visitorLog->time_enter->format('d/m/Y H:i')) ?></td>
                                <td><span class="hidden"><?php echo date('Y-m-d H:i', strtotime($visitorLog->time_exit)); ?></span><?= h($visitorLog->time_exit ? $visitorLog->time_exit->format('d/m/Y H:i') : '') ?></td>
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
                        "order": [[1, "desc"]],
                        "pageLength": 100
                    });
                });
        </script>
    <?php endif; ?>