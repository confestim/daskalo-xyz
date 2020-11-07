,
<?php
error_reporting(E_ALL);

date_default_timezone_set('Europe/Sofia');


$predmeti = array(
  'history' => 'https://zoom.us/j/7778121566?pwd=STREMlgzeXN2TGlPSWdVcVY5QWNydz09',
  'biology' => 'https://zoom.us/j/6342410524?pwd=enJSekg5eU9DNHBrbkdzVStldng1UT09',
  'bulgarian' => 'https://us04web.zoom.us/j/9724655180?pwd=Q0w2L1ArcmJBUmxvLzdQajY4eURiUT09',
  'spanish' => 'https://us04web.zoom.us/j/9267575250?pwd=YnZVWmI4SzRMWHlEVko3OUVUVUVZdz09',
  'geo' => 'https://zoom.us/j/4259592865?pwd=NHZBMVcwSVZFaHoybE5tNE1PMW1kdz09',
  'maths' => 'https://zoom.us/j/8030756183?pwd=OERIM3RQS21GaVRvOVVRWThxZUFBUT09',
  'english2' => 'https://us04web.zoom.us/j/9757645278?pwd=ZG90RCtubWlIMTlDdzFiMHlveUFoQT09',
  'profil' => 'https://daskalo.xyz/profile.html',
  'fiz' => 'https://us04web.zoom.us/j/4819947089?pwd=MHNJejQ2Q05MbVAvVndDMTN6ZENTQT09',
  'infor' => 'https://us04web.zoom.us/j/9629672483?pwd=dWU0WVJubnVDRjROV00vaUZGb0JLQT09'

);

$calendar = array(
  1 => array(
      1 => $predmeti['bulgarian'],
      2 => $predmeti['geo'],
      3 => $predmeti['english2'],
      4 => $predmeti['infor'],
      ),
  2 => array(
      1 => $predmeti['maths'],
      2 => $predmeti['fiz'],
      3 => $predmeti['history'],
      ),
  3 => array(
      1 => $predmeti['spanish'],
      2 => $predmeti['profil'],
      3 => $predmeti['biology'],
      ),
  4 => array(
      1 => $predmeti['spanish'],
      2 => $predmeti['history'],
      3 => $predmeti['geo'],
      ),
  5 => array(
      1 => $predmeti['biology'],
      2 => $predmeti['bulgarian'],
    ),

);

$class_slots = array(
    array(1, '8:50', '10:20'),
    array(2, '10:40', '12:15'),
    array(3, '12:50', '14:20'),
    array(4, '14:55', '16:40'),
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
    echo('<center><h1>Not in class now</h1>'. PHP_EOL);
    echo("<center>Time is: " . date('H:i') . " Day is: ". date('l'));
    echo('<center><img src="images/10bbig.png" />');
    exit;
}

$current_day = date('N');

if (!array_key_exists($current_day, $calendar)) {
    // not in calendar day or class
    echo('<center><h1>No school today</h1>'. PHP_EOL);
    echo("<center>Time is: " . date('H:i') . " Day is: ". date('l'));
    echo('<center><img src="images/10bbig.png" />');
    exit;
}

if (!array_key_exists($current_class, $calendar[$current_day])) {
    echo('<h1>Class not found in day or break between classes</h1>'. PHP_EOL);
    exit;
}

$url = $calendar[$current_day][$current_class];

header("Location: " . $url);
echo($url);
