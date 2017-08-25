<style>
    .message {
        background-color: rgba(255, 39, 35, 0.95);
        border: solid #333 1px;
        color: #000;
        border-radius: 3px;
        width: 100%;
        text-align: center;
        transition: all .8s .4s ease;
        margin-bottom: 10px;
    }
</style>
<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<!--<div class="message error" onclick="this.classList.add('hidden');">--><? //= $message ?><!--</div>-->

<div class="message error" onclick="this.classList.add('hidden');">
    <?= $message ?>
</div>