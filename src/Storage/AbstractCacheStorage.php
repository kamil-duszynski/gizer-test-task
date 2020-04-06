<?php

namespace App\Storage;

use Psr\Cache\InvalidArgumentException;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

abstract class AbstractCacheStorage
{
    protected function loadFromCache(string $key): array
    {
        $cache = new FilesystemAdapter();

        try {
            $items = $cache->getItem($key)->get();

            if (null === $items) {
                return [];
            }

            return $items;
        } catch (InvalidArgumentException $e) {
            // mute exception - do nothing
        }

        return [];
    }

    protected function storeToCache(string $key, array $data): void
    {
        try {
            $cache = new FilesystemAdapter();
            $item  = $cache
                ->getItem($key)
                ->expiresAfter(600)
                ->set($data)
            ;

            $cache->save($item);
        } catch (InvalidArgumentException $e) {
            // mute exception - do nothing
        }
    }

    protected static function createCacheKey($data): string
    {
        return md5(serialize($data));
    }
}
