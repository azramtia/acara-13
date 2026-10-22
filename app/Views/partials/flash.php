<?php
/**
 * Partial Flash Message.
 * Variabel $flash dikirim dari controller (hasil Flash::pull()),
 * sehingga pesan hanya tampil satu kali.
 */
if (!empty($flash)):
    $colors = [
        'success' => ['#d1e7dd', '#0f5132', '#badbcc', '✓'],
        'danger'  => ['#f8d7da', '#842029', '#f5c2c7', '✕'],
        'warning' => ['#fff3cd', '#664d03', '#ffecb5', '!'],
        'info'    => ['#cff4fc', '#055160', '#b6effb', 'i'],
    ];
    [$bg, $fg, $border, $icon] = $colors[$flash['type']] ?? $colors['info'];
?>
    <div role="alert"
         style="background:<?= $bg ?>;color:<?= $fg ?>;border:1px solid <?= $border ?>;
                padding:10px 14px;margin:12px 0;border-radius:4px;max-width:520px;">
        <strong><?= $icon ?></strong>
        <?= htmlspecialchars($flash['message']) ?>
    </div>
<?php endif; ?>
