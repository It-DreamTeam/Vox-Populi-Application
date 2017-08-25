<?php
$class = 'message';
if (!empty($params['class'])) {
    $class .= ' ' . $params['class'];
}
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<!--<div class="--><?//= h($class) ?><!--" onclick="this.classList.add('hidden');">--><?//= $message ?><!--</div>-->

<div class="<?= h($class) ?>" onclick="this.classList.add('hidden');">
    <div class="successtext">
        <p><?= $message ?></p>
    </div>
</div>