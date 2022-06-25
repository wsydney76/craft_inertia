<?php

namespace modules\inertia\web;

use Craft;
use modules\inertia\Inertia;

/**
 *
 * @property-read string $inertiaVersion
 * @property-read string $inertiaUrl
 */
class Controller extends \craft\web\Controller
{

    public array|int|bool $allowAnonymous = true;

    /**
     * @param string $component
     * @param array $params
     * @return array|string
     */
    public function inertia(string $component, array $params = []): array|string
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

        return Craft::$app->view->renderTemplate(Inertia::getInstance()->view, [
            'page' => $params
        ]);
    }

    /**
     * @param array $params
     * @return array
     */
    private function getInertiaProps($params = []): array
    {
        return array_merge(
            Inertia::getInstance()->getShared(),
            $params
        );
    }

    /**
     * @return string
     */
    private function getInertiaUrl(): string
    {
        return Craft::$app->request->getUrl();
    }

    /**
     * @return string
     */
    private function getInertiaVersion(): string
    {
        return Inertia::getInstance()->getVersion();
    }
}
