<?php

/**
 * Recreates the pixel-pit.json example from the LAN Party Publishing Standard:
 * https://github.com/jamesread/lan-party-publishing-standard/blob/main/example-outputs/pixel-pit.json
 */

require __DIR__ . '/helpers.php';

header('Content-Type: application/json');

echo buildPixelPitPublisher()->toJson();
