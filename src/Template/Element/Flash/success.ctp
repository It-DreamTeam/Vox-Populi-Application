<style>
.message{
  background-color: green;
  border: solid #333 1px;
  color: #fff;
}
</style>
<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<!--<div class="message success" onclick="this.classList.add('hidden')">--><?//= $message ?><!--</div>-->

<div class="message success" onclick="this.classList.add('hidden');">
    <div class="successtext">
        <p><?= $message ?></p>
    </div>
</div>