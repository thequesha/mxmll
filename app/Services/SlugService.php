<?php

namespace App\Services;

use Illuminate\Support\Str;

class SlugService
{
    /**
     * Generate a URL-safe slug from a name with Cyrillic->Latin transliteration
     * and ensure uniqueness for the given Eloquent model class.
     *
     * @param string $name
     * @param string $modelClass Fully-qualified model class name
     * @param int|null $ignoreId Optional ID to ignore when checking uniqueness
     */
    public function generateUniqueSlug(string $name, string $modelClass, ?int $ignoreId = null): string
    {
        $base = $this->slugify($name);
        if ($base === '') {
            $base = 'item';
        }

        $slug = $base;
        $i = 2;
        while ($this->exists($slug, $modelClass, $ignoreId)) {
            $slug = $base.'-'.$i;
            $i++;
        }
        return $slug;
    }

    /**
     * Slugify with Cyrillic transliteration.
     */
    public function slugify(string $text): string
    {
        $text = $this->transliterateCyrillic($text);
        return Str::slug($text, '-');
    }

    protected function exists(string $slug, string $modelClass, ?int $ignoreId = null): bool
    {
        /** @var \Illuminate\Database\Eloquent\Model $modelClass */
        return $modelClass::query()
            ->where('slug', $slug)
            ->when($ignoreId, function ($q) use ($ignoreId) {
                $q->where('id', '!=', $ignoreId);
            })
            ->exists();
    }

    /**
     * Basic RU -> Latin transliteration (fallback if intl not perfect).
     */
    protected function transliterateCyrillic(string $text): string
    {
        $map = [
            'А' => 'A','Б' => 'B','В' => 'V','Г' => 'G','Д' => 'D','Е' => 'E','Ё' => 'E','Ж' => 'Zh','З' => 'Z','И' => 'I','Й' => 'Y','К' => 'K','Л' => 'L','М' => 'M','Н' => 'N','О' => 'O','П' => 'P','Р' => 'R','С' => 'S','Т' => 'T','У' => 'U','Ф' => 'F','Х' => 'Kh','Ц' => 'Ts','Ч' => 'Ch','Ш' => 'Sh','Щ' => 'Sch','Ъ' => '','Ы' => 'Y','Ь' => '','Э' => 'E','Ю' => 'Yu','Я' => 'Ya',
            'а' => 'a','б' => 'b','в' => 'v','г' => 'g','д' => 'd','е' => 'e','ё' => 'e','ж' => 'zh','з' => 'z','и' => 'i','й' => 'y','к' => 'k','л' => 'l','м' => 'm','н' => 'n','о' => 'o','п' => 'p','р' => 'r','с' => 's','т' => 't','у' => 'u','ф' => 'f','х' => 'kh','ц' => 'ts','ч' => 'ch','ш' => 'sh','щ' => 'sch','ъ' => '','ы' => 'y','ь' => '','э' => 'e','ю' => 'yu','я' => 'ya',
        ];
        return strtr($text, $map);
    }
}
