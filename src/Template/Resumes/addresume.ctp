<script>
$(document).ready(function() {
   
    $('#industry_id').change(function(){     
    $.ajax({
         type : "POST",
                url  : ('/resumes/getindustry/') + $("#industry_id option:selected").val(),
                success : function(opt){                
                        if(opt == 0){ $("#industrieslist").fadeIn("slow"); }
                    }
            })
            });
                          
}); 
</script> 

<style>
.hideme {
    display: none;
}
</style>
	
<?php echo $this->Form->create(null,  ['url' => ['plugin' => null, 'controller' => 'resumes', 'action' => 'addresumeaction'], 'type' => 'file', 'id' => 'addresume']); ?>
<?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right hideme', 'id' => 'btn']) ?>   
<h1>Upload your Resume / CV</h1>
<h4>We will try and find your skills insert them into your profile</h4>
<BR>
We will match the <strong>Career Category</strong> Skills with your Resume / CV
<?php echo $this->Form->input('industry_id', ['id' => 'industry_id', 'options' => $industries, 'class'=>'form-control', 'label' => false, 'empty' => 'Select Industry', 'default' => DEFAULT_INDUSTRYID]);  ?>
<span id="industrieslist" class="hideme">
<?php
echo '<BR>We could not find <strong>skill</strong> matches in this <strong>Career Option</strong> please provide us with a comma separated list';
echo $this->Form->input('industrylist', ['class'=>'form-control', 'label' => false, 'placeholder'=>'Comma separated']);
?>
</span>
<BR>
<?php echo $this->Form->checkbox('defaultresume', ['hiddenField' => false]); ?> Set as Main Resume /  CV ? 	
<BR>
<?php echo $this->Form->input('resume', ['class'=>'form-control', 'label' => false, 'type' => 'file', 'onChange'=>'validate(this.value)']); ?>
<BR>
         <small>File Restrictions: File size: 2MB or less, File types: 'doc', 'docx', 'odt', 'txt', 'pdf'</small>
         <p>If your CV/Resume is not in the correct format copy and paste into a text.txt file 
copy (Ctrl + C) and paste (Ctrl + V)</p>
<?= $this->Form->end() ?>

</div>

<script type="text/javascript">

    function validate(filename) {
        var extension = filename.replace(/^.*\./, '');
                
        if (extension == filename) {
            extension = '';
        } else {
            extension = extension.toLowerCase();
        }

        switch (extension) {
            case 'doc':
                  $("#btn").fadeIn("slow");
                  break;
            case 'docx':
                  $("#btn").fadeIn("slow");
                  break;
            case 'txt':
                  $("#btn").fadeIn("slow");
                  break;
            case 'pdf':
                  $("#btn").fadeIn("slow");
                  break;
            case 'odt':
                  $("#btn").fadeIn("slow");
                  break;
            
            
          default:
            $("#btn").hide();
        }
        

  }

</script>			