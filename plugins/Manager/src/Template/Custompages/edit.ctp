<?php $this->Html->css('selector', ['block' => true]); ?>
<?php $this->Html->script('/js/ckeditor/ckeditor', ['block' => true]); ?>
<div class="row">
	<div class="col-md-12">

<BR>
    <?= $this->Form->create($custompage) ?>
    <fieldset>
        <legend><?= __('Add Custompage') ?></legend>
        <?php
            echo $this->Form->input('title', ['class'=>'form-control', 'label' => false, 'placeholder'=>'Page title']);
            echo $this->Form->input('slug', ['class'=>'form-control', 'label' => false, 'placeholder'=>'Slug']);
            echo $this->Form->input('body', ['class'=>'form-control  ckeditor',  'label'=>'Content']);
            echo '<BR>';
            echo $this->Form->input('shortdescrip', ['class'=>'form-control', 'label' => false, 'placeholder'=>'SEO short description']);
            echo $this->Form->input('keywords', ['class'=>'form-control', 'label' => false, 'placeholder'=>'SEO comma seperated keywords']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <?= $this->Form->end() ?>
        <?php echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $custompage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $custompage->id), 'class' => 'btn btn-danger'] );  ?>
</div>
