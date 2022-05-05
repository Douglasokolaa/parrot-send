<?php

test('view home Page', function () {
    $this->get(route('home'))->assertOk()->assertSee('Welcome');
});
