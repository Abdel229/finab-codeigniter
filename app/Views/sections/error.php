<?php

$flashData = session()->getFlashdata();
if (isset($flashData['errors']) && is_array($flashData['errors']) && count($flashData['errors']) > 0) {
    echo '<div class="alert-danger alert-corner" role="alert">';
    foreach ($flashData['errors'] as $message) {
        echo '<div class="alert__message">';
        echo '<p>' . esc($message) . '</p>';
        echo '</div>';
    }
    echo '</div>';
} elseif (isset($flashData['success']) && is_array($flashData['success']) && count($flashData['success']) > 0) {
    echo '<div class="alert-success alert-corner" role="alert">';
    foreach ($flashData['success'] as $message) {
        echo '<div class="alert__message">';
        echo '<p>' . esc($message) . '</p>';
        echo '</div>';
    }
    echo '</div>';
}
?>