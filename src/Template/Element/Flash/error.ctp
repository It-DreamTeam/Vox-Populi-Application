<style>
.message{
  background-color: red;
  border: solid #333 1px;
  color: #000;
}
</style>
<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<!--<div class="message error" onclick="this.classList.add('hidden');">--><?//= $message ?><!--</div>-->

<div onclick="this.classList.add('hidden');">
            <p style="background-color: red; text-align: justify; font-weight: bold; font-family: serif; padding: 10px;">
              <?= $message ?>
           </p>

</div>
