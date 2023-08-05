<?php
?>
<label class="toggle">
    <input name="avasho_post_metabox" class="avashoo_toggle-checkbox" type="checkbox" value="on" <?php $cheked?>>
    <div class="avashoo_toggle-switch"></div>
</label>

<div class="mydict">
    <div>
        <label>
            <input type="radio" name="avasho_radio_box" value=2 <?php checked($gen, 2);?>>
            <span>بارگزاری با صدای مرد</span>
        </label>
        <label>
            <input type="radio" name="avasho_radio_box" value=1 <?php checked($gen, 1);?>>
            <span >بارگزاری با صدای زن</span>
        </label>
    </div>
</div>
<?php
?>