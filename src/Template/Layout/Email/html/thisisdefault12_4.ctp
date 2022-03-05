<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
<head>
    <title>
<?php 
/* DO NOT LEAVE THIS OUT */
 echo $this->fetch('title'); 
 /* DO NOT LEAVE THIS OUT */
 ?>
 </title>
    <style>
    p {
    margin:0px;
    margin-botton:10px;
    }
    </style>
</head>
<body>

<table width="100%" cellpadding="12" cellspacing="0" border="0"><tbody><tr><td><div style="overflow: hidden;"><font size="-1"><u></u>
<div style="background:#fff;font-size:16px;color:#464646;line-height:1;padding:0;font-family:Helvetica,Arial">
<div style="max-width:940px;margin:0 auto;padding:30px 50px">
<table style="width:100%;border-collapse:collapse;line-height:2em;">
<tbody>
<tr>
<td style="padding:15px 0;border-bottom:11px solid #046ebb; background-color:#161637; "> RideFree </td>
</tr>
<tr>
<td style="background:#fff;padding:20px 30px 0 30px">

<?php 
/* DO NOT LEAVE THIS OUT */
 echo $this->fetch('content'); 
 /* DO NOT LEAVE THIS OUT */
 ?>
</td>
</tr>
<tr>
<td style="padding:10px 0;font-size:13px">
<small>This email and any attachments to it may be confidential and are intended solely for the use of the individual to whom it is addressed. Any views or opinions expressed are solely those of the author and do not necessarily represent those of <?php echo SITE;?>.  If you are not the intended recipient of this email, please be advised that you must neither take any action based upon its contents, nor copy or show it to anyone.  Our standard terms and conditions, along with our service level agreement, will apply to any engagements made as a result of the information contained in this email and any attachments. </small>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</font></div></td></tr></tbody></table>
</body>
</html>