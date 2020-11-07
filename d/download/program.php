<?php
error_reporting(E_ALL);

date_default_timezone_set('Europe/Sofia');


$predmeti = array(
  'history' => 'https://us04web.zoom.us/j/3105867184',
  'biology' => 'https://us04web.zoom.us/j/6507046044',
  'bulgarian' => 'https://us04web.zoom.us/j/9724655180',
  'spanish' => 'https://us04web.zoom.us/j/6442950561',
  'geo' => 'https://us04web.zoom.us/j/7410556311',
  'maths' => 'https://us04web.zoom.us/j/9239826267',
  'english2' => 'https://us04web.zoom.us/j/333516888',
  'nqma' => 'http://daskalo.xyz/nqmash.index'
);

$calendar = array(
  1 => array(
      2 => $predmeti['geo'],
      3 => $predmeti['english2'],
      ),

  2 => array(
      1 => $predmeti['maths'],
      3 => $predmeti['history'],
      ),
  3 => array(
      1 => $predmeti['spanish'],
      3 => $predmeti['biology'],
      ),
  4 => array(
      1 => $predmeti['spanish'],
      2 => $predmeti['history'],
      3 => $predmeti['geo'],
      ),
  5 => array(
      1 => $predmeti['bulgarian'],
      2 => $predmeti['biology'],
      3 => $predmeti['maths'],
    ),

);

$class_slots = array(
    array(1, '9:00', '10:20'),
    array(2, '10:55', '12:15'),
    array(3, '13:00', '14:20'),
    // ...
);

function hour_to_class($time) {
    global $class_slots;
    foreach ($class_slots as $slot) {
        $hour = DateTime::createFromFormat('H:i', $time);
        if ($hour >= DateTime::createFromFormat('H:i', $slot[1]) &&
            $hour <= DateTime::createFromFormat('H:i', $slot[2])) {
            return $slot[0];
        }
    }
    return -1;
}


//////////


$current_class = hour_to_class(date('H:i'));

if ($current_class < 0) {
    // not in class now...
    echo('<h1>Not in class now</h1>'. PHP_EOL);
    exit;
}

$current_day = date('N');

if (!array_key_exists($current_day, $calendar)) {
    // not in calendar day or class
    echo('<h1>No school today</h1>'. PHP_EOL);
    exit;
}

if (!array_key_exists($current_class, $calendar[$current_day])) {
    echo('<h1>Class not found in day or break between classes</h1>'. PHP_EOL);
    exit;
}

$url = $calendar[$current_day][$current_class];

header("Location: " . $url);
echo($url);
