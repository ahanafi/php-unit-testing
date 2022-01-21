<?php

use App\Support\Collection;
use PHPUnit\Framework\TestCase;

class CollectionTest extends TestCase
{

    /** @test */
    public function emptyInstantiatedCollectionReturnsNoItems(): void
    {
        $collection = new Collection();
        self::assertEmpty($collection->get());
    }

    /** @test */
    public function countIsCorrectForItemsPassedIn(): void
    {
        $collection = new Collection([
            'ubuntu', 'debian', 'redhat', 'fedora'
        ]);

        self::assertEquals(4, $collection->count());
    }

    /** @test */
    public function itemsReturnedMatchItemsPassedIn(): void
    {
        $collection = new Collection([
            'Linux', 'Windows', 'Mac'
        ]);

        self::assertCount(3, $collection->get());
        self::assertEquals('Linux', $collection->get()[0]);
        self::assertEquals('Windows', $collection->get()[1]);
        self::assertEquals('Mac', $collection->get()[2]);
    }

    /** @test */
    public function collectionIsInstanceOfIteratorAggregate(): void
    {
        $collection = new Collection();

        self::assertInstanceOf(IteratorAggregate::class, $collection);
    }

    /** @test */
    public function collectionCanBeIterated(): void
    {
        $collections = new Collection([
            'Bandung', 'Cirebon', 'Jakarta', 'Surabaya', 'Semarang'
        ]);

        $items = [];

        foreach ($collections as $collection) {
            $items[] = $collection;
        }

        self::assertCount(5, $items);
        self::assertInstanceOf(ArrayIterator::class, $collections->getIterator());
    }

    /** @test */
    public function collectionCanBeMergedAnotherCollection(): void
    {
        $firstCollection = new Collection(['Ahmad', 'Budi', 'Cecep']);
        $secondCollection = new Collection(['Dedi', 'Eko', 'Ferry', 'Ghofur']);

        $firstCollection->merge($secondCollection);

        self::assertCount(7, $firstCollection->get());
        self::assertEquals(7, $firstCollection->count());
    }

    /** @test */
    public function collectionCanAddToExistingCollection(): void
    {
        $collection = new Collection(['Ahmad', 'Budi', 'Cecep']);
        $collection->add(['Deny', 'Endang']);

        self::assertEquals(5, $collection->count());
        self::assertCount(5, $collection->get());
    }

    /** @test */
    public function returnsJsonEncodedItems(): void
    {
        $collection = new Collection([
            ['username' => 'ahanafi'],
            ['username' => 'alex'],
            ['username' => 'buddy'],
        ]);

        self::assertIsString($collection->toJson());
        self::assertEquals('[{"username":"ahanafi"},{"username":"alex"},{"username":"buddy"}]', $collection->toJson());
    }

    /** @test */
    public function jsonEncodingACollectionObjectReturnsJson(): void
    {
        $collection = new Collection([
            ['username' => 'ahanafi'],
            ['username' => 'alex'],
            ['username' => 'buddy'],
        ]);

        $encoded = json_encode($collection);

        self::assertIsString($encoded);
        self::assertEquals('[{"username":"ahanafi"},{"username":"alex"},{"username":"buddy"}]', $encoded);
    }
}