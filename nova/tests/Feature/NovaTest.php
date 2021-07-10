<?php

namespace Laravel\Nova\Tests\Feature;

use Laravel\Nova\Actions\ActionEvent;
use Laravel\Nova\Actions\ActionResource;
use Laravel\Nova\Exceptions\NovaExceptionHandler;
use Laravel\Nova\Nova;
use Laravel\Nova\Tests\IntegrationTest;

class NovaTest extends IntegrationTest
{
    public function test_nova_can_use_a_custom_report_callback()
    {
        $_SERVER['nova.exception.error_handled'] = false;

        $this->assertFalse($_SERVER['nova.exception.error_handled']);

        Nova::report(function ($exception) {
            $_SERVER['nova.exception.error_handled'] = true;
        });

        app(NovaExceptionHandler::class)->report(new \Exception('It did not work'));

        $this->assertTrue($_SERVER['nova.exception.error_handled']);

        unset($_SERVER['nova.exception.error_handled']);
    }

    public function test_returns_the_configured_action_resource()
    {
        $this->assertEquals(ActionResource::class, Nova::actionResource());

        config(['nova.actions.resource' => CustomActionResource::class]);

        $this->assertEquals(CustomActionResource::class, Nova::actionResource());
    }

    public function test_returns_the_configured_action_resource_model_instance()
    {
        $this->assertInstanceOf(ActionEvent::class, Nova::actionEvent());

        config(['nova.actions.resource' => CustomActionResource::class]);

        $this->assertInstanceOf(CustomActionEvent::class, Nova::actionEvent());
    }

    public function test_has_default_sidebar_sorting_strategy()
    {
        $callback = function ($resource) {
            return $resource::label();
        };

        $this->assertEquals($callback, Nova::sortResourcesWith());
    }

    public function test_can_specify_user_sortable_closure_for_sorting()
    {
        $callback = function ($resource) {
            return $resource::$priority;
        };

        Nova::sortResourcesBy($callback);

        $this->assertEquals($callback, Nova::$sortCallback);

        Nova::sortResourcesBy(function ($resource) {
            return $resource::label();
        });
    }
}

class CustomActionEvent extends ActionEvent
{
}

class CustomActionResource extends ActionResource
{
    public static $model = CustomActionEvent::class;
}
