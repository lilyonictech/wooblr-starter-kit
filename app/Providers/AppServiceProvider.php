<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use TallStackUi\Facades\TallStackUi;
use Illuminate\Support\Facades\View;
use App\Models\GeneralSetting;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        // Share variable $globalSettings ke SEMUA view
        if (Schema::hasTable('general_settings')) {
            $settings = GeneralSetting::first();
            View::share('globalSettings', $settings);
        }

        TallStackUi::personalize()
            ->form('input')
            ->block('input.wrapper')
            ->replace('rounded-md', 'rounded-lg')
            ->block('input.base')
            ->replace('py-1.5', 'py-2')
            ->replace('rounded-md', 'rounded-lg');

        TallStackUi::personalize()
            ->form('pin')
            ->block('wrapper')
            ->replace('mt-1', 'mt-0')
            ->block('input.size.base')
            ->append('h-[40px]');

        TallStackUi::personalize()
            ->form('error')
            ->block('text')
            ->replace('font-medium', 'font-normal');

        TallStackUi::personalize()
            ->form('label')
            ->block('text')
            ->replace('text-gray-600', 'text-black')
            ->replace('font-semibold', 'font-medium')
            ->replace('mb-1', 'mb-2');

        TallStackUi::personalize()
            ->wrapper('input')
            ->block('wrapper')
            ->replace('rounded-md', 'rounded-lg');

        TallStackUi::personalize()
            ->modal()
            ->block('wrapper.first')
            ->replace('bg-gray-400/75', 'bg-black/75')
            ->block('title.text')
            ->replace('text-secondary-600', 'text-black')
            ->block('title.close')
            ->replace('text-secondary-300', 'text-black')
            ->block('wrapper.fourth')
            ->append('custom-overflow');

        TallStackUi::personalize()
            ->form('number')
            ->block('input.base')
            ->replace('rounded-md', 'rounded-lg')
            ->replace('py-1.5', 'py-2.5')
            ->append('h-[36px] disabled:!cursor-not-allowed')
            ->block('buttons.left.base')
            ->replace('pr-3', 'pr-0')
            ->block('buttons.right.base')
            ->replace('pl-3', 'pl-0');

        TallStackUi::personalize()
            ->button()
            ->block('wrapper.class')
            ->remove(['focus:ring-offset-2', 'focus:ring-2', 'focus:ring-offset-white', 'focus:ring-primary-600', 'ring-primary-500', 'focus:shadow-outline', 'focus:border-transparent', 'text-primary-50'])
            ->replace('text-primary-50', 'text-primary-foreground')
            ->append('text-base hover:opacity-90')
            ->block('wrapper.border.radius.rounded')
            ->replace('rounded-md', 'rounded-lg')
            ->block('wrapper.sizes.md')
            ->append('h-[40px] leading-px !text-sm !font-medium disabled:!cursor-not-allowed !cursor-default transition-all active:scale-95');

        TallStackUi::personalize()
            ->select('styled')
            ->block('input.wrapper.base')
            ->replace('rounded-md', 'rounded-lg')
            ->append('h-[40px] !cursor-default')
            ->block('input.content.wrapper.first')
            ->replace('pl-2', 'pl-3')
            ->append('!cursor-default')
            ->block('box.list.item.description.wrapper')
            ->append('w-full');

        TallStackUi::personalize()
            ->form('toggle')
            ->block('background.class')
            ->replace('bg-secondary-200', 'bg-zinc-300');

        TallStackUi::personalize()
            ->dialog()
            ->block('wrapper.first')
            ->replace('z-10', 'z-[99999]')
            ->block('background')
            ->replace('bg-gray-400/75', 'bg-black/80')
            ->append('z-[99999]')
            ->block('buttons.confirm')
            ->append('h-11')
            ->replace('rounded-md', 'rounded-lg')
            ->block('text.title')
            ->replace('text-lg', 'text-xl')
            ->replace('text-gray-700', 'text-black')
            ->block('text.content')
            ->replace('text-sm', 'text-base')
            ->block('wrapper.third')
            ->replace('p-4', 'p-4');

        TallStackUi::personalize()
            ->slide()
            ->block('wrapper.first')
            ->replace('bg-gray-400/75', 'bg-black/80')
            ->append(content: 'z-[99]')
            ->block('wrapper.fifth')
            ->replace('py-6', 'py-0')
            ->block('wrapper.second')
            ->append('z-[100]')
            ->block('title.close')
            ->replace('text-secondary-300', 'text-black')
            ->replace('w-5', 'w-6')
            ->replace('h-5', 'h-6')
            ->block('body')
            ->replace('py-5', 'py-1')
            ->block('header')
            ->append('bg-white py-3')
            ->block('title.text')
            ->replace('text-secondary-600', 'text-black');

        TallStackUi::personalize()
            ->form('textarea')
            ->block('input.wrapper')
            ->replace('rounded-md', 'rounded-lg');

        TallStackUi::personalize()
            ->tab()
            ->block('base.wrapper')
            ->replace('shadow-md', 'shadow-none');
    }
}
