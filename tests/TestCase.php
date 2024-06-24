<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\UserLoginTest;

abstract class TestCase extends BaseTestCase
{
    use UserLoginTest;
}
