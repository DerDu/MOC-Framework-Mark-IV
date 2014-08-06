# Core
--------

Type:

- Bundled (Worker: Core)

Situation:

- Core-Api is fixed (always there)


- Core is fixed (always there)

## Structure
------------

    Directory: Core > Category > Name > ..
    Instance: Api.php (Interface & Class)
    Interface: Define Api

    Class-Location
    Api: Core > Category > Name > Api > ..
    Worker: Core > Category > Name > Source > .. (Type: Bundled)

- Interface used by
	- Core
	- Module
	- Extension
	- Plugin
- Instance used by
	- Core Api
	- ```Api::Core()->{Category}()->{Name:Instance}()->{Method}```

## Api
------

Location: ```Core > Category > Name > Api > ..```

## Worker
---------

Location: ```Core > Category > Name > Source > ..```

