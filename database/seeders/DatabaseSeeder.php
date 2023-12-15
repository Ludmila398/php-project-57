<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TaskStatus;
use App\Models\Task;
use App\Models\User;
use App\Models\Label;
use Illuminate\Database\Eloquent\Factories\Sequence;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $statusNames = [
            ['name' => 'новый'],
            ['name' => 'завершен'],
            ['name' => 'в работе'],
            ['name' => 'на тестировании'],
            ];

        foreach ($statusNames as $statusName) {
            TaskStatus::factory()->create($statusName);
        }


        User::factory()->count(17)->create();

        Task::factory()
        ->count(17)
        ->state(new Sequence(
            ['name' => 'Оптимизировать скорость загрузки', 'description' => 'Ускорить загрузку сайта, оптимизировать изображения и код.'],
            ['name' => 'Обновить контактную информацию', 'description' => 'Актуализировать адрес, телефон, электронную почту на странице контактов.'],
            ['name' => 'Добавить мобильную версию сайта', 'description' => 'Разработать адаптивную верстку для мобильных устройств.'],
            ['name' => 'Исправить баги в форме обратной связи', 'description' => 'Устранить проблемы с отправкой сообщений в форме.'],
            ['name' => 'Добавить новый раздел "Новости"', 'description' => 'Разработать и добавить раздел для публикаций новостей.'],
            ['name' => 'Обновить галерею изображений', 'description' => 'Обновить дизайн и содержание галереи.'],
            ['name' => 'Улучшить навигацию по сайту', 'description' => 'Переработать меню, упростить поиск информации.'],
            ['name' => 'Интеграция с социальными сетями', 'description' => 'Добавить функцию расшаривания контента в соцсети.'],
            ['name' => 'Добавить поиск по сайту', 'description' => 'Реализовать функцию удобного поиска по сайту.'],
            ['name' => 'Обновить страницу "О нас"', 'description' => 'Актуализировать информацию о компании и команде.'],
            ['name' => 'Добавить отзывы клиентов', 'description' => 'Разместить раздел с отзывами для повышения доверия.'],
            ['name' => 'Интегрировать систему онлайн-оплаты', 'description' => 'Добавить возможность оплаты услуг онлайн.'],
            ['name' => 'Улучшить SEO-оптимизацию', 'description' => 'Оптимизировать сайт для лучшей индексации поисковиками.'],
            ['name' => 'Добавить мультиязычную поддержку', 'description' => 'Поддержка нескольких языков для интернациональных пользователей.'],
            ['name' => 'Оптимизировать базу данных', 'description' => 'Повысить производительность и эффективность базы данных.'],
            ['name' => 'Реализовать бэкапы сайта', 'description' => 'Настроить регулярное резервное копирование данных.'],
            ['name' => 'Добавить систему управления контентом', 'description' => 'Внедрить CMS для удобства обновления контента.'],
        ))->create();


        Label::factory()
        ->count(4)
        ->state(new Sequence(
            ['name' => 'ошибка', 'description' => 'Какая-то ошибка в коде или проблема с функциональностью'],
            ['name' => 'документация', 'description' => 'Задача которая касается документации'],
            ['name' => 'дубликат', 'description' => 'Повтор другой задачи'],
            ['name' => 'доработка', 'description' => 'Новая фича, которую нужно запилить'],
        ))->create();


        $tasks = Task::all();

        foreach ($tasks as $task) {
            $labels = Label::all()->random(random_int(0, 3))->unique();
            $task->labels()->attach($labels);
        }
    }
}
