<?php

namespace App\Http\Sections;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use SleepingOwl\Admin\Facades\Display as AdminDisplay;
use SleepingOwl\Admin\Facades\TableColumn as AdminColumn;
use SleepingOwl\Admin\Facades\Form as AdminForm;
use SleepingOwl\Admin\Facades\FormElement as AdminFormElement;
use SleepingOwl\Admin\Section;

class Categories extends Section
{
    protected $checkAccess = false;
    protected $title = 'Категории';
    protected $alias = 'categories';

    public function onDisplay()
    {
        $display = AdminDisplay::table()
            ->setColumns(
                AdminColumn::text('id', '#')->setWidth('50px'),
                AdminColumn::link('name', 'Название'),
                AdminColumn::text('slug', 'Slug'),
                AdminColumn::datetime('created_at', 'Создано')->setFormat('d.m.Y H:i'),
            )
            ->paginate(25);

        return $display;
    }

    public function onEdit($id = null)
    {
        // Slug is optional; allow Cyrillic/Unicode letters, digits, dash, underscore, dot; ensure uniqueness
        $slug = AdminFormElement::text('slug', 'Slug')
            ->setValidationRules('nullable|max:255|regex:/^[-_.\p{L}\p{N}]*$/u')
            ->unique()
            ->setHelpText('Оставьте пустым, чтобы сгенерировать автоматически.');

        $form = AdminForm::panel()->addBody([
            AdminFormElement::text('name', 'Название')->setValidationRules('required|string|max:255'),
            $slug,
        ]);

        return $form;
    }

    public function onCreate()
    {
        return $this->onEdit();
    }

    public function onDelete($id)
    {
        // Required hook to allow delete. Actual blocking logic lives in isDeletable().
    }

    public function isDeletable(Model $model)
    {
        // Respect base access checks and presence of onDelete
        if (! parent::isDeletable($model)) {
            return false;
        }

        // Block deletion if the category has any products
        if (method_exists($model, 'products') && $model->products()->exists()) {
            return false;
        }

        return true;
    }
}
