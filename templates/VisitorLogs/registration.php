<div class="visitorlogs registration content">
    <div class="page-header">
        <h3>
            <?= __('Registration') ?>
            <a href="#" class="action checkin fas fa-plus-circle"></a>
            <a href="#" class="action checkout fas fa-minus-circle"></a>
        </h3>
    </div>
    <div class="checkin">
        <div class="block-container">
            <div class="title">Block</div>
            <?php foreach ($blockList as $block): ?>
                    <div class="block-tag" data-block="<?= $block; ?>"><?= $block; ?></div>
                <?php endforeach; ?>
        </div>
        <div class="unit-container">
            <input type="text" placeholder="Unit Number" class="unit-search"/>
            <?php foreach ($unitList as $unit): ?>
                    <div class="unit-tag" data-id="<?= $unit['id'] ?>"  data-unit="<?= $unit['unit_number'] ?>" data-block="<?= $unit['block'] ?>"><?= $unit['unit_number'] ?></div>
                <?php endforeach; ?>
        </div>
        <div class="details">
            <?=
                $this->Form->create(null, [
                    'onsubmit' => 'return addRegistration();'
                ])
            ?>
            <input type="hidden" id="block" name="block" value=""/>
            <input type="hidden" id="unit_number" name="unit_number" value=""/>
            <input type="hidden" id="unit_id" name="unit_id" value=""/>
            <input type="hidden" id="user_id" name="user_id" value="<?php echo $Auth['id']; ?>"/>

            <div class="data-row block">
                <div class="label">Block</div>
                <div class="data"></div>
            </div>
            <div class="data-row unit_number">
                <div class="label">Unit No.</div>
                <div class="data"></div>
            </div>
            <div class="data-row">
                <div class="label">Contact</div>
                <div class="data"><input type="number" id="contact" name="contact" value=""  min="10000000" max="99999999" required /></div>
            </div>
            <div class="data-row">
                <div class="label">Name</div>
                <div class="data"><input type="text" id="full_name" name="full_name" value="" required /></div>
            </div>
            <div class="data-row">
                <div class="label">ID (last 3 digits)</div>
                <div class="data"><input type="text" id="id_code" name="id_code" value="" maxlength="3" size="3" required/></div>
            </div>
            <div class="data-row">
                <button id="register">Check In</button>
            </div>
            <?= $this->Form->end(); ?>
            </form>
        </div>

    </div>
    <div class="checkout">
        checkout
    </div>
</div>
<script>

        function checkout(id)
        {
            /* checkout */
            if (confirm("Confirm checkout?"))
            {
                jQuery.ajax({
                    url: "/tribe/api/checkout/" + id,
                    success: function (result)
                    {
                        var data = jQuery.parseJSON(result);

                        if (data.code == 200)
                        {
                            alert("Checkout succeed");
                            jQuery("a.checkout").click();
                        }
                        else
                        {
                            alert("Checkout failed");
                        }
                    }
                });
            }
        }

        /* to handle checkout list search */
        /* keyword: contact */
        function refreshCheckoutList(obj)
        {
            var searchKeyword = jQuery(obj).val().trim();
            if (searchKeyword.length > 2)
            {
                jQuery(".checkout .checkinslist").hide();
                jQuery(".checkout .checkinslist[data-search*=" + searchKeyword + "]").show();
            }
            else
            {
                jQuery(".checkout .checkinslist").show();
            }
        }

        /* onsubmit validation for registration */
        function addRegistration()
        {
            var validated = true;
            var message = "Please verify following information:\n\n";
            if (jQuery("input#unit_id").val().trim().length == 0)
            {
                /* should not happen */
            }

            if (jQuery("input#full_name").val().trim().length == 0)
            {
                message = message + "- Name\n";
                validated = false;
            }

            if (jQuery("input#contact").val().trim().length == 0)
            {
                message = message + "- Contact\n";
                validated = false;
            }

            if (jQuery("input#id_code").val().trim().length != 3)
            {
                message = message + "- Last 3 digits of ID\n";
                validated = false;
            }

            if (!validated)
            {
                alert(message);
            }
            return validated;
        }


        jQuery(document).ready(function ()
        {
            /* check in icon clicked */
            jQuery("a.checkin").on("click", function ()
            {
                jQuery("div.checkout").hide();
                jQuery("div.checkin").show();

                /* reset form */
                jQuery(".block-tag").removeClass("selected");
                jQuery(".block-container").show();
                jQuery(".unit-container").hide();
                jQuery(".details").hide();
                jQuery(".unit-tag").hide();
                jQuery(".unit-tag").removeClass("selected");
                jQuery("inpit.unit-search").val("");
            });

            /* check out icon clicked */
            jQuery("a.checkout").on("click", function ()
            {
                /* get current check ins */
                jQuery.ajax({
                    url: "/tribe/api/get-check-ins",
                    success: function (result)
                    {
                        jQuery("div.checkout").html(result);
                    }
                });


                jQuery("div.checkin").hide();
                jQuery("div.checkout").show();
            });


            /* block number selected (check in) */
            jQuery(".block-tag").on("click", function ()
            {
                var block = jQuery(this).attr("data-block");

                jQuery(".block-tag").removeClass("selected");
                jQuery(this).addClass("selected");
                jQuery(".unit-container").show();
                jQuery("input.unit-search").val("");
                jQuery(".unit-tag").hide();
                jQuery(".unit-tag").removeClass("selected");
                jQuery(".unit-tag[data-block=" + block + "]").show();
            });

            /* unit number selected (check in) */
            jQuery(".unit-tag").on("click", function ()
            {

                var block = jQuery(this).attr("data-block");
                var unit = jQuery(this).attr("data-unit");
                var unit_id = jQuery(this).attr("data-id");

                /* get unit status */
                jQuery.ajax({
                    url: "/tribe/api/unit-status/" + unit_id,
                    success: function (result)
                    {
                        var data = jQuery.parseJSON(result);

                        if (data.availability == 0)
                        {
                            alert("Maximum visitor for this unit reached");
                            jQuery("a.checkin").click();
                        }
                    }
                });

                jQuery(".unit-tag").removeClass("selected");
                jQuery(this).addClass("selected");

                jQuery("input#block").val(block);
                jQuery("input#unit_number").val(unit);
                jQuery("input#unit_id").val(unit_id);

                jQuery(".data-row.block .data").html(block);
                jQuery(".data-row.unit_number .data").html(unit);

                jQuery(".details").show();

                jQuery(".block-container").hide();
                jQuery(".unit-container").hide();

            });

            /* handle unit search (check in) */
            jQuery("input.unit-search").on("keyup", function ()
            {
                var unit_number = jQuery(this).val();
                var block = jQuery(".block-tag.selected").attr("data-block");

                if (unit_number.length > 0)
                {
                    jQuery(".unit-tag").hide();
                    jQuery(".unit-tag[data-block='" + block + "'][data-unit^='" + unit_number + "']").show();
                }
                else
                {
                    jQuery(".unit-tag[data-block='" + block + "']").show();
                }
            });
        });
</script>