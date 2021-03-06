<?php

namespace Tests\Unit\Domain\Shared\Support;

use App\Domain\Shared\Support\Url;
use Tests\TestCase;

class UrlTest extends TestCase
{
    /** @test */
    public function it_builds_url_from_url_without_query_string()
    {
        $this->assertEquals(
            'www.url.test?page=3&limit=10',
            Url::build('www.url.test', ['page' => 3, 'limit' => 10])
        );
    }

    /** @test */
    public function it_builds_url_from_url_with_query_string()
    {
        $this->assertEquals(
            'www.url.test?page=3&limit=10&orderBy=created_at',
            Url::build('www.url.test?page=3', ['limit' => 10, 'orderBy' => 'created_at'])
        );
    }

    /** @test */
    public function it_trims_slash_or_question_mark()
    {
        $this->assertEquals(
            'www.url.test?page=3&limit=10',
            Url::build('www.url.test/', ['page' => 3, 'limit' => 10])
        );

        $this->assertEquals(
            'www.url.test?page=3&limit=10',
            Url::build('www.url.test?', ['page' => 3, 'limit' => 10])
        );
    }
}
