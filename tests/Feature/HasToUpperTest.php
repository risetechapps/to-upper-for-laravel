<?php

namespace RiseTechApps\ToUpper\Tests\Feature;

use Illuminate\Database\Eloquent\Model;
use RiseTechApps\ToUpper\Tests\TestCase;
use RiseTechApps\ToUpper\Traits\HasToUpper;

class HasToUpperTest extends TestCase
{
    /** @test */
    public function it_converts_strings_to_uppercase_before_setting_attribute(): void
    {
        $model = new class extends Model {
            use HasToUpper;

            protected $guarded = [];
        };

        $model->setAttribute('name', ' João Silva ');

        $this->assertSame('JOÃO SILVA', $model->getAttribute('name'));
    }

    /** @test */
    public function it_respects_the_only_upper_list(): void
    {
        $model = new class extends Model {
            use HasToUpper;

            protected $guarded = [];
            protected array $only_upper = ['code'];
        };

        $model->setAttribute('code', 'abc');
        $model->setAttribute('name', 'john');

        $this->assertSame('ABC', $model->getAttribute('code'));
        $this->assertSame('john', $model->getAttribute('name'));
    }

    /** @test */
    public function it_respects_the_no_upper_list(): void
    {
        $model = new class extends Model {
            use HasToUpper;

            protected $guarded = [];
            protected array $no_upper = ['email'];
        };

        $model->setAttribute('email', 'john@example.com');
        $model->setAttribute('city', 'porto alegre');

        $this->assertSame('john@example.com', $model->getAttribute('email'));
        $this->assertSame('PORTO ALEGRE', $model->getAttribute('city'));
    }

    /** @test */
    public function it_ignores_morph_attributes(): void
    {
        $model = new class extends Model {
            use HasToUpper;

            protected $guarded = [];
        };

        $model->setAttribute('attachable_type', 'App\\Models\\File');
        $model->setAttribute('attachable_id', 'uuid-value');

        $this->assertSame('App\\Models\\File', $model->getAttribute('attachable_type'));
        $this->assertSame('uuid-value', $model->getAttribute('attachable_id'));
    }

    /** @test */
    public function it_allows_custom_encoding_and_trim_flags(): void
    {
        $model = new class extends Model {
            use HasToUpper;

            protected $guarded = [];
            protected string $uppercase_encoding = 'UTF-8';
            protected bool $uppercase_trim = false;
        };

        $model->setAttribute('nickname', ' joão ');

        $this->assertSame(' JOÃO ', $model->getAttribute('nickname'));
    }
}
