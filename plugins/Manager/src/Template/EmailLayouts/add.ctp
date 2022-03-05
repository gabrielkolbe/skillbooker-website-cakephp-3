<div class="row">
	<div class="col-md-12">
    <?= $this->Form->create($emailLayout) ?>
    <fieldset>
        <legend><?= __('Add Email Layout') ?></legend>
        <?php
            echo $this->Form->input('name', ['class'=>'form-control', 'label' => false, 'placeholder'=>'name']);
            echo '!! Make sure  {{TITLE}} and {{CONTENT}} must be in every layout, see EXAMPLE below!!';
            echo '<BR>COPY and PASTE the HTML with CSS STYLES HERE';
            echo $this->Form->input('layout', ['class'=>'form-control', 'label' => false, 'placeholder'=>'layout', 'style' => 'height:500px']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <?= $this->Form->end() ?>
</div>
<h3>EXAMPLE </h3><BR>
&lt;!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"&gt;
&lt;html&gt;
&lt;head&gt;
    &lt;title&gt;
 <BR><BR>

&lt;!- DO NOT LEAVE THIS OUT -&gt;
{{TITLE}}
&lt;!- DO NOT LEAVE THIS OUT -&gt;

 <BR><BR>
 &lt;/title&gt;
    &lt;style&gt;
    p {
    margin:0px;
    margin-botton:10px;
    }
    &lt;/style&gt;
&lt;/head&gt;
&lt;body&gt;

&lt;table width="100%" cellpadding="12" cellspacing="0" border="0"&gt;&lt;tbody&gt;&lt;tr&gt;&lt;td&gt;&lt;div style="overflow: hidden;"&gt;&lt;font size="-1"&gt;&lt;u&gt;&lt;/u&gt;
&lt;div style="background:#fff;font-size:16px;color:#464646;line-height:1;padding:0;font-family:Helvetica,Arial"&gt;
&lt;div style="max-width:940px;margin:0 auto;padding:30px 50px"&gt;
&lt;table style="width:100%;border-collapse:collapse;line-height:2em;"&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;td style="padding:15px 0;border-bottom:11px solid #046ebb; background-color:#161637; "&gt; RideFree &lt;/td&gt;
&lt;/tr&gt;
&lt;tr&gt;
&lt;td style="background:#fff;padding:20px 30px 0 30px"&gt;
 <BR><BR>

&lt;!- DO NOT LEAVE THIS OUT -&gt;
{{CONTENT}}
&lt;!- DO NOT LEAVE THIS OUT -&gt;

 <BR><BR>
&lt;/td&gt;
&lt;/tr&gt;
&lt;tr&gt;
&lt;td style="padding:10px 0;font-size:13px"&gt;
&lt;small&gt;This email and any attachments to it may be confidential and are intended solely for the use of the individual to whom it is addressed. Any views or opinions expressed are solely those of the author and do not necessarily represent those of &lt;?php echo SITE;?&gt;.  If you are not the intended recipient of this email, please be advised that you must neither take any action based upon its contents, nor copy or show it to anyone.  Our standard terms and conditions, along with our service level agreement, will apply to any engagements made as a result of the information contained in this email and any attachments. &lt;/small&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
&lt;/div&gt;
&lt;/font&gt;&lt;/div&gt;&lt;/td&gt;&lt;/tr&gt;&lt;/tbody&gt;&lt;/table&gt;
&lt;/body&gt;
&lt;/html&gt;
&lt;/div&gt;