
<div class="row">
	<div class="col-md-12">
    <?= $this->Form->create($question) ?>
    <fieldset>
        <legend><?= __('Add Question') ?></legend>
        <?php
            echo $this->Form->input('user_id', ['options' => $users, 'class'=>'form-control', 'label' => false, 'placeholder'=>'user_id']);
            echo $this->Form->input('parent_id', ['options' => $parentQuestions, 'class'=>'form-control', 'label' => false, 'placeholder'=>'parent_id']);
            echo $this->Form->input('name', ['class'=>'form-control', 'label' => false, 'placeholder'=>'name']);
            echo $this->Form->input('slug', ['class'=>'form-control', 'label' => false, 'placeholder'=>'slug']);
            echo $this->Form->input('username', ['class'=>'form-control', 'label' => false, 'placeholder'=>'username']);
            echo $this->Form->input('userslug', ['class'=>'form-control', 'label' => false, 'placeholder'=>'userslug']);
            echo $this->Form->input('userreputation', ['class'=>'form-control', 'label' => false, 'placeholder'=>'userreputation']);
            echo $this->Form->input('industry_id', ['options' => $industries, 'class'=>'form-control', 'label' => false, 'placeholder'=>'industry_id']);
            echo $this->Form->input('status', ['class'=>'form-control', 'label' => false, 'placeholder'=>'status']);
            echo $this->Form->input('content', ['class'=>'form-control', 'label' => false, 'placeholder'=>'content']);
            echo $this->Form->input('twittercount', ['class'=>'form-control', 'label' => false, 'placeholder'=>'twittercount']);
            echo $this->Form->input('hitcount', ['class'=>'form-control', 'label' => false, 'placeholder'=>'hitcount']);
            echo $this->Form->input('skills', ['class'=>'form-control', 'label' => false, 'placeholder'=>'skills']);
            echo $this->Form->input('votes', ['class'=>'form-control', 'label' => false, 'placeholder'=>'votes']);
            echo $this->Form->input('answers', ['class'=>'form-control', 'label' => false, 'placeholder'=>'answers']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <?= $this->Form->end() ?>
</div>
</div>