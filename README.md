# Jam Locations

[![Build Status](https://travis-ci.org/OpenBuildings/jam-locations.png?branch=master)](https://travis-ci.org/OpenBuildings/jam-locations)
[![Coverage Status](https://coveralls.io/repos/OpenBuildings/jam-locations/badge.png?branch=master)](https://coveralls.io/r/OpenBuildings/jam-locations?branch=master)
[![Latest Stable Version](https://poser.pugx.org/openbuildings/jam-locations/v/stable.png)](https://packagist.org/packages/openbuildings/jam-locations)

This module adds hierarchical locations (continents, countries, cities), by leveraging openbuildings/jam-closuretable. As well as auto initialized ip field and countries / cities set automatically through geolocation.

## Usage

Using ip field is as easy as just defining it:
```php
class Model_User extends Jam_Model {

	public static function initialize(Jam_Meta $meta)
	{
		$meta
			->fields(array(
				// ...
				'ip' => Jam::field('ip'),
			));
	}
}

$user = Jam::build('user');
echo $user->ip; // will return the current ip address (from Request::$clent_ip)
```

Auto Location is a bit more involved:

```php
class Model_User extends Jam_Model {

	public static function initialize(Jam_Meta $meta)
	{
		$meta
			->behaviors(array(
				'location_auto' => Jam::behavior('location_auto', array(
					'locations' => array(
						// association => geoip record name
						'city' => 'city',
						'country' => 'country_name',
					)
				)),
			))
			->associations(array(
				'country' => Jam::association('belongsto', array('foreign_model' => 'location')),
				'city' => Jam::association('belongsto', array('foreign_model' => 'location')),
			))
			->fields(array(
				'id' => Jam::field('primary'),
				'ip' => Jam::field('ip'),
			));
	}
}
```
Then if you do not set city or country association, it would use the ip field to get a geoip record, and from there try to find / create the appropriate location.


Lastly the location_parent behavior is used to assign a parent to a location association if both the child and the parent are present in the model:

```php
class Model_Address extends Jam_Model {

	public static function initialize(Jam_Meta $meta)
	{
		$meta
			->behaviors(array(
				'location_parent' => Jam::behavior('location_parent', array(
					'parents' => array(
						// child => parent
						'city' => 'country',
					)
				)),
			))
			->associations(array(
				'country' => Jam::association('belongsto', array('foreign_model' => 'location')),
				'city' => Jam::association('belongsto', array('foreign_model' => 'location')),
			))
			->fields(array(
				'id' => Jam::field('primary'),
			));
	}
}

$address = Jam::build('address');

$address->country = Jam::find('location', 'France');
$address->city = Jam::build('location', array('name' => 'Paris'));

$address->save();

echo $address->city->parent->name(); // will return "France"
```

## Requirement

This module requires php geoip extension.

## License

Copyright (c) 2012-2013, OpenBuildings Ltd. Developed by __Ivan Kerin__ as part of [clippings.com](http://clippings.com)

Under BSD-3-Clause license, read LICENSE file.
