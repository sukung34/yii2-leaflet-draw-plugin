<?php

namespace tests;


use tests\overrides\TestDraw;

class DrawTest extends TestCase
{
    public function testEncode()
    {
        $plugin = new TestDraw();
        $plugin->map = 'testMap';
        $this->assertEquals('plugin:Draw', $plugin->getPluginName());

        $plugin->encode();
    }

    public function testRegister()
    {
        $view = $this->getView();
        $plugin = new TestDraw();

        $this->assertEquals($plugin, $plugin->registerAssetBundle($view));

        $this->assertCount(2, $view->assetBundles);

        $this->assertArrayHasKey('tests\overrides\TestDrawAsset', $view->assetBundles);

        $this->assertEquals(
            'js/l.control.Draw.js',
            $view->assetBundles['tests\overrides\TestDrawAsset']->js[0]
        );
        $this->assertEquals(
            'js/l.Draw.provider.openstreetmap.js',
            $view->assetBundles['tests\overrides\TestDrawAsset']->js[1]
        );
    }

}