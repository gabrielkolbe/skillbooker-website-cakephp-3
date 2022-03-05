<?php
if(!empty($features)) {  
    foreach($features as $feature) {
      echo '<input name="software_feature_ids[]" value="'.$feature->id.'" type="checkbox"> '.$feature->name.'<BR>';
    }
}
?>