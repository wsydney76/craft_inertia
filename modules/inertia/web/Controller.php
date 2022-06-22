<?php

namespace modules\inertia\web;

use Craft;
use modules\inertia\Inertia;

class Controller extends \craft\web\Controller
{

    public array|int|bool $allowAnonymous = true;

    /**
     * @param string $component
     * @param array $params
     * @return array|string
     */
    public function inertia($component, $params = [])
    {
        $params = [
            'component' => $component,
            'props' => $this->getInertiaProps($params),
            'url' => $this->getInertiaUrl(),
            'version' => $this->getInertiaVersion()
        ];

        if (Craft::$app->request->headers->has('X-Inertia')) {
            return $params;
        }

        $customView = Craft::$app->config->custom->frontendView ?? null;

        $view = $customView ?: Inertia::getInstance()->view;

        return Craft::$app->view->renderTemplate($view, [
            'page' => $params
        ]);
    }

    /**
     * @param array $params
     * @return array
     */
    private function getInertiaProps($params = [])
    {
        return array_merge(
            Inertia::getInstance()->getShared(),
            $params
        );
    }

    /**
     * @return string
     */
    private function getInertiaUrl()
    {
        return Craft::$app->request->getUrl();
    }

    /**
     * @return string
     */
    private function getInertiaVersion()
    {
        return Inertia::getInstance()->getVersion();
    }
}
