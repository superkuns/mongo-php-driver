--TEST--
MongoDB\Driver\Manager::executeCommand(): wrong options and values
--SKIPIF--
<?php require __DIR__ . "/../utils/basic-skipif.inc"; ?>
<?php NEEDS('REPLICASET'); CLEANUP(REPLICASET); ?>
--FILE--
<?php
require_once __DIR__ . "/../utils/basic.inc";

$manager = new MongoDB\Driver\Manager(REPLICASET);

$command = new MongoDB\Driver\Command(['ping' => 1]);

echo throws(function() use ($manager, $command) {
    $manager->executeCommand(DATABASE_NAME, $command, ['readPreference' => 'foo']);
}, 'MongoDB\Driver\Exception\InvalidArgumentException'), "\n";
echo throws(function() use ($manager, $command) {
    $manager->executeCommand(DATABASE_NAME, $command, ['readPreference' => new stdClass]);
}, 'MongoDB\Driver\Exception\InvalidArgumentException'), "\n";

echo throws(function() use ($manager, $command) {
    $manager->executeCommand(DATABASE_NAME, $command, ['unknown' => 'foo']);
}, 'MongoDB\Driver\Exception\InvalidArgumentException'), "\n";

echo throws(function() use ($manager, $command) {
    $manager->executeCommand(DATABASE_NAME, $command, ['writeConcern' => 'foo']);
}, 'MongoDB\Driver\Exception\InvalidArgumentException'), "\n";
?>
===DONE===
<?php exit(0); ?>
--EXPECTF--
OK: Got MongoDB\Driver\Exception\InvalidArgumentException
Expected 'readPreference' option to be 'MongoDB\Driver\ReadPreference', string given
OK: Got MongoDB\Driver\Exception\InvalidArgumentException
Expected 'readPreference' option to be 'MongoDB\Driver\ReadPreference', object given
OK: Got MongoDB\Driver\Exception\InvalidArgumentException
Unknown option 'unknown'
OK: Got MongoDB\Driver\Exception\InvalidArgumentException
Unknown option 'writeConcern'
===DONE===
