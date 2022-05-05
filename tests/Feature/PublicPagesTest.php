<?php /** @noinspection ReturnTypeCanBeDeclaredInspection */

use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    public function testCanViewHomePage()
    {
        $this->get(route('home'))->assertSuccessful()->assertSee('Welcome');
    }
}
