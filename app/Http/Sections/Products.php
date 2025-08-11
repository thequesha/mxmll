<?php

namespace App\Http\Sections;

use App\Models\Category;
use App\Models\Product;
use SleepingOwl\Admin\Facades\Display as AdminDisplay;
use SleepingOwl\Admin\Facades\TableColumn as AdminColumn;
use SleepingOwl\Admin\Facades\Form as AdminForm;
use SleepingOwl\Admin\Facades\FormElement as AdminFormElement;
use SleepingOwl\Admin\Section;

class Products extends Section
{
    protected $checkAccess = false;
    protected $title = 'Товары';
    protected $alias = 'products';

    public function onDisplay()
    {
        $display = AdminDisplay::table()
            ->setColumns(
                AdminColumn::text('id', '#')->setWidth('50px'),
                AdminColumn::link('name', 'Название'),
                AdminColumn::text('slug', 'Slug'),
                AdminColumn::text('price_formatted', 'Цена'),
                AdminColumn::datetime('created_at', 'Создано')->setFormat('d.m.Y H:i'),
            )
            ->paginate(25);

        return $display;
    }

    public function onEdit($id = null)
    {
        $categorySelect = AdminFormElement::select('category_id', 'Категория');
        // Load options from Category model and display by name
        $categorySelect->setModelForOptions(Category::class, 'name');
        // Element-level validation for category
        $categorySelect->setValidationRules('required|exists:categories,id');

        // Slug is optional; allow Cyrillic/Unicode letters, digits, dash, underscore, dot; ensure uniqueness
        $slug = AdminFormElement::text('slug', 'Slug')
            ->setValidationRules('nullable|max:255|regex:/^[-_.\p{L}\p{N}]*$/u')
            ->unique()
            ->setHelpText('Оставьте пустым, чтобы сгенерировать автоматически.');

        $form = AdminForm::panel()->addBody([
            $categorySelect,
            AdminFormElement::text('name', 'Название')->setValidationRules('required|string|max:255'),
            $slug,
            AdminFormElement::number('price', 'Цена (руб.)')->setMin(0)->setValidationRules('required|integer|min:0'),
            AdminFormElement::image('image', 'Изображение')
                ->setValidationRules('nullable|image|max:5120')
                ->setUploadPath(function ($file) {
                    // relative to public path, used for URL via asset()
                    return 'images/products';
                })
                ->setSaveCallback(function ($file, $path, $filename, array $settings) {
                    // Ensure target directory exists under public/
                    $publicPath = public_path($path);
                    if (!\Illuminate\Support\Facades\File::exists($publicPath)) {
                        \Illuminate\Support\Facades\File::makeDirectory($publicPath, 0775, true);
                    }

                    $file->move($publicPath, $filename);

                    $relative = trim($path, '/') . '/' . $filename;
                    return ['path' => asset($relative), 'value' => $relative];
                }),
            AdminFormElement::textarea('description', 'Описание')->setValidationRules('nullable|string'),
        ]);

        return $form;
    }

    public function onCreate()
    {
        return $this->onEdit();
    }

    public function onDelete($id)
    {
        // Hook required so delete is allowed by SleepingOwl.
        // No extra logic; repository deletion is handled by AdminController.
    }
}
