<?php

use SleepingOwl\Admin\Navigation\Page;

return [

    (new Page(\App\Models\Category::class))
        ->setTitle('Категории')
        ->setPriority(200)
        ->setIcon('fas fa-folder-open'),

    (new Page(\App\Models\Product::class))
        ->setTitle('Товары')
        ->setPriority(210)
        ->setIcon('fas fa-box'),

];
