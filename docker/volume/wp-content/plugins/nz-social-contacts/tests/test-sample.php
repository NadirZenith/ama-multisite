<?php

class SampleTest extends WP_UnitTestCase
{

    function test_sample()
    {
        // replace this with some actual testing code
        $this->assertTrue(true);
    }

    function test_shortcode()
    {
        $hello = do_shortcode('[nz-social-contacts]');
        $this->assertEquals('hello', $hello);
    }
}
