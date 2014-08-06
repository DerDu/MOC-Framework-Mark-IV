# Module
--------

Type:

- Bundled (Worker: Module)
- Repository (Worker: Extension/Plugin)

Situation:

- Module-Api is fixed (always there)


- Module is possible there (install/uninstall)
- Extension is possible there (install/uninstall)

## Structure
------------

    Directory: Module > Unit > Name > ..
    Instance: Api.php (Interface & Class)
    Interface: Define Api

    Class-Location
    Api: Module > Unit > Name > Api > ..
    Worker: Module > Unit > Name > Source > .. (Type: Bundled)

- Interface used by
	- Module
	- Extension
	- Plugin
- Instance used by
	- Module Api
	- ```Api::groupModule()->unit{Unit}()->api{Name:Instance}()->{Method}```

## Api
------

Location: ```Module > Unit > Name > Api > ..```

## Worker
---------

### Module (Bundled)

Location: ```Module > Unit > Name > Source > ..```

### Extension (Repository)

Location: ```Extension > Unit > Name > Source > ..```

### Plugin (Repository)

Location: ```Plugin > Unit > Name > Source > ..```
