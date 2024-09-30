<?php
/**
 * Created by PhpStorm.
 * User: dpotekhin
 * Date: 06.08.2018
 * Time: 15:00
 */

namespace common\components;

class Request extends \yii\web\Request
{
    public ?string $web = null;
    public ?string $adminUrl = null;

    public function getBaseUrl(): string
    {
        return str_replace($this->web, "", parent::getBaseUrl()) . $this->adminUrl;
    }


    /*
        If you don't have this function, the admin site will 404 if you leave off
        the trailing slash.

        E.g.:

        Wouldn't work:
        site.com/admin

        Would work:
        site.com/admin/

        Using this function, both will work.
    */
    public function resolvePathInfo(): string
    {
        if ($this->getUrl() === $this->adminUrl) {
            return "";
        }
        return parent::resolvePathInfo();
    }
}