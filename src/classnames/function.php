<?php
declare(strict_types=1);

namespace ClassNames;

/**
 * Example
 * <div class="<?= cn(['solid' => true, 'red' => false, 'large' => true]) ?>"></div>
 * <div class="<?= cn(['solid', 'red' => false, 'large' => true]) ?>"></div>
 * <div class="<?= cn('solid', ['red' => false, 'large' => true]) ?>"></div>
 *
 * Result
 * <div class="solid large"></div>
 *
 */
function classnames(...$params): string {
    return ClassNames::from(...$params);
}
