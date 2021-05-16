<?php
    /**
     * @var \App\View\AppView $this
     * @var \App\Model\Entity\VisitorLog[]|\Cake\Collection\CollectionInterface $visitorLogs
     */
?>
<div class="visitorlogs index content">
    <div class="page-header">
        <h3><?= __('Visitor List') ?></h3>
    </div>


    <div class="table">
        <table class="listing">
            <thead>
                <tr>
                    <th>Contact</th>
                    <th>ID</th>
                    <th>Total Visit</th>
                    <th>Latest Visit</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($visitorList as $visitor): ?>
                        <tr>
                            <td>
                                <a href="visitor/<?php echo $visitor->contact ?>/<?php echo $visitor->id_code ?>">
                                    <?= h($visitor->contact) ?>
                                </a>
                            </td>
                            <td><?= h($visitor->id_code) ?></td>
                            <td><?= h($visitor->count) ?></td>
                            <td><span class="hidden"><?php echo date('Y-m-d H:i', strtotime($visitor->latest_visit)); ?></span><?= h($visitor->latest_visit->format('d/m/Y H:i')) ?></td>
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
                "order": [[3, "desc"]],
                "pageLength": 100
            });
        });
</script>
