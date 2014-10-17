<?php
/**
 * Example of applying a callback to capitalize the first letter.
 * 
 * Note that you must return TRUE from the callback function to continue
 * iterating. This can be useful if you wish to stop iteration under
 * certain conditions.
 *
 * @param   Iterator $it
 * @return  bool
 */
function addDbPrefix(Traversable $it, $prefix = 'test') {
    echo $it[$it->key()] = $prefix . '_' . $it->current();
    echo PHP_EOL;
    return true;
}

// example array of table names to prefix
$array = array('users', 'roles', 'users_roles', 'users_profile');

try {

	$it = new ArrayIterator($array);
    $prefix = 'example';
	
    // apply the callback function to the iterator
    iterator_apply($it, 'addDbPrefix', array($it, $prefix));
	
	// Anonymous funtions works like a charm
	iterator_apply($it, function() use ($it, $prefix) {
		echo $it[$it->key()] = $prefix . '_' . $it->current();
		echo PHP_EOL;
		return true;
	});

} catch(Exception $e) {
    die($e->getMessage());   
}