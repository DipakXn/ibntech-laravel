<?php

namespace Tests\Unit;

use App\Models\Category;
use PHPUnit\Framework\TestCase;

class CategoryRootTest extends TestCase
{
    public function test_root_returns_itself_for_a_parent_category(): void
    {
        $parent = new Category([
            'name' => 'Cybersecurity',
            'slug' => 'cybersecurity',
            'parent_id' => null,
        ]);
        $parent->setRelation('parent', null);

        $this->assertSame($parent, $parent->root());
    }

    public function test_root_returns_the_parent_for_a_child_category(): void
    {
        $parent = new Category([
            'name' => 'Cybersecurity',
            'slug' => 'cybersecurity',
            'parent_id' => null,
        ]);
        $parent->id = 1;
        $parent->setRelation('parent', null);

        $child = new Category([
            'name' => 'VAPT',
            'slug' => 'vapt',
            'parent_id' => 1,
        ]);
        $child->id = 2;
        $child->setRelation('parent', $parent);

        $this->assertSame('Cybersecurity', $child->root()->name);
        $this->assertSame('cybersecurity', $child->root()->slug);
    }
}
