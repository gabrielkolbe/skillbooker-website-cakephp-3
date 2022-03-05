 <?php
if (!empty($list)) {
    echo '<option value="">' . __('Select Option >>') . '</option>';
    foreach ($list as $k => $v) {
        echo '<option value="' . $k . '">' . h($v) . '</option>';
    }
} else {
    echo '<option value="0">' . __('No Option') . '</option>';
}
?>