
<div class="row">
	<div class="col-md-12">
    <?= $this->Form->create($userArticleCategory) ?>
    <fieldset>
        <legend><?= __('Edit User Article Category') ?></legend>
        <?php
            echo $this->Form->input('user_id', ['options' => $users, 'class'=>'form-control', 'label' => false, 'placeholder'=>'user_id']);
            echo $this->Form->input('category', ['class'=>'form-control', 'label' => false, 'placeholder'=>'category']);
            echo $this->Form->input('tutorial_count', ['class'=>'form-control', 'label' => false, 'placeholder'=>'tutorial_count']);
            echo $this->Form->input('slug', ['class'=>'form-control', 'label' => false, 'placeholder'=>'slug']);
            echo $this->Form->input('color', ['class'=>'form-control', 'label' => false, 'placeholder'=>'color']);
            echo $this->Form->input('catorder', ['class'=>'form-control', 'label' => false, 'placeholder'=>'catorder']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <?= $this->Form->end() ?>
</div>
</div>