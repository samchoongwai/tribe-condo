<?php if ($visitorLogs): ?>
        <input type="text" id="checkoutsearch" onkeyup="refreshCheckoutList(this);" placeholder="Search Contact"/>
        <?php foreach ($visitorLogs as $item): ?>
            <div class="checkinslist" data-search="<?php echo $item['contact']; ?>">
                <div class="block">
                    <div class="label icon fas fa-home"></div>
                    <div class="data"><?php echo $item['unit']['block']; ?> <?php echo $item['unit']['unit_number']; ?></div>
                </div>
                <div class="block">
                    <div class="label icon fas fa-id-card"></div>
                    <div class="data"><?php echo $item['full_name']; ?> (<?php echo $item['id_code']; ?>)</div>
                </div>
                <div class="block">
                    <div class="label icon fas fa-phone-alt"></div>
                    <div class="data"><?php echo $item['contact']; ?></div>
                </div>
                <div class="block">
                    <div class="label icon fas fa-clock"></div>
                    <div class="data"><?php echo date('d-m-Y h:i a', strtotime($item['time_enter'])); ?></div>
                </div>
                <div class="block"><a href="#" class="float-right" onclick="checkout('<?php echo $item['id']; ?>')">CHECK OUT</a></div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        No visitor log found
<?php endif; ?>
