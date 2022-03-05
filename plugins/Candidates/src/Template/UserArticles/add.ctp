
<div class="row">
	<div class="col-md-12">
    <?= $this->Form->create($userArticle) ?>
    <fieldset>
        <legend><?= __('Add User Article') ?></legend>
        <?php
            echo $this->Form->input('user_id', ['options' => $users, 'class'=>'form-control', 'label' => false, 'placeholder'=>'user_id']);
            echo $this->Form->input('name', ['class'=>'form-control', 'label' => false, 'placeholder'=>'name']);
            echo $this->Form->input('slug', ['class'=>'form-control', 'label' => false, 'placeholder'=>'slug']);
            echo $this->Form->input('user_article_category_id', ['options' => $userArticleCategories, 'class'=>'form-control', 'label' => false, 'placeholder'=>'user_article_category_id']);
            echo $this->Form->input('status', ['class'=>'form-control', 'label' => false, 'placeholder'=>'status']);
            echo $this->Form->input('short', ['class'=>'form-control', 'label' => false, 'placeholder'=>'short']);
            echo $this->Form->input('content', ['class'=>'form-control', 'label' => false, 'placeholder'=>'content']);
            echo $this->Form->input('source', ['class'=>'form-control', 'label' => false, 'placeholder'=>'source']);
            echo $this->Form->input('twittercount', ['class'=>'form-control', 'label' => false, 'placeholder'=>'twittercount']);
            echo $this->Form->input('hitcount', ['class'=>'form-control', 'label' => false, 'placeholder'=>'hitcount']);
              echo $this->Form->input('images._ids', ['options' => $images, 'class'=>'form-control select4', 'label' => false]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <?= $this->Form->end() ?>
</div>
</div>