# Core
--------

Type:

- Bundled (Worker: Core)

Situation:

- Core-Api is fixed (always there)


- Core is fixed (always there)

## Structure
------------

    Directory: Core > Unit > Name > ..
    Instance: Api.php (Interface & Class)
    Interface: Define Api

    Class-Location
    Api: Core > Unit > Name > Api > ..
    Worker: Core > Unit > Name > Source > .. (Type: Bundled)

- Interface used by
	- Core
	- Module
	- Extension
	- Plugin
- Instance used by
	- Core Api
	- ```Api::groupCore()->unit{Unit}()->api{Name:Instance}()->{Method}```

## Api
------

Location: ```Core > Unit > Name > Api > ..```

## Worker
---------

Location: ```Core > Unit > Name > Source > ..```

